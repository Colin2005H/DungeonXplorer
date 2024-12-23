<?php
// view/chapter.php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chapter placeholder</title>
</head>
<body>
    <img src="<?php echo $this->chapter->image; ?>" alt="Image de chapitre">
    <p><?php echo $this->chapter->text; ?></p>

    <h2>Choisissez votre chemin:</h2>
    
    <ul>
        <?php foreach ($this->choices as $choice): ?>
            <li>
                <a href="<?php echo "nextchapter/" .$choise->nextChapter; ?>">
                    <?php echo $choice->text; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>


</body>
</html>
