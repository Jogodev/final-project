<?php

namespace App\Controller;


use App\Entity\UpdatePassword;
use App\Form\UpdateUserType;
use App\Form\UpdatePasswordType;
use App\Form\ConfirmType;
use App\Services\BookingService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;
use App\Security\EmailVerifier;
use App\Security\UsersAuthenticator;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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



    public function __construct(BookingService $bs, EntityManagerInterface $em, UserPasswordHasherInterface $hash, EmailVerifier $emailVerifier)
    {
        $this->bs = $bs;
        $this->em = $em;
        $this->hash = $hash;
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/users', name: 'users')]

    public function index(): Response
    {
        return $this->render('users/index.html.twig', []);
    }

    #[Route('/users/booking', name: 'users_bookings')]
    /**
     * Permet de récupérer les réservation du user
     *
     * @return Response
     */
    public function userBooking(): Response
    {
        return $this->render('users/userBooking.html.twig', [
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

            $this->addFlash('success', 'Votre profil a bien été mis à jour');
            return $this->redirectToroute('users');
        }
        return $this->render('users/updateUser.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }

    #[Route('/users/updatepassword', name: 'users_update_password')]
    /**
     * Permet a l'utilisateur de changer son mot de passe
     *
     * @param Request $request [explicite description]
     *
     * @return Response
     */
    public function updatePassword(Request $request): Response
    {
        $password = new UpdatePassword();

        $formUpdate = $this->createForm(UpdatePasswordType::class, $password);

        $formUpdate->handleRequest($request);

        if ($formUpdate->isSubmitted() && $formUpdate->isValid()) {
            $formData = $formUpdate->getData();
            $user = $this->getUser();
            $pass = true;
            if (!password_verify($password->getCurrentPassword(), $user->getPassword())) {
                $formUpdate->get('currentPassword')->addError(new FormError('Le mot de passe actuel ne correspond pas'));
            } else {
                $newPassword = $this->hash->hashPassword($user, $password->getNewPassword());
                $user->setPassword($newPassword);
                $this->em->persist($user);
                $this->em->flush();
                $this->addFlash('success', 'Votre mot de passe a bien été mis à jour');
                return $this->redirectToroute('users');
            }
        }
        return $this->render('users/updatePassword.html.twig', [
            'formUpdate' => $formUpdate->createView(),
        ]);
    }

    #[Route('/users/confirm', name: 'users_confirm_email')]


    public function confirmEmail(): Response
    {
        $user = $this->getUser();
        $message = "Le mail de confirmation vous a été renvoyer";
        // generate a signed url and email it to the user
        $this->emailVerifier->sendEmailConfirmation(
            'app_verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('no-reply@carma-auto.com', 'Confirmation de votre email'))
                ->to($user->getEmail())
                ->subject('Confirmer votre email')
                ->htmlTemplate('registration/confirmation_email.html.twig')

        );

        // do anything else you need here, like send an email
        return $this->render('users/confirmation.html.twig', [
            'message' => $message,
        ]);
    }
}
    // #[Route('/users', name: 'users')]
    // public function index(): Response
    // {
    //     return $this->render('users/index.html.twig', [
    //         'controller_name' => 'UsersController',
    //     ]);
    // }
