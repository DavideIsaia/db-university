<?php
class Department {
  public $id;
  public $name;
  public $address;
  public $phone;
  public $email;
  public $website;
  public $head_of_department;
  
  function __construct($_id, $_name) {
    $this->id = $_id;
    $this->name = $_name;        
  }
}    
?>