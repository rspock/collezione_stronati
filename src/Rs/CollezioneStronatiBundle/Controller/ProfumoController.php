<?php

namespace Rs\CollezioneStronatiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Rs\CollezioneStronatiBundle\Entity\Profumo;
use Rs\CollezioneStronatiBundle\Form\BaseType\ProfumoType;

/**
 * Profumo controller.
 *
 */
class ProfumoController extends CollezioneStronatiController
{
    protected $entityOggetto = 'RsCollezioneStronatiBundle:Profumo';

    /**
     * Lists all Profumo entities.
     *
     * @Route("/elenco/{pagina}/{produttore}", defaults={"pagina" = 1, "produttore"=null}, name="profumo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($pagina,$produttore)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RsCollezioneStronatiBundle:Profumo')->getProfumiPaginate($produttore, $pagina);
        $produttori = $em->getRepository('RsCollezioneStronatiBundle:Produttore')->findProduttoriPerOggetto($this->entityOggetto);
        return array(
            'oggetti' => $entities,
            'produttori' => $produttori,
            'pagina' => $pagina,
            'produttore' => $produttore
        );
    }
    /**
     * Creates a new Profumo entity.
     *
     * @Route("/", name="profumo_create")
     * @Method("POST")
     * @Template("RsCollezioneStronatiBundle:Profumo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Profumo();
        $formBuilder = $this->get('rs.collezionestronati.form.builder');
        $form = $formBuilder->generaNuovoOggettoForm('Rs\CollezioneStronatiBundle\Form\BaseType\ProfumoType',
            $entity,
            'mignon_create');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $uploadManager = $this->get('rs.collezionestronati.foto.upload');
            foreach ($entity->getFoto() as $foto) {
                $foto->setOggetto($entity);
                $em->persist($foto);
                $uploadManager->deleteFile($foto->getNome());

            }
            $em->flush();

            $repository = $em->getRepository('RsCollezioneStronatiBundle:Foto');
            $foto = $repository->findBy(array("oggetto"=>null));
            if(count($foto)>0){
                return $this->redirect($this->generateUrl("cataloga_immagini"));
            }

            return $this->redirect($this->generateUrl('profumo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Profumo entity.
     *
     * @Route("/new", name="profumo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Profumo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Profumo entity.
     *
     * @Route("/mostra/{id}/{pagina}/{produttore}",defaults={"pagina" = 1, "produttore"=null}, name="profumo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id,$pagina,$produttore)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RsCollezioneStronatiBundle:Profumo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profumo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'pagina'=>$pagina,
            'produttore'=>$produttore
        );
    }

    /**
     * Displays a form to edit an existing Profumo entity.
     *
     * @Route("/{id}/edit/{pagina}/{produttore}", defaults={"pagina" = 1, "produttore"=null}, name="profumo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id,$pagina,$produttore)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RsCollezioneStronatiBundle:Profumo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profumo entity.');
        }

        $editForm = $this->createEditForm($entity,$pagina,$produttore);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'pagina'=>$pagina,
            'produttore'=>$produttore
        );
    }

    /**
    * Creates a form to edit a Profumo entity.
    *
    * @param Profumo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Profumo $entity,$pagina,$produttore)
    {
        $form = $this->createForm(new ProfumoType(), $entity, array(
            'action' => $this->generateUrl('profumo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('pagina', 'hidden', array(
            'data' => $pagina,"mapped" => false
        ));

        $form->add('filtroProduttore', 'hidden', array(
            'data' => $produttore,"mapped" => false
        ));

        return $form;
    }
    /**
     * Edits an existing Profumo entity.
     *
     * @Route("/{id}", name="profumo_update")
     * @Method("PUT")
     * @Template("RsCollezioneStronatiBundle:Profumo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RsCollezioneStronatiBundle:Profumo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Profumo entity.');
        }

        $pagina = $request->get("rs_collezionestronatibundle_profumo")["pagina"];
        $produttore = $request->get("rs_collezionestronatibundle_profumo")["filtroProduttore"];

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity, $pagina, $produttore);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('profumo_show', array('id' => $id, 'pagina'=>$pagina, 'produttore'=>$produttore)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Profumo entity.
     *
     * @Route("/{id}", name="profumo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RsCollezioneStronatiBundle:Profumo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Profumo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('profumo'));
    }

    /**
     * Creates a form to delete a Profumo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('profumo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
