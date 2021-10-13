<?php

require_once './connec.php';
$pdo = new PDO(DSN, USER, PASS);

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);

if($id !== false)
{
 $query= "DELETE FROM friend WHERE id=:id";
 $statement = $pdo->prepare($query);
 $statement->bindValue(':id', $id);
 $statement->execute();
 header('Location: index.php');
}

