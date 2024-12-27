<!DOCTYPE html>
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
    <div class="class_template">
        <!-- Ajouter une image si vous voulez -->
        <h3><?php echo $name ?></h3>
        <p><?php echo $description?></p>
        <ul>
            <li>PV : <?php echo $base_pv ?> </li>
            <li>Mana : <?php echo $base_mana ?></li>
            <li>Initiative : <?php echo $base_initiative ?></li>
            <li>Force : <?php echo $base_strength ?></li>
            <li>Poids limite : <?php echo $base_weight_limit ?></li>
            <li>Quantité maximum d'objet <?php echo $base_qte_item_limit?></li>
        </ul>
    </div>
</body>
</html>