<?php
// view/chapter.php
?>

<!DOCTYPE html>
<html lang="fr">
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
    <link rel="icon" href="./views/images/Logo.png">
    <title>Dunjeon Xplorer</title>
</head>
<body>
<header>
        <a  href="home">
        <img id = "logo" src="./views/images/Logo.png" alt="Dungeon Xplorer logo"/>
        </a>
    </header>
    <div id="chapter_content">
    <img src="./views/images/chapterImage/<?php echo $this->chapter->image; ?>" alt="Image de chapitre" id ="chapter_image">
    <p id="chapter_story"><?php echo $this->chapter->text; ?></p>
        <div class = "path">
            <h2 id="path_choice_title">Choisissez votre chemin:</h2>
            <ul id="path_choice_list">

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

            <a id = "exit_adventure" href="../">Sortir de l'aventure</a>
        </div>
    </div>     

</body>
</html>
