<?php

require_once '../base/Database.php';
    

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
    <label for="ad_id">Choisissez une aventure :</label>
    <select name="ad_id" id="ad_id" required>
        <option value="">Choisissez</option>
        
        <?php
        $adventures = $GLOBALS["base"]->request("SELECT * FROM Adventure");

        if (empty($adventures)) {
            echo "<option value=''>Aucune aventure trouvée</option>";
        } else {
            foreach ($adventures as $adventure) {
                echo "<option value='{$adventure->ad_id}'>{$adventure->ad_name}</option>";
            }
        }
        ?>
        
    </select>
    <button type="submit">Envoyer</button>
</form>

</body>
</html>
