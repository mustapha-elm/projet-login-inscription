<?php
    session_start();
    $_SESSION['authentifier']='non';
    
    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_SPECIAL_CHARS);
    $valider = filter_input(INPUT_POST, 'Valider');
    $message='';
    
    if ($valider != null){
        include 'connexion.php';
        $cursor=$pdo->prepare('SELECT * FROM utilisateurs WHERE pseudo_ut=? LIMIT 1');
        $cursor->bindValue(1, $pseudo);
        $cursor->setFetchMode(PDO::FETCH_ASSOC);
        $cursor->execute();
        $record=$cursor->fetch();
        
        if($record == false){
            $message= '<li>login inconnu</li>';
        }else{
            if(password_verify($mdp, $record['mdp_ut'])){
                $_SESSION['authentifier']='oui';
                $_SESSION['nom']= strtoupper($record['nom']);
                $_SESSION['prenom']= $record['prenom'];
                header('location:session.php');
            }else{
                $message= '<li>erreur mot de passe</li>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'authentification simple</title>
    <link rel="stylesheet" href="css/style.css" >
</head>

<body>
    <div id="bloc-page">
        <header>
            <h1>Authentification</h1>
            <button>
                <a href="inscription.php">S'inscrire</a>
            </button>
        </header>
        <section>
            <form method="POST">
                <input type="text" name="pseudo" placeholder="Login" >
                <input type="password" name="mdp" placeholder="Mot de passe" >
                <input type="submit" name="Valider" value="Valider" >
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

