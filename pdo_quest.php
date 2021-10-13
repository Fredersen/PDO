<?php
require_once './connec.php';

$pdo = new PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

var_dump($friends);