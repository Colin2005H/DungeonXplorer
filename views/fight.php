
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer</title>
</head>
<body>
    <div id="heroInfo">
        <h4><?php echo "'".$hero->name."'" ?> </h4>
        <p>Classe: <?php echo "'".$hero->getClass()."'" ?> </p>
        <p>PV: <?php echo "'".$hero->pv."'" ?> </p>
        <p> Mana: <?php echo "'".$hero->mana."'" ?> </p>
        <p>Force:<?php echo "'".$hero->strength."'" ?> </p>
        <p>Initiative:<?php echo "'".$hero->initiative."'" ?> </p>

    </div>

    <div id="MonsterInfo">
        <h4><?php echo "'".$monster->name."'" ?> </h4>
        <p><?php echo "'".$monster->pv."'" ?> </p>
        <p> Mana: <?php echo "'".$monster->mana."'" ?> </p>
        <p>Force:<?php echo "'".$monster->strength."'" ?> </p>
        <p>Initiative:<?php echo "'".$monster->initiative."'" ?> </p>
    </div>

    <form action="fight" method=post>
        <div id = "choice">
            <input type="radio" id="physical " name="actionChoice" value="physical" checked>
            <label for="physical"> Attaque physique </label>

            <input type="radio" id="magical " name="actionChoice" value="magical" >
            <label for="magical"> Attaque magique </label>

            <input type="radio" id="useObject" name="actionChoice" value="useObject" >
            <label for="useObject"> Utiliser un objet </label>
        </div>


        <div id ="physicalChoice">
            <label for="weaponSelector">Choix de l'arme </label>
            <select name="weaponSelector" id="weaponSelector">
                <option value= "primary"> princ.: <?php echo $hero->primary_wp->name ?> </option>
                <option value = "secondary">secon.: <?php echo $hero->secondary_wp->name ?> </option>
            </select>
        </div>

        <div id="magicalChoice">
            <label for="spellSelector">Choix du sort </label>
            <select name="spellSelector" id="spellSelector">
                <option value= <?php echo "'".$hero->primary_wp->name."'" ?>> princ.: <?php echo $hero->primary_wp->name ?> </option>
                <option value = <?php echo "'".$hero->secondary_wp->name."'" ?>>secon.: <?php echo $hero->secondary_wp->name ?> </option>
            </select>
        </div>

        <div id="useObjectChoice">
            <label for="spellSelector">Choix du sort </label>
            <select name="spellSelector" id="spellSelector">
                <option value= <?php echo "'".$hero->primary_wp->name."'" ?>> princ.: <?php echo $hero->primary_wp->name ?> </option>
                <option value = <?php echo "'".$hero->secondary_wp->name."'" ?>>secon.: <?php echo $hero->secondary_wp->name ?> </option>
            </select>
        </div>


        <button id="submit" type="submit">Valider l'action</button>

    </form>
    
</body>
<script>
    let physicalChoice = document.getElementById("physicalChoice");
    let magicalChoice = document.getElementById("magicalChoice");
    let useObjectChoice = document.getElementById("useObjectChoice");
    let physicalButton = document.getElementById("physical");
    let magicalButton = document.getElementById("magical");
    let useObjectButton = document.getElementById("useObject");
        


    physicalButton.addEventListener("click", ()=>{
        magicalChoice.style.display ="none";
        useObjectChoice.style.display ="none";
        physicalChoice.style.display =" block"

    })

    magicalButton.addEventListener("click", ()=>{
        physicalChoice.style.display ="none";
        useObjectChoice.style.display ="none";
        magicalChoice.style.display =" block"

    })

    useObjectChoice.addEventListener("click", ()=>{
        magicalChoice.style.display ="none";
        physicalChoice.style.display ="none";
        useObjectChoice.style.display =" block"

    })


   /* let monster = <?php// echo "'".$monster->name."'" ?>;
   let test = document.getElementById("test");
   console.log(monster);*/

   


</script>
</html>