<?php
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS);
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_SPECIAL_CHARS);
$cfMdp = filter_input(INPUT_POST, 'cf_mdp', FILTER_SANITIZE_SPECIAL_CHARS);
$valider = filter_input(INPUT_POST, 'Valider');
$message = '';

if ($valider != null) {
    if(empty($nom) || empty($prenom) || empty($pseudo) || empty($mdp) || empty($cfMdp)) {
        $message = '<li>tous les champs doivent être renseignés</li>';
    }
    if($mdp != $cfMdp) {
        $message .= '<li>les mots de passes ne correspondent pas</li>';
    }
    if (((strlen($mdp)) < 4)) {
        $message .= '<li>le mot de passe doit être composé d\'au moins 4 caractères</li>';
    }
    if (((strlen($pseudo)) < 2)) {
        $message .= '<li>le login doit être composé d\'au moins 4 caractères</li>';
    }
    //si la variable $message est vide càd que les conditions sont remplis, alors on peut executer le code d'insertion 
    if(empty($message)) {
        include 'connexion.php';
        $req = $pdo->prepare('select id_ut from utilisateurs where pseudo_ut=?');
        $req->bindValue(1, $pseudo);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $req->execute();
        $record = $req->fetch();
        if ($record != false) {
            $message .= '<li>le login ' .$pseudo. ' existe déjà</li>';
        } else {
            $cmd = $pdo->prepare('insert into utilisateurs (date_entree, nom, prenom, pseudo_ut, mdp_ut) VALUES (now(), ?,?,?,?)');
            $cmd->bindValue(1, $nom);
            $cmd->bindValue(2, $prenom);
            $cmd->bindValue(3, $pseudo);
            $cmd->bindValue(4, password_hash($mdp, PASSWORD_DEFAULT));
            $cmd->execute();
            $affected = $cmd->rowCount();
            if ($affected == '1') {
                $messageOK = 'ok';
            } else {
                $message .= '<li>echec de l\'inscription</li>';
            }
        }
    }
}
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
                <form method="POST">
                    <input type="text" name="nom" placeholder="Nom" required>
                    <input type="text" name="prenom" placeholder="Prénom" required>
                    <input type="text" name="pseudo" placeholder="Login" required>
                    <input type="password" name="mdp" placeholder="Mot de passe" required>
                    <input type="password" name="cf_mdp" placeholder="Confirmation mot de passe" required>
                    <input type="submit" name="Valider" value="S'inscrire" >

                    <?php
                        if (isset($messageOK)) {
                    ?>
                        <button id="btnConnexion">
                            <a href="authentification.php">Vous êtes inscrit !  Se connecter </a>
                        </button>      
                    <?php
                        }
                    ?>
                </form>
                
                <?php
                    if(!empty($message)){
                ?>
                    <div id="bloc-alert">
                        <div>
                            <ul>
                                <?php echo $message; ?>
                            </ul>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </section>
        </div>
    </body>
</html>