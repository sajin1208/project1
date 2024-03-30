<?php
error_reporting(E_ALL);
try{
$connection = mysqli_connect('localhost','root','','register');    
}
catch(exception $ex){
  die('Database error:' . $ex->message());
}
    ?>