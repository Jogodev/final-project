<?php

namespace App\Controller;

use App\Form\BookingsType;
use App\Entity\Bookings;
use App\Entity\Cars;
use Datetime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingsController extends AbstractController
// {
//     #[Route('/bookings', name: 'bookings')]
//     public function index(): Response
//     {
//         return $this->render('bookings/index.html.twig', [
//             'controller_name' => 'BookingsController',
//         ]);
//     }
// }

{
    #[Route('/bookings', name: 'new_booking')]    
    
    /**
     * Method newBooking
     *
     * @param Request $request [explicite description]
     * @param EntityManagerInterface $em [explicite description]
     * @param Cars $car [explicite description]
     *
     * @return Response
     */
    public function newBooking(Request $request, EntityManagerInterface $em, /*Cars $car*/): Response
    {
        $booking = new Bookings();
        $bookingForm = $this->createForm(BookingsType::class, $booking);

        $bookingForm->handleRequest($request);

        if ($bookingForm->isSubmitted() && $bookingForm->isValid()) {

            $user = $this->getUser();
            
            
            $booking->setUser($user)
                    ->setCreatedAt(new DateTime());
                    //->setCars($car);

            $em->persist($booking);
            $em->flush();

            $this->addFlash('success', 'La réservation a bien été prise en compte!');
        }

        return $this->render('bookings/new.html.twig', [
            'bookingForm' => $bookingForm->createView(),
            //'car' => $car,          
        ]);
    }
}
