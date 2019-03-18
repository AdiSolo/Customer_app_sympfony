<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserFormType;
use App\Form\QuoteType;
use App\Form\PassengersType;
use App\Form\TripsType;
use App\Entity\User;
use App\Entity\Quote;
use App\Entity\Passengers;
use App\Entity\Trips;

class DefaultController extends AbstractController
{

    /**
     * @Route("/dashboard", name="app_dashboad")
     * @Method({"GET","POST"})
     * @Template()
     */
     public function index(Request $request){

        $user = new User();

        $form = $this->createForm(UserFormType::class, $user, [
             'action' => $this->generateUrl( 'app_dashboad' ),
             'method' => 'POST'
         ]);

         $em = $this->getDoctrine()->getManager();
         $allPassengers = $em->getRepository(Passengers::class)->findAll();
         $trips = $em->getRepository(Trips::class)->findAll();


         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $quote = $form->getData();
             $em = $this->getDoctrine()->getManager();

             $em->persist($quote);
             $em->flush();

             // set flash messages
             $session = $request->getSession();
             $session->getFlashBag()->add('success', 'Your info was saved');

             return $this->redirect($this->generateUrl("app_dashboad"));
         }

         return [
             'form' => $form->createView(),
             'passengers' => $allPassengers,
             'trips' => $trips
         ];
     }


     /**
      * @Route("/add/passenger", name="add_passenger")
      * @Method({"GET","POST"})
      * @Template()
      */
     public function addPassenger(Request $request)
     {
         $passenger = new Passengers();

         $new_pass_form = $this->createForm(PassengersType::class, $passenger, [
              'action' => $this->generateUrl( 'add_passenger' ),
              'method' => 'POST'
          ]);

          $new_pass_form->handleRequest($request);
          if ($new_pass_form->isSubmitted() && $new_pass_form->isValid()) {
              $passenger = $new_pass_form->getData();
              $em = $this->getDoctrine()->getManager();

              $em->persist($passenger);
              $em->flush();

              // set flash messages
              $session = $request->getSession();
              $session->getFlashBag()->add('success', 'New passenger was saved');

              return $this->redirect($this->generateUrl("app_dashboad"));
          }

          return [
              'pass_form' => $new_pass_form->createView(),
          ];
     }


      /**
       * @Route("/edit/passenger/{passenger}", name="edit_passenger")
       * @Method({"GET","POST"})
       * @Template()
       */
      public function editPassenger(Request $request, Passengers $passenger){

          $form = $this->createForm(PassengersType::class, $passenger, [
              'action' => $this->generateUrl('edit_passenger', ['passenger'=>$passenger->getId()]),
              'method' => 'POST'
          ]);

          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              $passenger = $form->getData();


              $em = $this->getDoctrine()->getManager();
              $em->persist($passenger);
              $em->flush();

              // set flash messages
              $session = $request->getSession();
              $session->getFlashBag()->add('success', 'The passenger has been updated.');

              return $this->redirect($this->generateUrl("app_dashboad"));
          }

          return [
              "pass_form" => $form->createView(),
              "passenger" => $passenger
          ];
      }
      /**
       * @Route("/remove/{passenger}", name="remove_passenger")
       * @Method({"GET"})
       */
      public function removePassenger(Request $request, Passengers $passenger){

          $em = $this->getDoctrine()->getManager();
          $em->remove($passenger);
          $em->flush();

          // set flash messages
          $session = $request->getSession();
          $session->getFlashBag()->add('success', 'The passenger has been removed.');

          return $this->redirect($this->generateUrl("app_dashboad"));
      }


      /**
       * @Route("/add/trip", name="add_trip")
       * @Method({"GET","POST"})
       * @Template()
       */
      public function addTrip(Request $request)
      {
          $trip = new Trips();

          $new_trip_form = $this->createForm(TripsType::class, $trip, [
               'action' => $this->generateUrl( 'add_trip' ),
               'method' => 'POST'
           ]);

           $new_trip_form->handleRequest($request);
           if ($new_trip_form->isSubmitted() && $new_trip_form->isValid()) {
               $trip = $new_trip_form->getData();
               $em = $this->getDoctrine()->getManager();

               $em->persist($trip);
               $em->flush();

               // set flash messages
               $session = $request->getSession();
               $session->getFlashBag()->add('success', 'New trip was saved');

               return $this->redirect($this->generateUrl("app_dashboad"));
           }

           return [
               'trip_form' => $new_trip_form->createView(),
           ];
      }

      /**
       * @Route("/remove/trip/{trips}", name="remove_trip")
       * @Method({"GET"})
       */
      public function removeTrip(Request $request, Trips $trips){

          $em = $this->getDoctrine()->getManager();
          $em->remove($trips);
          $em->flush();

          // set flash messages
          $session = $request->getSession();
          $session->getFlashBag()->add('success', 'The passenger has been removed.');

          return $this->redirect($this->generateUrl("app_dashboad"));
      }


}
