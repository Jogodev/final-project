<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use App\Entity\Cars;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarsController extends AbstractController
{
    #[Route('/cars', name: 'cars')]
    public function index(CarsRepository $cars): Response
    {
        return $this->render('cars/index.html.twig', [
            'car' => $cars->findAll(),
        ]);
    }

    // #[Route('/cars/{categId}', name: 'carsbycateg')]
    // public function carsByCateg(ManagerRegistry $doctrine, int $categId): Response
    // {
    //     $repository = $doctrine->getRepository(Cars::class);
    //     $cars = $repository->findby(['categories'=> $categId]);
    //     return $this->render('cars/cars.html.twig', [
            
    //     ]);
    // }

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
