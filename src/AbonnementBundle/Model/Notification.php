<?php

namespace AbonnementBundle\Model;


class Notification
{
    private $sujet;

    private $resume;

    private $lien;

    /**
     * Notification constructor.
     * @param $sujet
     * @param $resume
     * @param $lien
     */
    public function __construct($sujet, $resume, $lien)
    {
        $this->sujet = $sujet;
        $this->resume = $resume;
        $this->lien = $lien;
    }

    /**
     * @return mixed
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param mixed $sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    /**
     * @return mixed
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * @param mixed $lien
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    }




}