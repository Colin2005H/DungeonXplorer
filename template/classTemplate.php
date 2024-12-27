<!DOCTYPE html>

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