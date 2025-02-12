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
    public function getRef_user()
    {
        return $this->ref_user;
    }

    /**
     * @param mixed $ref_token
     */
    public function setRef_user($ref_user)
    {
        $this->ref_user = $ref_user;
    }
}