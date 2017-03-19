<?php

namespace Rs\CollezioneStronatiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Rs\CollezioneStronatiBundle\Entity\Mignon;
use Rs\CollezioneStronatiBundle\Form\BaseType\MignonType;

/**
 * Mignon controller.
 *
 * */
class MignonController extends CollezioneStronatiController
{
    protected $entityOggetto = 'RsCollezioneStronatiBundle:Mignon';

    /**
     * Lists all Mignon entities.
     *
     * @Route("/elenco/{pagina}/{produttore}", defaults={"pagina" = 1, "produttore"=null}, name="mignon")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($pagina,$produttore)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RsCollezioneStronatiBundle:Mignon')->getMignonPaginate($produttore, $pagina);
        $produttori = $em->getRepository('RsCollezioneStronatiBundle:Produttore')->findProduttoriPerOggetto($this->entityOggetto);
        return array(
            'oggetti' => $entities,
            'produttori' => $produttori,
            'pagina' => $pagina,
            'produttore' => $produttore
        );
    }
    /**
     * Creates a new Mignon entity.
     *
     * @Route("/", name="mignon_create")
     * @Method("POST")
     * @Template("RsCollezioneStronatiBundle:Mignon:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Mignon();
        $formBuilder = $this->get('rs.collezionestronati.form.builder');
        $form = $formBuilder->generaNuovoOggettoForm('Rs\CollezioneStronatiBundle\Form\BaseType\MignonType',
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
            return $this->redirect($this->generateUrl('mignon_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Mignon entity.
     *
     * @Route("/new", name="mignon_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mignon();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Mignon entity.
     *
     * @Route("/mostra/{id}/{pagina}/{produttore}",defaults={"pagina" = 1, "produttore"=null}, name="mignon_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id,$pagina,$produttore)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RsCollezioneStronatiBundle:Mignon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mignon entity.');
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
     * Displays a form to edit an existing Mignon entity.
     *
     * @Route("/{id}/edit/{pagina}/{produttore}", defaults={"pagina" = 1, "produttore"=null}, name="mignon_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id,$pagina,$produttore)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RsCollezioneStronatiBundle:Mignon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mignon entity.');
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
    * Creates a form to edit a Mignon entity.
    *
    * @param Mignon $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mignon $entity, $pagina,$produttore)
    {
        $form = $this->createForm(new MignonType(), $entity, array(
            'action' => $this->generateUrl('mignon_update', array('id' => $entity->getId())),
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
     * Edits an existing Mignon entity.
     *
     * @Route("/{id}", name="mignon_update")
     * @Method("PUT")
     * @Template("RsCollezioneStronatiBundle:Mignon:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RsCollezioneStronatiBundle:Mignon')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mignon entity.');
        }

        $pagina = $request->get("rs_collezionestronatibundle_mignon")["pagina"];
        $produttore = $request->get("rs_collezionestronatibundle_mignon")["filtroProduttore"];

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity, $pagina, $produttore);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('mignon_show', array('id' => $id, 'pagina'=>$pagina, 'produttore'=>$produttore)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Mignon entity.
     *
     * @Route("/{id}", name="mignon_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RsCollezioneStronatiBundle:Mignon')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mignon entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mignon'));
    }

    /**
     * Creates a form to delete a Mignon entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mignon_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
