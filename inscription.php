<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="css/style.css" >
</head>

<body>
    <div id="bloc-page">
        <header>
            <h1>Inscription</h1>
            <button>
                <a href="authentification.php">Déjà inscrit</a>
            </button>
        </header>
        <section>
            <form>
                <input type="text" placeholder="Nom" >
                <input type="text" placeholder="Prénom" >
                <input type="text" placeholder="Login" >
                <input type="password" placeholder="Mot de passe" >
                <input type="password" placeholder="Confirmation mot de passe" >
                <input type="submit" value="S'inscrire" >
            </form>
        </section>
    </div>
</body>
</html>