<?php


namespace App\Notification;

use App\Entity\Contact;
use Swift_Message;
use Twig\Environment;

class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;


    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        if ($contact->getEmail() === null) {
            $sentTo = "";
        } else {
            $sentTo = $contact->getEmail();
        }

        $message = (new Swift_Message('Nouvel email de ' . $contact->getLastname() . " " . $contact->getFirstname()))
            ->setFrom($sentTo)
            ->setTo('pmt@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }
}
