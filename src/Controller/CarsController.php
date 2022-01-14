<?php

namespace App\Controller;


use App\Services\BookingService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{

    private $bookingservice;

    public function __construct(BookingService $BookingService)
    {
        $this->bookingservice = $BookingService;
    }




    #[Route('/cars', name: 'cars')]    
    /**
     * Method index affiche tout les vehicules
     *
     * @param BookingService $bookingservice [récupère les method dans booking service]
     *
     * @return Response
     */
    public function index(BookingService $bookingservice): Response
    {
        return $this->render('cars/index.html.twig', [
            'cars' => $this->bookingservice->carsList(),
            'categories' => $this->bookingservice->categoriesList(),
            'bookings' => $this->bookingservice->bookingsList(),

        ]);
    }

    #[Route('/cars/{categId}', name: 'carsbycateg')]    
    /**
     * Permet d'afficher les vehicule selon la categorie choisi
     *
     * @param  $categId [Id de la catégorie]
     *
     * @return Response
     */
    public function carsByCateg(int $categId): Response
    {
        
        return $this->render('cars/index.html.twig', [
            'cars'=> $this->bookingservice->carsList($categId),
            'categories' => $this->bookingservice->categoriesList(),

            
        ]);
    }

    // #[Route('/cars', name: 'cars')]
    // public function index(CarsRepository $cars): Response
    // {
    //     return $this->render('cars/index.html.twig', [
    //         'car' => $cars->findAll(),
    //     ]);
    // }

    // #[Route('/cars', name: 'cars')]
    // public function index(CarsRepository $cars): Response
    // {
    //     return $this->render('cars/index.html.twig', [
    //         'car' => $cars->findAll(),
    //     ]);
    // }
}
