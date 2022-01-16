<?php

namespace App\Controller;
use App\Repository\SalesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SalesController extends AbstractController
{        
    /**
     * em
     *
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * sr
     *
     * @var SalesRepository
     */
    private $sr;

    public function __construct(EntityManagerInterface $em, SalesRepository $sr)
    {
        $this->em = $em;
        $this->sr = $sr;
    }

    #[Route('/sales', name: 'sales')]
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        
        //$query = $this->em->createQuery($this->sr->findAll());

        $sales = $paginator->paginate(
            $this->sr->findAll(),
            $request->query->getInt('page',1),
            9
        );
        
        return $this->render('sales/index.html.twig', [
            'sales' => $sales,
        ]);
    }
}
