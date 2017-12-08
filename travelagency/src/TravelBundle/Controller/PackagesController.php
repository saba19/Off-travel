<?php

namespace TravelBundle\Controller;

use TravelBundle\Entity\Packages;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Package controller.
 *
 * @Route("packages")
 */
class PackagesController extends Controller
{
    /**
     * Lists all package entities.
     *
     * @Route("/", name="packages_index")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $packages = $em->getRepository('TravelBundle:Packages')->findAll();
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        return $this->render('packages/index.html.twig', array(
            'packages' => $packages,
        ));
    }

    /**
     * Creates a new package entity.
     *
     * @Route("/new", name="packages_new")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $package = new Packages();
        $form = $this->createForm('TravelBundle\Form\PackagesType', $package);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($package);
            $em->flush();

            return $this->redirectToRoute('packages_show', array('id' => $package->getId()));
        }

        return $this->render('packages/new.html.twig', array(
            'package' => $package,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a package entity.
     *
     * @Route("/{id}", name="packages_show")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function showAction(Packages $package)
    {
        $deleteForm = $this->createDeleteForm($package);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        return $this->render('packages/show.html.twig', array(
            'package' => $package,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing package entity.
     *
     * @Route("/{id}/edit", name="packages_edit")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Packages $package)
    {
        $deleteForm = $this->createDeleteForm($package);
        $editForm = $this->createForm('TravelBundle\Form\PackagesType', $package);
        $editForm->handleRequest($request);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('packages_edit', array('id' => $package->getId()));
        }

        return $this->render('packages/edit.html.twig', array(
            'package' => $package,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a package entity.
     *
     * @Route("/{id}", name="packages_delete")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Packages $package)
    {
        $form = $this->createDeleteForm($package);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($package);
            $em->flush();
        }

        return $this->redirectToRoute('packages_index');
    }

    /**
     * Creates a form to delete a package entity.
     *
     * @param Packages $package The package entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Packages $package)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('packages_delete', array('id' => $package->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
