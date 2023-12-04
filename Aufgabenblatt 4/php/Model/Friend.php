<?php

namespace Model;

use JsonSerializable;

class Friend implements JsonSerializable{
    private $username;
    private $status;

    public function __construct($username = null){
        $this->username = username;
    }

    public function __toString(){
        return "User ist: ".$this->username
    }

    public function getStatus(){
        return $this->status;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setDismissed(){
        $this->status = dismissed;
    }

    public function setAccepted(){
        $this->status = accepted;
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