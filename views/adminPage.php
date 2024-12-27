<?php
require_once '../base/Database.php';
$userNameList = $GLOBALS["base"]->request("SELECT * FROM User");
$aventureList = $GLOBALS["base"]->request("SELECT * FROM Adventure");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/styles/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Dunjeon Xplorer</title>
</head>

<body>
    <header>
        <a href="home">
            <img id="logo" src="../views/images/Logo.png" alt="Dungeon Xplorer logo" />
        </a>
        <h1>Admin</h1>
    </header>

    <table class= "user-table">
        <tr class="table-header">
            <th>User ID</th>
            <th>User Pseudo</th>
            <th>Action</th>
        </tr>
        <?php foreach ($userNameList as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                <td><?php echo htmlspecialchars($user['user_pseudo']); ?></td>
                <td>
                    <form action="deleteUser" method="post" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>">
                        <button class = "button-suppress" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table class= "adventure-table">
        <tr class="table-header">
            <th>Adventure ID</th>
            <th>Adventure name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($aventureList as $adventure): ?>
            <tr>
                <td><?php echo htmlspecialchars($adventure['ad_id']); ?></td>
                <td><?php echo htmlspecialchars($adventure['ad_name']); ?></td>
                <td>
                    <form action="../deleteAdventure" method="post" style="display:inline;">
                        <input type="hidden" name="ad_id" value="<?php echo htmlspecialchars($adventure['ad_id']); ?>">
                        <button class = "button-suppress" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p class="adventure-add-text">Vous voulez ajouter une aventure ? <a >Cliquez ici</a></p>
    
    <script>
        document.querySelector(".adventure-add-text a").addEventListener("click", function() {
            document.querySelector(".add-adventure-form").style.display = "block";
        });
    </script>

    <form class ="add-adventure-form" action="../addAdventure" method="post" style="display:none;" >
        <input class="adventure-name" type="text" name="ad_name" placeholder="Nom de l'aventure">
        <input class = "button-add" type="submit" value="Ajouter l'aventure">
    </form>
</body>

</html>
