<?php

class Etudiant extends Model
{
    private $matricule;
    private $prenom;
    private $nom;
    private $mail;
    private $telephone;
    private $dateNaissance;
    private $boursier;
    private $typeBourse;
    private $montantBourse;
    private $estLoge;
    private $datefistInscription;
    private $chambre;
    private $address;
    public function __construct($data = [])
    {
        $this->hydrate($data);
    }

    /**
     * Get the value of matricule
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set the value of matricule
     *
     * @return  self
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of dateNaissance
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set the value of dateNaissance
     *
     * @return  self
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get the value of mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of boursier
     */
    public function getBoursier()
    {
        return $this->boursier;
    }

    /**
     * Set the value of boursier
     *
     * @return  self
     */
    public function setBoursier($boursier)
    {
        $this->boursier = $boursier;

        return $this;
    }

    /**
     * Get the value of typeBourse
     */
    public function getTypeBourse()
    {
        return $this->typeBourse;
    }

    /**
     * Set the value of typeBourse
     *
     * @return  self
     */
    public function setTypeBourse($typeBourse)
    {
        $this->typeBourse = $typeBourse;

        return $this;
    }

    /**
     * Get the value of montantBourse
     */
    public function getMontantBourse()
    {
        return $this->montantBourse;
    }

    /**
     * Set the value of montantBourse
     *
     * @return  self
     */
    public function setMontantBourse($montantBourse)
    {
        $this->montantBourse = $montantBourse;

        return $this;
    }

    /**
     * Get the value of estLoge
     */
    public function getEstLoge()
    {
        return $this->estLoge;
    }

    /**
     * Set the value of estLoge
     *
     * @return  self
     */
    public function setEstLoge($estLoge)
    {
        $this->estLoge = $estLoge;

        return $this;
    }

    /**
     * Get the value of datefistInscription
     */
    public function getDatefistInscription()
    {
        return $this->datefistInscription;
    }

    /**
     * Set the value of datefistInscription
     *
     * @return  self
     */
    public function setDatefistInscription($datefistInscription)
    {
        $this->datefistInscription = $datefistInscription;

        return $this;
    }

    /**
     * Get the value of telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of chambre
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * Set the value of chambre
     *
     * @return  self
     */
    public function setChambre($chambre)
    {
        $this->chambre = $chambre;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }
}