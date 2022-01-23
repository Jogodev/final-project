<?php

namespace App\Controller;


use App\Services\BookingService;
use App\Repository\BookingsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CarsController extends AbstractController
{

    /**
     * bs
     *
     * @var BookingService
     */
    private $bs;
    /**
     * bookingsRepository
     *
     * @var BookingsRepository
     */
    private $br;

    public function __construct(BookingService $bs, BookingsRepository $br)
    {
        $this->bs = $bs;
        $this->br = $br;
    }




    #[Route('/cars', name: 'cars')]
    /**
     * Method index affiche tout les vehicules
     *
     * @param BookingService $bookingservice [récupère les method dans booking service]
     *
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $cars = $paginator->paginate(
            $this->bs->carsList(),
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('cars/index.html.twig', [
            'cars' => $cars,
            'categories' => $this->bs->categoriesList(),
            
        ]);
    }

    #[Route('/categories/{categId}', name: 'carsbycateg')]
    /**
     * Permet d'afficher les vehicule selon la categorie choisi
     *
     * @param  $categId [Id de la catégorie]
     *
     * @return Response
     */
    public function carsByCateg(PaginatorInterface $paginator, Request $request, int $categId): Response
    {
        $cars = $paginator->paginate(
            $this->bs->carsList($categId),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('cars/index.html.twig', [
            'cars' => $cars,
            'carscateg' => $this->bs->carsList($categId),
            'categories' => $this->bs->categoriesList(),

        ]);
    }

    #[Route('/cars/{carId}', name: 'carsbyid')]
    public function singleCar(int $carId): Response
    {
        return $this->render('cars/single.html.twig', [
            'cars'=> $this->bs->singleCar($carId),
        ]);
    }

     // #[Route('/cars', name: 'cars')]
    // public function index(CarsRepository $cars): Response
    // {
    //     return $this->render('cars/index.html.twig', [
    //         'car' => $cars->findAll(),
    //     ]);
    // }


}
