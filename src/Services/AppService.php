<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AppService
{
    private MailerInterface $mailInterface;

    public function __construct(MailerInterface $mailInterface)
    {
        $this->mailInterface = $mailInterface;
    }

    public function envoiUnMail($utilisateur)
    {
        $mail = (new Email())
            ->from("RoberDeLaCompta@series.com")
            ->to("admin@series.com")
            ->subject("Le sujet de mon mail")
            ->text($utilisateur." vient de créer un compte.")
            ->html("")
            ->priority(Email::PRIORITY_HIGHEST);
        $this->mailInterface->send($mail);
    }

    public function ecritDansUnFichier(
        $valeurAecrire
    ): void
    {
        file_put_contents(
            "service.txt",
            $valeurAecrire . PHP_EOL,
            FILE_APPEND
        );
    }
}