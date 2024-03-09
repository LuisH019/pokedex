<?php
$server = "127.0.0.1";
$user = "root";
$pass = "";
$database = "db_pokedex";

$conn = new PDO ("mysql:host=$server;dbname=$database", $user, $pass);
?>