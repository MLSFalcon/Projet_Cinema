<?php
class Contact
{
    private $id_contact;
    private $sujet;
    private $explication;
    private $ref_user;

    public function __construct($array){
        $this->hydrate($array);
    }
    public function hydrate($array){
        foreach ($array as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId_contact()
    {
        return $this->id_contact;
    }

    public function setId_contact($id_contact)
    {
        $this->id_contact = $id_contact;
    }

    public function getSujet()
    {
        return $this->sujet;
    }

    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    public function getExplication()
    {
        return $this->explication;
    }

    public function setExplication($explication)
    {
        $this->explication = $explication;
    }

    public function getRef_user()
    {
        return $this->ref_user;
    }

    public function setRef_user($ref_user)
    {
        $this->ref_user = $ref_user;
    }

}