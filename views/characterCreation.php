<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer</title>
</head>
<body>
    <form action="./create" method="post">
        <label for="nom">Nom : </label>
        <input type="text" name="nom" id="inputNomHero">
        <label for="biographie">Biographie : </label>
        <input type="text" name="biographie" id="inputBiographieHero">
        <label for="classe">Classe</label>
        <select name="classe" id="inputClassHero">
            <?php
                foreach ($this->allClass as $class) {
                    echo '<option value='.htmlspecialchars($class['id']) . '">'. htmlspecialchars($class['name']).'</option>';
                }
            ?>
        </select>
        <input type="submit" value="Valider">
    </form>
    <?php $this->printClassesTemplate($this->allClass); ?>
</body>
</html>
