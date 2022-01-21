<?php

namespace App\Controller;
use App\Form\UpdateUserType;
use App\Services\BookingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class UsersController extends AbstractController
{
    /**
     * bs
     *
     * @var BookingService
     */
    private $bs;
    
    /**
     * em
     *
     * @var EntityManager
     */
    private $em;

    public function __construct(BookingService $bs, EntityManagerInterface $em)
    {
        $this->bs = $bs;
        $this->em = $em;
    }

    #[Route('/users', name: 'users')]
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'booking' => $this->bs->bookingsList(),
        ]);
    }

    #[Route('/users/update', name: 'users_update')]    
    /**
     * Method pour que l'utilisateur puisse changer son email 
     *
     * @param Request $request [explicite description]
     *
     * @return Response
     */
    public function updateUser(Request $request): Response
    {
        $user = $this->getUser();
        $formUser = $this->createForm(UpdateUserType::class, $user);

        $formUser->handleRequest($request);

        if ($formUser->isSubmitted() && $formUser->isValid()) 
        {
            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('message', 'Profil mis a jour');
            return $this->redirectToroute('users');
        }
        return $this->render('users/updateuser.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }








    // #[Route('/users', name: 'users')]
    // public function index(): Response
    // {
    //     return $this->render('users/index.html.twig', [
    //         'controller_name' => 'UsersController',
    //     ]);
    // }
}
