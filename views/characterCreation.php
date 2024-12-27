<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/HeroCreation.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer</title>
</head>
<body>
    <form action="../controllers/HeroCreationController.php" method="post">
        <label for="nom">Nom : </label>
        <input type="text" name="nom" id="inputNomHero">
        <label for="biographie">Biographie : </label>
        <input type="text" name="biographie" id="inputBiographieHero">
        <label for="classe">Classe</label>
        <select name="classe" id="inputClassHero">
            <?php foreach(HeroCreation::getAllClasses() as $class): ?>
                <option value="<?= htmlspecialchars($class['id']) ?>"><?= htmlspecialchars($class['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Valider">
    </form>
    <?php HeroCreation::printClassesTemplate(HeroCreation::getAllClasses()); ?>
</body>
</html>
