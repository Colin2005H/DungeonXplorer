<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./views/styles/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Dunjeon Xplorer</title>
</head>
<body>
<header>
        <a  href="home">
            <img id = "logo" src="./views/images/Logo.png" alt="Dungeon Xplorer logo"/>
        </a>
</header>
<form class="create-hero-form" action="create" method="post">
            <label class="form-label" for="nom">Nom : </label>
            <input class="form-input" type="text" name="nom" id="inputNomHero">
            <label class="form-label" for="biographie">Biographie : </label>
            <input class="form-input" type="text" name="biographie" id="inputBiographieHero">
            <label class="form-label" for="classe">Classe</label>
            <select class="form-select" name="classe" id="inputClassHero">
                <?php
                    foreach ($this->allClass as $class) {
                        echo '<option value='.htmlspecialchars($class['id']) . '">'. htmlspecialchars($class['name']).'</option>';
                    }
                ?>
            </select>
            <input class="form-submit" type="submit" value="Valider">
        </form>
        <?php $this->printClassesTemplate($this->allClass); ?>
</body>
</html>
