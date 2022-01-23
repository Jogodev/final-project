<?php

namespace App\Controller;

use App\Form\BookingsType;
use App\Entity\Bookings;
use App\Entity\Cars;
use App\Repository\BookingsRepository;
use App\Services\BookingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingsController extends AbstractController

{

    /**
     * em
     *
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * bs
     *
     * @var BookingService
     */
    private $bs;
    /**
     * br
     *
     * @var BookingsRepository
     */
    private $br;


    public function __construct(EntityManagerInterface $em, BookingService $bs, BookingsRepository $br)
    {
        $this->em = $em;
        $this->bs = $bs;
        $this->br = $br;
    }


    #[Route('/bookings', name: 'bookings')]
    public function index(): Response
    {
        return $this->render('bookings/index.html.twig', [
            'car' => $this->bs->carslist(),
            'categories' => $this->bs->categorieslist(),
        ]);
    }

    #[Route('/bookings/{car}', name: 'new_booking')]


    /**
     * Permet au user connecté de faire une reservation
     *
     * @param Request $request [explicite description]
     * @param Cars $car [explicite description]
     *
     * @return Response
     */
    public function newBooking(Request $request, Cars $car): Response
    {
        $booking = new Bookings();
        $bookingForm = $this->createForm(BookingsType::class, $booking);

        $bookingForm->handleRequest($request);

        if ($bookingForm->isSubmitted() && $bookingForm->isValid()) {
            //On récupère les data du formulaire pour pouvoir comparé les dates
            $FormData = $bookingForm->getData();

            $bookStartDate = $FormData->getStartDate();
            $bookEndDate = $FormData->getEndDate();

            //On récupère le user
            $user = $this->getUser();

            $booking->setUser($user)
                ->setCreatedAt(new \DateTime())
                ->setCars($car);


            $bookablesDates = $this->br->findByDate($car, $bookStartDate, $bookEndDate);
            if ($bookablesDates == NULL) {

                
                $this->em->persist($booking);
                $this->em->flush();
                $this->addFlash("success", "Votre réservation a bien été prise en compte");
                return $this->redirectToRoute('booking_show');
            } else {
                $this->addFlash("warning", "Ce vehicule est déjà réservé à ces dates, choisissez d'autres dates ou un autre vehicule");
            }
        }

        return $this->render('bookings/new.html.twig', [
            'bookingForm' => $bookingForm->createView(),
            'car' => $car,
            'categories' => $this->bs->categorieslist(),
        ]);
    }

    #[Route('/bookings/{id}', name: 'bookings_show')]
    public function show(Bookings $booking): Response
    {
        return $this->render('bookings/show.html.twig', [
            'booking' => $booking,
        ]);
    }
}
