<?php

namespace App\Controller;
use App\Repository\SalesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalesController extends AbstractController
{
    #[Route('/sales', name: 'sales')]
    public function index(SalesRepository $sales): Response
    {
        return $this->render('sales/index.html.twig', [
            'sales' => $sales->findAll(),
        ]);
    }
}
