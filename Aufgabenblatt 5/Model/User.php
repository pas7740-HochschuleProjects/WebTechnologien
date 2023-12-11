<?php

namespace Model;

use JsonSerializable;

class User implements JsonSerializable {
    private $username;

    // User settings
    private $firstname;
    private $lastname;
    private $favdrink;
    private $description;
    private $favlayout;


    public function getUsername(){
        return $this->username;
    }

    public function __construct($username = null){
        $this->username = $username;
    }

    public function __toString(){
        return "User ist ".$this->username;
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }

    public static function fromJson($data){
        $user = new User();
        foreach ($data as $key => $value) {
            $user->{$key} = $value;
        }
        return $user;
    }

    // Getter
    function getFirstname()
    {
        return $this->firstname;
    }

    function getLastname()
    {
        return $this->lastname;
    }

    function getFavdrink()
    {
        return $this->favdrink;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getFavlayout()
    {
        return $this->favlayout;
    }

    // Setter
    function setFirstname($firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    function setLastname($lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    function setFavdrink($favdrink): self
    {
        $this->favdrink = $favdrink;
        return $this;
    }

    function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    function setFavlayout($favlayout): self
    {
        $this->favlayout = $favlayout;
        return $this;
    }
}

?>