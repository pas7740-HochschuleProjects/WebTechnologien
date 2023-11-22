<?php
require "start.php";
namespace Model;
use JsonSerializable;

class User implements JsonSerializable {
private $username;
function getUsername(){
    return $this->username;
}

public function __construct(&$username){
    $this->username = $username;
}

public function __toString(){
    return "User ist ".$this->username;
}

public function jsonSerialize(){
       return get_object_vars($this);
}
static function fromJson($data){

 foreach ($data as $key => $value) {
  $user->{$key} = $value;
 }

}
}
?>