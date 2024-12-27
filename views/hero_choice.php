<?php
// Inclure votre fichier avec la classe Hero
require_once '../session/Hero.php';

// Récupérer la liste des héros
$heroes = Hero::getAllHeroes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un Héro</title>
    <link rel="stylesheet" href="../views/styles/style.css">
</head>
<body>

    <h1>Choisissez un Héro</h1>
    <!--renvoie vers la page process pour le traitement -->
    <form action="processHeroChoice" method="POST">
        <!--menu deroulant pour choisir le hero  -->
        <select name="hero_id" required>
            <option value="">Choisissez</option>
            <?php
           
            foreach ($heroes as $hero) {
                echo "<option value='{$hero->id}'>{$hero->name}</option>";
            }
            ?>
        </select>

        <button type="submit">Sélectionner</button>
    </form>

</body>
</html>
