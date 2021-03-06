<?php

namespace AbonnementBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AbonnementBundle\Entity\Abonne;
use AbonnementBundle\Form\AbonneType;

/**
 * Abonne controller. Partie ADMIN. CRUD.
 *
 * @Route("/admin/abonnement")
 */
class AbonneController extends Controller
{

    /**
     * Lists all Abonne entities.
     *
     * @Route("/", name="admin_abonnement")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AbonnementBundle:Abonne')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Abonne entity.
     *
     * @Route("/", name="admin_abonnement_create")
     * @Method("POST")
     * @Template("AbonnementBundle:Abonne:Admin:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Abonne();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_abonnement_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Abonne entity.
     *
     * @param Abonne $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Abonne $entity)
    {
        $form = $this->createForm(new AbonneType(), $entity, array(
            'action' => $this->generateUrl('admin_abonnement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Abonne entity.
     *
     * @Route("/new", name="admin_abonnement_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Abonne();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Abonne entity.
     *
     * @Route("/{id}", name="admin_abonnement_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AbonnementBundle:Abonne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Abonne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Abonne entity.
     *
     * @Route("/{id}/edit", name="admin_abonnement_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AbonnementBundle:Abonne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Abonne entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Abonne entity.
    *
    * @param Abonne $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Abonne $entity)
    {
        $form = $this->createForm(new AbonneType(), $entity, array(
            'action' => $this->generateUrl('admin_abonnement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Abonne entity.
     *
     * @Route("/{id}", name="admin_abonnement_update")
     * @Method("PUT")
     * @Template("AbonnementBundle:Abonne:Admin:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AbonnementBundle:Abonne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Abonne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_abonnement_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Abonne entity.
     *
     * @Route("/{id}", name="admin_abonnement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AbonnementBundle:Abonne')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Abonne entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_abonnement'));
    }

    /**
     * Creates a form to delete a Abonne entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_abonnement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
