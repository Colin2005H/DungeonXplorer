<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Adventure</title>
</head>
<body>
    <h2> Aventures </h2>
    <div>
        <?php
            foreach($adventure as $ad){
             echo "<div> <p>".$adventure["ad_name"]."</p> </div>";
            }
        ?>
    </div>
</body>
</html>