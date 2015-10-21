<?php

namespace AbonnementBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AbonnementBundle\Entity\Abonne;
use AbonnementBundle\Form\AbonneType;

/**
 * Abonne controller.
 *
 * Accessible à tous.
 *
 * Create Only.
 *
 * @Route("/abonnement")
 */
class AbonneController extends Controller
{
    /**
     * Creates a new Abonne entity.
     *
     * @Route("/", name="abonnement_create")
     * @Method("POST")
     * @Template("AbonnementBundle:Abonne:new.html.twig")
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

            return $this->redirect($this->generateUrl('abonnement_show', array('id' => $entity->getId())));
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
            'action' => $this->generateUrl('abonnement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Abonne entity.
     *
     * @Route("/", name="abonnement_new")
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

}
