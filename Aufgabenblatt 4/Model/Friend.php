<?php

namespace Model;

use JsonSerializable;

class Friend implements JsonSerializable{
    private $username;
    private $status;

    public function __construct($username = null){
        $this->username = $username;
    }

    public function __toString(){
        return "User ist: ".$this->username;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getLastname(){
        return $this->lastname;
    }

    public function getFavDrink(){
        return $this->favdrink;
    }

    public function jsonSerialize(){
        return get_object_vars($this);
    }

    public static function fromJson($data){
        $friend = new Friend();
        foreach ($data as $key => $value) {
            $friend->{$key} = $value;
        }
        return $friend;
    }
}

?>