<?php

namespace App\Controller;

use App\Form\BookingsType;
use App\Entity\Bookings;
use App\Entity\Cars;
use App\Repository\CarsRepository;
use App\Repository\CategoriesRepository;
use App\Services\BookingService;
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


    #[Route('/bookings', name: 'bookings')]
    public function index(BookingService $bookingService): Response
    {
        return $this->render('bookings/index.html.twig', [
            'car' => $bookingService->carslist(),
            'categories' => $bookingService->categorieslist(),
        ]);
    }

    #[Route('/bookings/{car}', name: 'new_booking')]    
        
    
    public function newBooking(Request $request, EntityManagerInterface $em, Cars $car): Response
    {
        $booking = new Bookings();
        $bookingForm = $this->createForm(BookingsType::class, $booking);

        $bookingForm->handleRequest($request);

        if ($bookingForm->isSubmitted() && $bookingForm->isValid()) {
            
            //On récupère le user
            $user = $this->getUser();

            $booking->setUser($user)
                    ->setCreatedAt(new \DateTime())
                    ->setCars($car);

            $em->persist($booking);
            $em->flush();

            
        }

        return $this->render('bookings/new.html.twig', [
            'bookingForm' => $bookingForm->createView(),
            'car' => $car,          
        ]);
    }
}
