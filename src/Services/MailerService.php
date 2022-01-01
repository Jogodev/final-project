<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;

class MailerService
{
    
    /**
     * mailer
     *
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(string $subject, string $from, string $to, string $text): void
    {

        $email = (new Email())
        ->from($from)
        ->to($to)
        ->subject($subject)
        ->text($text);

        $this->mailer->send($email);
    }




}
