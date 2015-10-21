<?php

namespace AbonnementBundle\Service;
use AbonnementBundle\Entity\AbonneRepository;
use AbonnementBundle\Model\Mail;
use AbonnementBundle\Model\Notification;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NotificationManager
{
    /**
     * @var ContainerInterface
     * Conteneur de services Symfony
     */
    private $container;

    private $mailer;

    private $templating;

    /**
     * @var AbonneRepository
     * Le repository
     */
    private $repo;

    /**
     * @var
     * L'adresse mail de l'expéditeur
     */
    private $mailSender;

    /**
     * @var
     * L'objet du mail
     */
    private $mailSubject;

    public function __construct(ContainerInterface $container, \Swift_Mailer $mailer, EngineInterface $templating, AbonneRepository $repo, $mailSender, $mailSubject)
    {
        $this->container = $container;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->repo = $repo;
        $this->mailSender = $mailSender;
        $this->mailSubject = $mailSubject;
    }

    public function envoyerMailTousLesAbonnes(Notification $notif) {
        //On récupère tous les abonnés en base de donnée
        $abonnes = $this->repo->findAll();

        //On construit le mail à envoyer (objet, corps du message, inclusion d'images)
        $objet = str_replace("{SUJET}", $notif->getSujet(), $this->mailSubject);
        $message = \Swift_Message::newInstance($objet);
        $urlLogoSopra = "http://localhost".$this->container->get('templating.helper.assets')->getUrl('images/logo.png');
        $urlLogoSopra = $message->embed(\Swift_Image::fromPath($urlLogoSopra));

        $message
            ->setFrom($this->mailSender)
            ->setBody(
                $this->templating->render(
                    'AbonnementBundle:Abonne:mail.html.twig',
                    array(
                        "lien" => $notif->getLien(),
                        "resume" => $notif->getResume(),
                        "urlImage" => $urlLogoSopra
                    )
                ),
                'text/html'
            )
        ;

        //On envoie un mail à chaque abonné :
        foreach($abonnes as $abonne) {
            $message->setTo($abonne->getMail());
            $this->mailer->send($message);
        }
    }
}