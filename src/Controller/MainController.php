<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use App\Entity\BookingSearch;
use App\Form\BookingSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{

    /**
     * cars
     *
     * @var CarsRepository
     */
    private $cars;

    public function __construct(CarsRepository $cars)
    {
        $this->cars = $cars;
    }


    #[Route('/', name: 'home')]    
    /**
     * Permet de trouver une voiture a louer a partir d'une recherche
     *
     * @param PaginatorInterface $paginator [Pagination des voiture issues de la recherche]
     * @param Request $request [explicite description]
     *
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new BookingSearch();
        $formSearch = $this->createForm(BookingSearchType::class, $search);
        $formSearch->handleRequest($request);

        $cars = $paginator->paginate(
            $this->cars->findByQuery($search),
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('main/index.html.twig', [
            'cars' => $this->cars->findByQuery($search),
            'formSearch' => $formSearch->createView(),
            'cars' => $cars
        ]);
    }








    // #[Route('/', name: 'home')]
    // public function index(): Response
    // {
    //     return $this->render('main/index.html.twig', [
    //         'controller_name' => 'MainController',
    //     ]);
    // }
}
