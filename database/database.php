<?php
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'iac';

  try{
    $connection = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    //$connection=mysqli_connect($server,$username,$password,$database);
  }catch(PDOException $e){
    die('Conexion a Base de Datos Fallida' . $e->getMesseage());
  }
?>
