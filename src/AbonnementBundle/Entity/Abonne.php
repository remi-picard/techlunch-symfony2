<?php

namespace AbonnementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Abonne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AbonnementBundle\Entity\AbonneRepository")
 * @UniqueEntity("mail", message="Cette adresse mail est déjà utilisée")
 * @ORM\HasLifecycleCallbacks()
 */
class Abonne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     * @Assert\NotBlank(message = "L'adresse mail doit être renseignée")
     * @Assert\Email(
     *     message = "L'adresse mail '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     */
    private $mail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnregistrement", type="datetime")
     */
    private $dateEnregistrement;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Abonne
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set dateEnregistrement
     *
     * @param \DateTime $dateEnregistrement
     * @return Abonne
     */
    public function setDateEnregistrement($dateEnregistrement)
    {
        $this->dateEnregistrement = $dateEnregistrement;

        return $this;
    }

    /**
     * Get dateEnregistrement
     *
     * @return \DateTime 
     */
    public function getDateEnregistrement()
    {
        return $this->dateEnregistrement;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateEnregistrementValue()
    {
        $this->dateEnregistrement = new \DateTime();
    }
}
