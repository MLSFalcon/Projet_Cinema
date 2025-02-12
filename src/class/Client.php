<?php
require_once "User.php";
class Client extends User
{
    private $adresseFacturation;

    public function __construct(array $array)
    {
        parent::__construct($array);
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

    /**
     * @return mixed
     */
    public function getAdresseFacturation()
    {
        return $this->adresseFacturation;
    }

    /**
     * @param mixed $adresseFacturation
     */
    public function setAdresseFacturation($adresseFacturation)
    {
        $this->adresseFacturation = $adresseFacturation;
    }

}