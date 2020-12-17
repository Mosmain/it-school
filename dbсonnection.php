<?php

$options = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO(
  'mysql:dbname=it_school;host=localhost',
  'root',
  '',
  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
);

?>