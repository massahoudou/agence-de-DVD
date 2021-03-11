<?php
namespace App\Notification;

use App\Entity\Contact;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactNotification {
    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(Swift_Mailer $mailer, Environment  $renderer)
    {

    }

    /**
     * @param Contact $contact
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function notify (Contact $contact)
    {

      $message = (new Swift_Message(' Agence : '.$contact->getProprietes()->getTitre()))
                ->setFrom($contact->getEmail())
                ->setTo('contact@agence.tg')
                ->setSubject('Reservation')
                ->setBody( 'hello');
      dump($message);
        $this->mailer->send($message);
    }
}