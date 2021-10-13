<?php

// Connexion à la base de données avec PDO

require_once './connec.php';
$pdo = new PDO(DSN, USER, PASS);


// Function à utiliser pour tester les inputs

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
};

// Ajout de données dans la liste :

if (!empty($_POST['firstname']) && !empty($_POST['lastname'])) {
$firstname = test_input($_POST['firstname']);
$lastname = test_input($_POST['lastname']);
$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
$statement = $pdo->prepare($query);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->execute();
$friends = $statement->fetchAll();
}

// Récupération des données 



$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

?> 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="index.php">
        <div>
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required="required">
        </div>
        <div>
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" required="required">
        </div>
        <div class="button">
            <input type="submit" name="submit" value="Ajouter un ami">
        </div>
    </form>
    <ul>
        <?php

        // Afficher la liste des friends dans une liste

        foreach ($friends as $friend) {
            echo "<li>" . $friend['firstname'] . " " . $friend['lastname'] . " <a href='delete.php?id=". $friend['id'] ."'>supprimer</a></li> ";
        }

        ?>
    </ul>
</body>

</html>