<?php

namespace TravelBundle\Controller;

use TravelBundle\Entity\Torder;
use TravelBundle\Entity\Travel;
use TravelBundle\Entity\Packages;
use TravelBundle\Entity\Amount;
use TravelBundle\Entity\Duration;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Travel controller.
 *
 * @Route("travel")
 */
class TravelController extends Controller
{
    /**
     * Lists all travel entities.
     *
     * @Route("/", name="travel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $travels = $em->getRepository('TravelBundle:Travel')->findAll();

        return $this->render('travel/index.html.twig', array(
            'travels' => $travels,
        ));
    }
 /**
     * Lists all travel entities.
     *
     * @Route("/client/", name="travel_clientindex")
     * @Method("GET")
     */
    public function clientindexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $travels = $em->getRepository('TravelBundle:Travel')->findAll();

        return $this->render('travel/clientindex.html.twig', array(
            'travels' => $travels,
        ));
    }
 /**
     * Lists all travel entities.
     *
     * @Route("/client/contactus", name="travel_client_contact_us")
     * @Method("GET")
     */
    public function clientContactAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('travel/clientcontact.html.twig');
    }

    /**
     * Creates a new travel entity.
     *
     * @Route("/new", name="travel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $travel = new Travel();
        $form = $this->createForm('TravelBundle\Form\TravelType', $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($travel);
            $em->flush();

            return $this->redirectToRoute('travel_show', array('id' => $travel->getId()));
        }

        return $this->render('travel/new.html.twig', array(
            'travel' => $travel,
            'form' => $form->createView(),
        ));
    }

    /**
    //     * Finds and displays a travel entity.
    //     *
    //     * @Route("/{id}", name="travel_show")
    //     * @Method("GET")
    //     */
    public function showAction(Travel $id)
    {

        $em = $this->getDoctrine()->getManager();
        $travelRep = $em->getRepository("TravelBundle:Travel");
        $travel = $travelRep->findOneById($id);

        $em=$this->getDoctrine()->getManager();
        $packagesRep = $em->getRepository('TravelBundle:Packages');
        $packagesAll= $packagesRep->findByTravel($travel);

        $em=$this->getDoctrine()->getManager();
        $durationRep = $em->getRepository('TravelBundle:Duration');
        $durationAll= $durationRep->findByTravel($travel);

        $em=$this->getDoctrine()->getManager();
        $amountRep = $em->getRepository('TravelBundle:Amount');
        $amountAll= $amountRep->findByTravel($travel);

        return $this->render('travel/show.html.twig', array(
            'travel' => $travel,
            'packageAll' => $packagesAll,
            'durationAll' => $durationAll,
            'amountAll' => $amountAll,
        ));


    }
 /**
    //     * Finds and displays a travel entity.
    //     *
    //     * @Route("/client/{id}", name="travel_clientshow")
    //     * @Method({"GET", "POST"})
    //     */
    public function clientShowAction(Request $request, Travel $id)
    {

        $em = $this->getDoctrine()->getManager();
        $travelRep = $em->getRepository("TravelBundle:Travel");
        $travel = $travelRep->findOneById($id);

        $em=$this->getDoctrine()->getManager();
        $packagesRep = $em->getRepository('TravelBundle:Packages');
        $packagesAll= $packagesRep->findByTravel($travel);

        $em=$this->getDoctrine()->getManager();
        $durationRep = $em->getRepository('TravelBundle:Duration');
        $durationAll= $durationRep->findByTravel($travel);

        $em=$this->getDoctrine()->getManager();
        $amountRep = $em->getRepository('TravelBundle:Amount');
        $amountAll= $amountRep->findByTravel($travel);
        $torder = new Torder();
        $form = $this->createForm('TravelBundle\Form\TorderType', $torder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($torder);
            $em->flush();

            return $this->redirectToRoute('torder_show', array('id' => $torder->getId()));
        }

        return $this->render('travel/clientshow.html.twig', array(
            'travel' => $travel,
            'packageAll' => $packagesAll,
            'durationAll' => $durationAll,
            'amountAll' => $amountAll,
            'torder' => $torder,
            'form' => $form->createView(),
        ));


    }





    /**
     * Displays a form to edit an existing travel entity.
     *
     * @Route("/{id}/edit", name="travel_edit") 
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $travelRepository = $em->getRepository("TravelBundle:Travel");
        $travel = $travelRepository->findOneById($id);
        if (!$travel) {
            throw $this->createNotFoundException('No travel found for id '.$id);
        }
        $form = $this->modifyTravelFormular($travel, 'travel_edit', ['id'=>$id]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $travel = $form->getData();
            $em->persist($travel);
            $em->flush();
            return $this->redirectToRoute('travel_show', array('id' => $travel->getId()));
        }
        return $this->render('travel/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Deletes a travel entity.
     *
     * @Route("/{id}", name="travel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Travel $travel)
    {
        $form = $this->createDeleteForm($travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($travel);
            $em->flush();
        }

        return $this->redirectToRoute('travel_index');
    }

    /**
     * Creates a form to delete a travel entity.
     *
     * @param Travel $travel The travel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($travel, $routeName, $slugs=[])
    {
        $form = $this->createFormBuilder($travel)
            ->setAction($this->generateURL($routeName, $slugs))
            ->setMethod('POST')
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('price_from', TextType::class, ['label' => 'Price From'])
            ->add('date_from', DateType::class, ['label' => 'Date From'])
            ->add('description', TextType::class, ['required' => false,'label' => 'Description'])
            ->add('save', SubmitType::class, ['label' => 'Create',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }


    protected function modifyTravelFormular($travel, $routeName, $slugs=[])
    {
        $form = $this->createFormBuilder($travel)
            ->setAction($this->generateURL($routeName, $slugs))
            ->setMethod('POST')
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('price_from', TextType::class, ['label' => 'Price From'])
            ->add('date_from', DateType::class, ['label' => 'Date From'])
            ->add('description', TextType::class, ['required' => false,'label' => 'Description'])
            ->add('save', SubmitType::class, ['label' => 'Edit',
                'attr' => ['class' => 'btn btn-default pull-right']])
            ->getForm();
        return $form;
    }
}
