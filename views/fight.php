
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./views/styles/style.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="./views/images/Logo.png">
    <title>Dunjeon Xplorer</title>
</head>
<body>
<header>
    <a href="home" class="logo-link">
        <img id="logo" class="logo" src="./views/images/Logo.png" alt="Dungeon Xplorer logo"/>
    </a>
</header>

<div class="sentences">
    <p class="initiative-sentence"><?php echo $this->sentenceInitiative ?> </p>
    <p class="hero-sentence"><?php echo $this->sentenceHero ?> </p>
    <p class="monster-sentence"><?php echo $this->sentenceMonster ?> </p>
</div>

<div id="heroInfo" class="info-card hero-info">
    <h4 class="hero-name"><?php echo $this->hero->name ?> </h4>
    <p class="hero-class">Classe: <?php echo $this->hero->getClass() ?> </p>
    <p class="hero-pv">PV: <?php echo $this->hero->pv ?> </p>
    <p class="hero-mana">Mana: <?php echo $this->hero->mana ?> </p>
    <p class="hero-strength">Force: <?php echo $this->hero->strength ?> </p>
    <p class="hero-initiative">Initiative: <?php echo $this->initiativeAfterReduce ?> </p>
</div>

<div id="MonsterInfo" class="info-card monster-info">
    <h4 class="monster-name"><?php echo $this->monster->name ?> </h4>
    <p class="monster-pv">PV: <?php echo $this->monster->pv ?> </p>
    <p class="monster-mana">Mana: <?php echo $this->monster->mana ?> </p>
    <p class="monster-strength">Force: <?php echo $this->monster->strength ?> </p>
    <p class="monster-initiative">Initiative: <?php echo $this->monster->initiative ?> </p>
</div>

<form action="fight" method="post" class="action-form">
    <div id="choice" class="choice-group">

        <div class ="attack">
            <label for="magicalButton" class="action-label">Attaque magique</label>
            <input type="radio" id="magicalButton" name="actionChoice" value="magical">
        </div>
        
        <div class ="attack">
            <label for="useObjectButton" class="action-label">Utiliser un objet</label>
            <input type="radio" id="useObjectButton" name="actionChoice" value="useObject">
        </div>
        
        <div class ="attack">
            <label for="physicalButton" class="action-label">Attaque physique</label>
            <input type="radio" id="physicalButton" name="actionChoice" value="physical" checked>
        </div>
    </div>

    

    <div id="physicalChoice" class="action-detail physical-choice">
        <label for="weaponSelector" class="weapon-label">Choix de l'arme : </label>
        <select name="weaponSelector" id="weaponSelector" class="weapon-selector">
            <option value="primary">princ.: <?php echo $this->hero->getPrimary()->name ?></option>
            <option value="secondary">secon.: <?php echo $this->hero->getSecondary()->name ?></option>
        </select>
    </div>

    <div id="magicalChoice" class="action-detail magical-choice">
        <p class="magic-placeholder">Sort à faire</p>
    </div>

    <div id="useObjectChoice" class="action-detail object-choice">
        <p class="object-placeholder">Objets à faire</p>
    </div>

    <button id="submit" class="submit-button" type="submit">Valider l'action</button>
</form>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const physicalButton = document.getElementById('physicalButton');
            const physicalChoice = document.getElementById('physicalChoice');
            function togglePhysicalChoiceMenu() {
                if (physicalButton.checked) {
                    physicalChoice.style.display = 'block';
                } else {
                    physicalChoice.style.display = 'none'; }
            }

            togglePhysicalChoiceMenu();

            document.querySelectorAll('input[name="actionChoice"]').forEach(function(radio) {
                radio.addEventListener('change', togglePhysicalChoiceMenu);
            });
        });
    </script>
</body>
</html>
