<?php

namespace Rs\CollezioneStronatiBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class SincronizzaController extends CollezioneStronatiController
{
    /**
     * @Route("/", name="sincronizza")
     * @Method("GET")
     * @Template()
     */
    public function sincronizzaAction()
    {
        return array();
    }

    /**
     * @Route("/conteggia/{nomeDispositivo}", name="conteggia")
     * @Method("GET")
     */
    public function conteggiaAction($nomeDispositivo)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RsCollezioneStronatiBundle:Oggetto');
        $conteggio = $repository->getConteggioDispositiviNonSincronizzati($nomeDispositivo);
        $response = new JsonResponse();
        $response->setData($conteggio);
        $response->headers->set("Pragma", "no-cache" );
        $response->headers->set("Cache-Control", "no-cache" );
        $response->headers->set( "Expires", 0 );
        $response->headers->set("Access-Control-Allow-Origin", "*");
        return $response;
    }

    /**
     * @Route("/recupera-elemento/{nomeDispositivo}", name="preleva_elemento")
     * @Method("GET")
     */
    public function prelevaElementoAction($nomeDispositivo)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RsCollezioneStronatiBundle:Oggetto');
        $oggetto = $repository->getElementoDaSincronizzare($nomeDispositivo);
        $response = new JsonResponse();
        $serializer = $this->container->get('serializer');
        $stringaOggettoJson = $serializer->serialize($oggetto, 'json');
        $response->setData($stringaOggettoJson);
        $response->headers->set("Pragma", "no-cache" );
        $response->headers->set("Cache-Control", "no-cache" );
        $response->headers->set( "Expires", 0 );
        $response->headers->set("Access-Control-Allow-Origin", "*");
        return $response;
    }

    /**
     * @Route("/salva-elemento/{tipoOggetto}", name="salva_elemento")
     * @Method("POST")
     */
    public function salvaElementoAction(Request $request,$tipoOggetto)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RsCollezioneStronatiBundle:Oggetto');
        $oggettoJson = $request->get("oggetto");
        $serializer = $this->container->get('serializer');

        $oggetto = null;

        switch($tipoOggetto){
            case "mignon":
                $oggetto = $serializer->deserialize($oggettoJson,'Rs\CollezioneStronatiBundle\Entity\Mignon','json');
                break;
            case "profumo":
                $oggetto = $serializer->deserialize($oggettoJson,'Rs\CollezioneStronatiBundle\Entity\Profumo','json');
                break;
            case "bicchiere":
                $oggetto = $serializer->deserialize($oggettoJson,'Rs\CollezioneStronatiBundle\Entity\Bicchiere','json');
                break;
            default:
                throw new Exception("Tipo oggetto non valido");
        }
        $idOggettoServer = $oggetto->getId();

        //riconverto la foto in binario
        $ac = new ArrayCollection();
        foreach($oggetto->getFoto() as $foto){
            $valore = base64_decode($foto->getContenuto());
            $foto->setContenuto($valore);
            $foto->setOggetto($oggetto);
            $em->persist($foto);
            $ac->add($foto);
        }
        $oggetto->setFoto($ac);

        //vedo se il produttore già esiste
        $produttore = $em->getRepository("RsCollezioneStronatiBundle:Produttore")->findOneBy(array("nome"=>$oggetto->getProduttore()->getNome()));
        if($produttore != null){
            $oggetto->setProduttore($produttore);
        }
        $oggetto->setId(null);

        $em->persist($oggetto);
        $em->flush();

        $response = new JsonResponse();
        $response->setData($idOggettoServer);
        $response->headers->set("Pragma", "no-cache" );
        $response->headers->set("Cache-Control", "no-cache" );
        $response->headers->set( "Expires", 0 );
        return $response;
    }

    /**
     * @Route("/sincronizza-elemento/{nomeDispositivo}/{id}", name="elemento-sincronizzato")
     * @Method("GET")
     */
    public function oggettoSincronizzatoAction($nomeDispositivo, $id){
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('RsCollezioneStronatiBundle:Oggetto');
        $oggetto = $repository->find($id);

        if($oggetto == null){
            throw new Exception("Oggetto non valido");
        }

        switch($nomeDispositivo){
            case "dispositivoUno":
                $oggetto->setDispositivoUno(true);
                break;
            case "dispositivoDue":
                $oggetto->setDispositivoDue(true);
                break;
            case "dispositivoUno":
                $oggetto->setDispositivoDue(true);
                break;
            default:
                throw new Exception("Dispositivo non valido");
        }

        $em->persist($oggetto);
        $em->flush();

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set("Pragma", "no-cache" );
        $response->headers->set("Cache-Control", "no-cache" );
        $response->headers->set( "Expires", 0 );
        $response->headers->set("Access-Control-Allow-Origin", "*");
        return $response;
    }

}
