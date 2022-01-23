<?php

namespace App\Controller;
use App\Entity\UpdatePassword;
use App\Entity\Users;
use App\Form\UpdateUserType;
use App\Form\UpdatePasswordType;
use App\Services\BookingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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

    /**
     * hash
     *
     * @var UserPasswordHasherInterface
     */
    private $hash;

    public function __construct(BookingService $bs, EntityManagerInterface $em, UserPasswordHasherInterface $hash)
    {
        $this->bs = $bs;
        $this->em = $em;
        $this->hash = $hash;
    }

    #[Route('/users', name: 'users')]    
    /**
     * Permet de récupérer les réservation du user
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'booking' => $this->bs->bookingsList(),
        ]);
    }

    #[Route('/users/update', name: 'users_update')]
    /**
     * Method pour que l'utilisateur puisse changer certaines information sur son profil
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

        if ($formUser->isSubmitted() && $formUser->isValid()) {
            $this->em->persist($user);
            $this->em->flush();

            $this->addFlash('message', 'Votre profil a bien été mis à jour');
            return $this->redirectToroute('users');
        }
        return $this->render('users/updateUser.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }
    #[Route('/users/updatepassword', name: 'users_update_password')]
    public function updatePassword(Request $request): Response
    {
        $password = new UpdatePassword();

        $formUpdate = $this->createForm(UpdatePasswordType::class, $password);

        $formUpdate->handleRequest($request);

        if ($formUpdate->isSubmitted() && $formUpdate->isValid()) {
            $formData = $formUpdate->getData();
            $user = $this->getUser();
            $newPassword = $formData->getNewPassword();
            $confirmPassword = $formData->getConfirmPassword();

            if ((!password_verify($password->getCurrentPassword(), $user->getPassword())))
            {
                
                $this->addFlash('error', 'Le mot de passe ne correspond pas au mot de passe actuel');
            } if($newPassword != $confirmPassword) {
                $this->addFlash('error', 'Les deux mots de passes ne sont pas identiques');
            }
        }
        return $this->render('users/updatePassword.html.twig', [
            'formUpdate'=>$formUpdate->createView(),
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
