<?php
$conn = new mysqli('localhost', 'root', '', 'it_school');
if ($conn->connect_error)
	die("Connection Failed!".$conn->connect_error)
?>