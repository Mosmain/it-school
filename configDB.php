<?php

$host = 'localhost';
$database = 'dbname';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$localhost;dbname=$it_school;";
$options = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $user, $pass, $options);

?>