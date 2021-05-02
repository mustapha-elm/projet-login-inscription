<?php
    session_start();
    if($_SESSION['authentifier']!='oui'){
        header('location:authentification.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session utilisateur</title>
    <link rel="stylesheet" href="css/style.css" >
</head>

<body>
    <div id="bloc-page">
        <header>
            <h1>Espace privé</h1>
            <button>
                <a href="authentification.php">Quitter la session</a>
            </button>
        </header>
        <section>
            <h1>
                <span>
                    <?php 
                    echo (date('H')<18)?('Bonjour'):('Bonsoir');
                    ?>
                </span>
                    <?php echo $_SESSION['prenom']. ' ' .$_SESSION['nom']; ?>
            </h1>
        </section>
    </div>
</body>
</html>