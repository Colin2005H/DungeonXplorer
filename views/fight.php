
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer</title>
</head>
<body>
    <p> monstre ? : <?php echo $mo ?></p>
    <p> hero ?   <?php echo $he ?></p>
    <p> sentence : <?php echo $this->sentence ?></p>
    <p> degats monstre:  <?php echo $this->damMon ?></p>
    <p> degats hero <?php echo $this->effectiveDamage ?></p>
    <div id="heroInfo">
        <h4><?php echo $this->hero->name ?> </h4>
        <p>Classe: <?php echo $this->hero->getClass() ?>  </p>
        <p>PV: <?php echo $this->hero->pv ?> </p>
        <p> Mana: <?php echo $this->hero->mana ?> </p>
        <p>Force:<?php echo $this->hero->strength ?> </p>
        <p>Initiative:<?php echo $this->hero->initiative ?> </p>

    </div>

    <div id="MonsterInfo">
        <h4><?php echo $this->monster->name ?> </h4>
        <p><?php echo $this->monster->pv ?> </p>
        <p> Mana: <?php echo $this->monster->mana ?> </p>
        <p>Force:<?php echo $this->monster->strength ?> </p>
        <p>Initiative:<?php echo $this->monster->initiative ?> </p>
    </div>

    <form action="fight" method=post>
        <div id = "choice">
            <input type="radio" id="physicalButton " name="actionChoice" value="physical" checked>
            <label for="physicalButton"> Attaque physique </label>

            <input type="radio" id="magicalButton " name="actionChoice" value="magical" >
            <label for="magicalButton"> Attaque magique </label>

            <input type="radio" id="useObjectButton" name="actionChoice" value="useObject" >
            <label for="useObjectButton"> Utiliser un objet </label>
        </div>


        <div id ="physicalChoice">
            <label for="weaponSelector">Choix de l'arme </label>
            <select name="weaponSelector" id="weaponSelector">
                <option value= "primary"> princ.: <?php echo $this->hero->primary_wp->name ?> </option>
                <option value = "secondary">secon.: <?php echo $this->hero->secondary_wp->name ?> </option>
            </select>
        </div>

        <div id="magicalChoice">
            <p> sort todo</p>
        </div>

        <div id="useObjectChoice">
            <p> objets todo</p>
        </div>


        <button id="submit" type="submit">Valider l'action</button>

    </form>
    
</body>
<script>
    
  
    let physicalChoice = document.getElementById("physicalChoice");
    let magicalChoice = document.getElementById("magicalChoice");
    let useObjectChoice = document.getElementById("useObjectChoice");
    let allButtons = document.querySelectorAll('input[name="actionChoice"]');
    magicalChoice.style.display ="none";
    useObjectChoice.style.display ="none";
    allButtons[0].addEventListener("change", ()=>{
        magicalChoice.style.display ="none";
        useObjectChoice.style.display ="none";
        physicalChoice.style.display =" block";

    })

    allButtons[1].addEventListener("change", ()=>{
        physicalChoice.style.display ="none";
        useObjectChoice.style.display ="none";
        magicalChoice.style.display =" block"

    })

    allButtons[2].addEventListener("change", ()=>{
        magicalChoice.style.display ="none";
        physicalChoice.style.display ="none";
        useObjectChoice.style.display =" block"

    })


   /* let monster = <?php// echo $monster->name ?>;
   let test = document.getElementById("test");
   console.log(monster);*/

   


</script>
</html>