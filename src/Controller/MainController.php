<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Services\MailerService;

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
     * Permet de trouver une voiture a louer à partir d'une recherche
     *
     * @param PaginatorInterface $paginator [Pagination des voiture issues de la recherche]
     * @param Request $request [explicite description]
     *
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request, MailerService $mailerService): Response
    {
        $search = new BookingSearch();
        $formSearch = $this->createForm(BookingSearchType::class, $search);
        $formSearch->handleRequest($request);

        $cars = $paginator->paginate(
            $this->cars->findByQuery($search),
            $request->query->getInt('page', 1),
            3
        );
        $contactForm = $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);
        $mess = "";
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contactData = $contactForm->getData();

            if (strlen($contactData['message']) < 50) {
                $mess='Le message doit être superieur à 50 caractères';
            } elseif (strlen($contactData['message']) > 500) {
                $mess='Le message doit être inferieur à 500 caractères';
            } else {
                $mailerService->sendEmail(
                    from: ($contactData['email']),
                    to: ('jonathan.plastivene@gmail.com'),
                    subject: ('email de ' . $contactData['nom'] . ' ' . 'pour une' . ' ' . $contactData['sujet'] . ''),
                    text: ($contactData['message'])
                    
                );
                $this->addFlash('success', 'Votre message a bien été envoyé');
                return $this->redirectToRoute('home');
            }
        }

        return $this->render('main/index.html.twig', [
            'cars' => $this->cars->findByQuery($search),
            'formSearch' => $formSearch->createView(),
            'cars' => $cars,
            'contactForm' => $contactForm->createView(),
            'errormessage' => $mess,
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
