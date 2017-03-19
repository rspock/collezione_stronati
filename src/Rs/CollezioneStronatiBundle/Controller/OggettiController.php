<?php

namespace Rs\CollezioneStronatiBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Rs\CollezioneStronatiBundle\Entity\Bicchiere;
use Rs\CollezioneStronatiBundle\Entity\Profumo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Rs\CollezioneStronatiBundle\Entity\Mignon;
use Rs\CollezioneStronatiBundle\Entity\Produttore;
use Rs\CollezioneStronatiBundle\Form\ProduttoreType;



class OggettiController extends CollezioneStronatiController
{
    /**
     * Lists all Mignon entities.
     *
     * @Route("/carica", name="pagina_caricamento")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * Lists all Mignon entities.
     *
     * @Route("/", name="mostra_immagini")
     * @Method("GET")
     * @Template()
     */
    public function mostraImmaginiAction()
    {
        $uploadManager = $this->get('rs.collezionestronati.foto.upload');
        $response =$uploadManager->get();
        return $response;
    }

    /**
     * @Route("/", name="caricamento_immagini")
     * @Method("POST")
     */
    public function caricamentoImmaginiAction(Request $request)
    {
        $uploadManager = $this->get('rs.collezionestronati.foto.upload');
        $response =$uploadManager->post();
        return $response;
    }

    /**
     * @Route("/", name="cancella_immagini")
     * @Method("DELETE")
     */
    public function cancellaImmaginiAction(Request $request)
    {
        $uploadManager = $this->get('rs.collezionestronati.foto.upload');
        $response =$uploadManager->delete();
        return $response;
    }

    /**
     * @Route("/mostra/{id}", name="mostra_immagine")
     * @Method("GET")
     */
    public function mostraFotoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RsCollezioneStronatiBundle:Foto');

        $foto = $repository->find($id);


        $response = new StreamedResponse(
            function () use ($foto) {
                echo stream_get_contents($foto->getContenuto());
            });
        $response->headers->set('Content-Type', 'image/jpeg');
        $response->headers->set('Content-Disposition', 'inline;filename='.$foto->getNome());
        return $response;

        /*
        $response = $this->getResponse();
        $response->clearHttpHeaders();
        $response->setContentType ($this->image->getMimeType());
        $response->setHttpHeader ('Content-Disposition', 'inline;filename='.$foto->getNome());
        $content = $foto->getContenuto();
        $response->setContent (stream_get_contents ($content));

        $this->setLayout (false);
        return sfView::NONE;
        */
    }


    /**
     * @Route("/cataloga", name="cataloga_immagini")
     * @Method("GET")
     * @Template()
     */
    public function catalogaImmaginiAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RsCollezioneStronatiBundle:Foto');

        $foto = $repository->findBy(array("oggetto"=>null), array('nome'=> 'ASC'));

        return array("listaFoto" => $foto);
    }

    /**
     * @Route("/cataloga", name="cataloga_immagine")
     * @Method("POST")
     * @Template()
     */
    public function catalogaImmagineAction(Request $request)
    {

        $mignon = new Mignon();
        $profumo = new Profumo();
        $bicchiere = new Bicchiere();

        $em = $this->getDoctrine()->getManager();

        $repositoryFoto = $em->getRepository('RsCollezioneStronatiBundle:Foto');
        $fotoArray = new ArrayCollection();
        foreach($request->get('fotoSelezionate') as $idFoto){
            $foto = $repositoryFoto->find($idFoto);
            if($foto != null){
                $fotoArray->add($foto);
            }
        }

        if( $fotoArray->count() > 0 ){
            $mignon->setFoto($fotoArray);
            $profumo->setFoto($fotoArray);
            $bicchiere->setFoto($fotoArray);
        }


        if($request->request->get("idProduttore") != null){
            $produttore = $em->getRepository('RsCollezioneStronatiBundle:Produttore')->find($request->request->get("idProduttore"));
            if($produttore!=null){
                $mignon->setProduttore($produttore);
                $profumo->setProduttore($produttore);
                $bicchiere->setProduttore($produttore);
            }

        }

        $formBuilder = $this->get('rs.collezionestronati.form.builder');
        $formMignon = $formBuilder->generaNuovoOggettoForm('Rs\CollezioneStronatiBundle\Form\BaseType\MignonType',
            $mignon,
            'mignon_create');

        $formBicchiere = $formBuilder->generaNuovoOggettoForm('Rs\CollezioneStronatiBundle\Form\BaseType\BicchiereType',
            $bicchiere,
            'bicchiere_create');

        $formProfumo = $formBuilder->generaNuovoOggettoForm('Rs\CollezioneStronatiBundle\Form\BaseType\ProfumoType',
            $profumo,
            'profumo_create');

        $formProduttore = $this->createForm(new ProduttoreType(), new Produttore(), array(
            'action' => $this->generateUrl('produttore_create'),
            'method' => 'POST',
        ));

        return array("formMignon" => $formMignon->createView(),
            "formProfumo" => $formProfumo->createView(),
            "formBicchiere" => $formBicchiere->createView(),
            "formProduttore" => $formProduttore->createView()
        );

    }

    /**
     * @Route("/genera_form/{tipo}", name="genera_form")
     * @Method("GET")
     */
    public function generaFormAction(Request $request,$tipo){

    }
}
