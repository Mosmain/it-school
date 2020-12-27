<?php
require 'libs/rb.php';
R::setup('mysql:host=127.0.0.1;dbname=it_school','root', '');

if ( !R::testconnection() )
{
		exit ('Нет соединения с базой данных');
}

session_start();

$host = '127.0.0.1';
$db   = 'it_school';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);