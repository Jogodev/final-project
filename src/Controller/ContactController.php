<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Services\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function send(Request $request, MailerService $mailerService): Response
    {
        $contactForm = $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contactData = $contactForm->getData();

            $mailerService->sendEmail(
                from:($contactData['email']),
                to:('jonathan.plastivene@gmail.com'),
                subject:('Nouvel email de '.$contactData['nom'].''),
                text:($contactData['message'])
            );
                $this->addFlash('success', 'Votre message a bien été envoyé');

                return $this->redirectToRoute('contact');
            //Envoi du mail
            dd($contactData);
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
