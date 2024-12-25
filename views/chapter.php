<?php
// view/chapter.php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chapter placeholder</title>
    <link rel="stylesheet" href="./views/styles/chapter_style.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">

</head>
<body>
    <img src="<?php echo $this->chapter->image; ?>" alt="Image de chapitre">
    <p class="text"><?php echo $this->chapter->text; ?></p>

    <h2>Choisissez votre chemin:</h2>
    <ul>
        <?php      
            foreach ($this->choices as $choice){

                $choicesList = "";
                $choicesList .= "<li><a href='./nextchapter/";
                $choicesList .= $choice->nextChapter;
                $choicesList .= "'>";
                $choicesList .= $choice->text;
                $choicesList .= "</a></li>";
                echo $choicesList;

            }
        ?>
    </ul>

    

    <a href="../">exit adventure</a>
         



</body>
</html>
