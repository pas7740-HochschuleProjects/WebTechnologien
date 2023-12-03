<?php
require "start.php";
namespace Model;
use JsonSerializable;

class Friend implements JsonSerializable{
private $username;
private $status;

public function __construct(&$username){
    $this->username = username;
}

public function __toString(){
    return "User ist: ".$this->username
}

function getStatus(){
    return $this->status;
}

function getUsername(){
    return $this->username;
}

function setDismissed(){
    $this->status = dismissed;
}

function setAccepted(){
    $this->status = accepted;
}

public function jsonSerialize(){
       return get_object_vars($this);
}
}
?>