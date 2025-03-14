<?php
session_start(); 

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
} else {
    $username = "Invité"; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/styles/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="./views/images/Logo.png">
    <title>Dunjeon Xplorer</title>
</head>

<body>
    <header>
        <a  href="home">
        <img id = "logo" src="../views/images/Logo.png" alt="Dungeon Xplorer logo"/>
        </a>
        <h1>Bienvenue, <?php echo htmlspecialchars($username); ?> !</h1>
    </header>
    <div class="profil-action">
        <form action="/DungeonXplorer/deleteaccount" method="post">
            <button class= "delete-button" type="submit">Supprimer mon compte</button>
        </form>
        <form action="/DungeonXplorer/logout" method="post">
            <button class= "logout-button" type="submit">Déconnexion</button>
        
    </div>

</body>

</html>