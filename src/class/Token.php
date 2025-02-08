<?php

class Token
{
    private $id_token;
    private $token;
    private $ref_user;

    public function __construct($array){
        $this->hydrate($array);
    }
    public function hydrate($array){
        foreach ($array as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdToken()
    {
        return $this->id_token;
    }

    /**
     * @param mixed $id_token
     */
    public function setIdToken($id_token)
    {
        $this->id_token = $id_token;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getRefUser()
    {
        return $this->ref_token;
    }

    /**
     * @param mixed $ref_token
     */
    public function setRefUser($ref_user)
    {
        $this->ref_user = $ref_user;
    }
}