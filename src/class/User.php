<?php

class User
{
    private $id_user;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $role;
    public function __construct(array $array){
        $this->hydrate($array);
    }
    public function hydrate(array $array){
        foreach ($array as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function getId_User()
    {
        return $this->id_user;
    }

    public function setId_User($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

}