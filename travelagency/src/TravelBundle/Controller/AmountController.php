<?php

namespace TravelBundle\Controller;

use TravelBundle\Entity\Amount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Amount controller.
 *
 * @Route("amount")
 */
class AmountController extends Controller
{
    /**
     * Lists all amount entities.
     *
     * @Route("/", name="amount_index")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        $amounts = $em->getRepository('TravelBundle:Amount')->findAll();

        return $this->render('amount/index.html.twig', array(
            'amounts' => $amounts,
        ));
    }

    /**
     * Creates a new amount entity.
     *
     * @Route("/new", name="amount_new")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $amount = new Amount();
        $form = $this->createForm('TravelBundle\Form\AmountType', $amount);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($amount);
            $em->flush();

            return $this->redirectToRoute('amount_show', array('id' => $amount->getId()));
        }

        return $this->render('amount/new.html.twig', array(
            'amount' => $amount,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a amount entity.
     *
     * @Route("/{id}", name="amount_show")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function showAction(Amount $amount)
    {
        $deleteForm = $this->createDeleteForm($amount);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        return $this->render('amount/show.html.twig', array(
            'amount' => $amount,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing amount entity.
     *
     * @Route("/{id}/edit", name="amount_edit")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Amount $amount)
    {
        $deleteForm = $this->createDeleteForm($amount);
        $editForm = $this->createForm('TravelBundle\Form\AmountType', $amount);
        $editForm->handleRequest($request);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('amount_edit', array('id' => $amount->getId()));
        }

        return $this->render('amount/edit.html.twig', array(
            'amount' => $amount,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a amount entity.
     *
     * @Route("/{id}", name="amount_delete")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Amount $amount)
    {
        $form = $this->createDeleteForm($amount);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($amount);
            $em->flush();
        }

        return $this->redirectToRoute('amount_index');
    }

    /**
     * Creates a form to delete a amount entity.
     *
     * @param Amount $amount The amount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Amount $amount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('amount_delete', array('id' => $amount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
