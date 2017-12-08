<?php

namespace TravelBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use TravelBundle\Entity\Torder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Torder controller.
 *
 * @Route("torder")
 */
class TorderController extends Controller
{
    /**
     * Lists all torder entities.
     *
     * @Route("/", name="torder_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $torders = $em->getRepository('TravelBundle:Torder')->findAll();

        return $this->render('torder/index.html.twig', array(
            'torders' => $torders,
        ));
    }

    /**
     * Creates a new torder entity.
     *
     * @Route("/new", name="torder_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $torder = new Torder();
        $form = $this->createForm('TravelBundle\Form\TorderType', $torder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($torder);
            $em->flush();

            return $this->redirectToRoute('torder_show', array('id' => $torder->getId()));
        }

        return $this->render('torder/new.html.twig', array(
            'torder' => $torder,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new travel entity.
     *
     * @Route("/new/add/{id}", name="travelorder_new")
     * @Method({"GET", "POST"})
     */
    public function neworderAction(Request $request, $id)
    {
        $torder = new Torder();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('TravelBundle:Travel');
        $travel = $repository->findOneById($id);

        $form = $this->createForm($torder, 'travelorder_new',  ['id'=>$id]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($torder);
            $em->flush();

            return $this->redirectToRoute('travel_clientshow', array('id' => $torder->getId()));
        }

        return $this->render('torder/newtest.html.twig', array(
            'torder' => $torder,
            'form' => $form->createView(),
        ));
    }




    /**
     * Finds and displays a torder entity.
     *
     * @Route("/{id}", name="torder_show")
     * @Method("GET")
     */
    public function showAction(Torder $torder)
    {
        $deleteForm = $this->createDeleteForm($torder);

        return $this->render('torder/show.html.twig', array(
            'torder' => $torder,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing torder entity.
     *
     * @Route("/{id}/edit", name="torder_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Torder $torder)
    {
        $deleteForm = $this->createDeleteForm($torder);
        $editForm = $this->createForm('TravelBundle\Form\TorderType', $torder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('torder_edit', array('id' => $torder->getId()));
        }

        return $this->render('torder/edit.html.twig', array(
            'torder' => $torder,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a torder entity.
     *
     * @Route("/{id}", name="torder_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Torder $torder)
    {
        $form = $this->createDeleteForm($torder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($torder);
            $em->flush();
        }

        return $this->redirectToRoute('torder_index');
    }




    private function createorderForm($torder, $routeName, $id)
    {
        $form = $this->createFormBuilder($torder)
            ->setAction($this->generateURL($routeName,  ['id' => $id]))
            ->setMethod('POST')
            ->add('travel', TextType::class, ['label' => 'Name'])
            ->add('package', TextType::class, ['required' => false,'label' => 'Price From'])
            ->add('amount', DateType::class, ['label' => 'Date From'])
            ->add('duration', TextType::class, ['label' => 'Description'])
            ->add('comments', DateType::class, ['required' => false,'label' => 'Date From'])
            ->add('totalPrice', DateType::class, ['label' => 'Date From'])
            ->add('save', SubmitType::class, ['label' => 'Create',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }


    /**
     * Creates a form to delete a torder entity.
     *
     * @param Torder $torder The torder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Torder $torder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('torder_delete', array('id' => $torder->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
