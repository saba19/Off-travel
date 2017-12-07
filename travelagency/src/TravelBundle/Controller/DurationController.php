<?php

namespace TravelBundle\Controller;

use TravelBundle\Entity\Duration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Duration controller.
 *
 * @Route("duration")
 */
class DurationController extends Controller
{
    /**
     * Lists all duration entities.
     *
     * @Route("/", name="duration_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $durations = $em->getRepository('TravelBundle:Duration')->findAll();

        return $this->render('duration/index.html.twig', array(
            'durations' => $durations,
        ));
    }

    /**
     * Creates a new duration entity.
     *
     * @Route("/new", name="duration_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $duration = new Duration();
        $form = $this->createForm('TravelBundle\Form\DurationType', $duration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($duration);
            $em->flush();

            return $this->redirectToRoute('duration_show', array('id' => $duration->getId()));
        }

        return $this->render('duration/new.html.twig', array(
            'duration' => $duration,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a duration entity.
     *
     * @Route("/{id}", name="duration_show")
     * @Method("GET")
     */
    public function showAction(Duration $duration)
    {
        $deleteForm = $this->createDeleteForm($duration);

        return $this->render('duration/show.html.twig', array(
            'duration' => $duration,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing duration entity.
     *
     * @Route("/{id}/edit", name="duration_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Duration $duration)
    {
        $deleteForm = $this->createDeleteForm($duration);
        $editForm = $this->createForm('TravelBundle\Form\DurationType', $duration);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('duration_edit', array('id' => $duration->getId()));
        }

        return $this->render('duration/edit.html.twig', array(
            'duration' => $duration,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a duration entity.
     *
     * @Route("/{id}", name="duration_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Duration $duration)
    {
        $form = $this->createDeleteForm($duration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($duration);
            $em->flush();
        }

        return $this->redirectToRoute('duration_index');
    }

    /**
     * Creates a form to delete a duration entity.
     *
     * @param Duration $duration The duration entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Duration $duration)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('duration_delete', array('id' => $duration->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
