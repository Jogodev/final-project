<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'categories')]    
    /**
     * Récupère les categories de la base de données
     *
     * @param CategoriesRepository $categories [explicite description]
     *
     * @return Response
     */
    public function index(CategoriesRepository $categories): Response
    {
        return $this->render('categories/index.html.twig', [
            'categories' => $categories->findAll(),
        ]);
    }

    // if ($bookingForm->isSubmitted() && $bookingForm->isValid()) {

    //     //On récupère le user
    //     $user = $this->getUser();

    //     $booking->setUser($user)
    //             ->setCreatedAt(new \DateTime())
    //             ->setCars($car);
    //     $conditionDate = false;
        
    //     $date = $repos->findBy[
    //             [
    //             'startDate' > $bookingForm->getData('date'),
    //             'endDate' < $bookingForm->getData('date')
    //             ]
    //         ];
    //     for($i = 0; $i < count($date); $i++){
    //         if($date[i]['car'] == $car){
    //             $conditionDate = true;
    //         }
    //     }
    //     if($conditionDate == true){
    //       // message d'erreur
    //     }
    //   else {
    //     $em->persist($booking);
    //     $em->flush();
    //   }
    // }
}
