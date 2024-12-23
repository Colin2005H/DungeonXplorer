<?php

require_once '../base/Database.php';
$adventures[] = $GLOBALS["base"]->request("SELECT ad_id FROM Adventure");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une aventure</title>
    <link rel="stylesheet" href="../views/styles/style.css">
</head>
<body>

    <h1>Choisissez une aventure</h1>
    <!--renvoie vers la page process pour le traitement -->
    <form action="" method="POST">
        <!--menu deroulant pour choisir l'aventure  -->
        <select name="ad_id" required>
            <option value="">Choisissez</option>
            <?php
           
            foreach ($adventures as $adventure) {
                echo "<option value='{$adventure->ad_id}'>{$adventure->ad_id}</option>";
            }
            ?>
        </select>

        <button type="submit">Sélectionner</button>
    </form>

</body>
</html>
