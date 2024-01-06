<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// Variable pour suivre l'état de la soumission
$formSubmitted = false;

if(isset($_POST['envoi'])){
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : "";
    $mail = isset($_POST['mail']) ? trim($_POST['mail']) : "";
    $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : "";
    $mdp = isset($_POST['mdp']) ? trim($_POST['mdp']) : "";

    // Validation des champs
    $nomError = $prenomError = $mailError = $telephoneError = $mdpError = "";

    if(empty($nom) || empty($prenom) || empty($mail) || empty($telephone) || empty($mdp)){
        $nomError = "Veuillez compléter tous les champs.";
    } elseif(strlen($nom) < 2 || strlen($prenom) < 2){
        $nomError = "Le nom et le prénom doivent avoir au moins 2 caractères.";
    } elseif(!preg_match("/^\d{10}$/", $telephone)){
        $telephoneError = "Le numéro de téléphone doit contenir exactement 10 chiffres.";
    } elseif(!is_numeric($telephone)){
        $telephoneError = "Le numéro de téléphone ne doit contenir que des chiffres.";
    } elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $mailError = "L'adresse email n'est pas valide.";
    } elseif(strlen($mdp) < 8 || !preg_match("/\d/", $mdp)){
        $mdpError = "Le mot de passe doit contenir au moins 8 caractères avec au moins un chiffre.";
    } else {
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);
        $mail = htmlspecialchars($mail);
        $telephone = intval($telephone); 
        $mdp = sha1($mdp);

        $inserUser = $bdd->prepare('INSERT INTO participant(nom, prenom, mail, telephone, mdp) VALUES(?, ?, ?, ?, ?)');
        $inserUser->execute(array($nom, $prenom, $mail, $telephone, $mdp));

        $recupPart = $bdd->prepare('SELECT id FROM participant WHERE nom = ? AND prenom = ?');
        $recupPart->execute(array($nom, $prenom));

        if($recupPart->rowCount() > 0){
            $result = $recupPart->fetch();
            $_SESSION['id'] = $result['id'];
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['mail'] = $mail;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['mdp'] = $mdp;
            $formSubmitted = true; 
            $roleId = 1; 
    $userId = $result['id']; 


        }
    }
}

if ($formSubmitted) {
    unset($_SESSION['nomValue']);
    unset($_SESSION['prenomValue']);
    unset($_SESSION['mailValue']);
    unset($_SESSION['telephoneValue']);
    unset($_SESSION['mdpValue']);

    header("Location: connexion.php");
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style_membre/inscription.css">
    <title>Inscription</title>
</head>
<body>
<img class="wave" src="../../background/wave_.png" alt="Wave Background">
<div class="container">
    <div class="img"></div>
    <div class="login-content">
        <form method="post">
            <h2 class="title">Inscription</h2>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <input type="text" name="nom" autocomplete="off" placeholder="Nom" value="<?php echo isset($_SESSION['nomValue']) ? $_SESSION['nomValue'] : ''; ?>">
                    <br>
                    <span class="error-message">
                        <?php if(!empty($nomError)) echo $nomError; ?>
                    </span>
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <input type="text" name="prenom" autocomplete="off" placeholder="Prenom" value="<?php echo isset($_SESSION['prenomValue']) ? $_SESSION['prenomValue'] : ''; ?>">
                    <br>
                    <span class="error-message">
                        <?php if(!empty($prenomError)) echo $prenomError; ?>
                    </span>
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="div">
                    <input type="text" name="mail" autocomplete="off" placeholder="Mail" value="<?php echo isset($_SESSION['mailValue']) ? $_SESSION['mailValue'] : ''; ?>">
                    <br>
                    <span class="error-message">
                        <?php if(!empty($mailError)) echo $mailError; ?>
                    </span>
                </div>
            </div>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="div">
                    <input type="text" name="telephone" autocomplete="off" placeholder="Telephone" value="<?php echo isset($_SESSION['telephoneValue']) ? $_SESSION['telephoneValue'] : ''; ?>">
                    <br>
                    <span class="error-message">
                        <?php if(!empty($telephoneError)) echo $telephoneError; ?>
                    </span>
                </div>
            </div>

            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <input type="password" name="mdp" autocomplete="off" placeholder="Mot de passe">
                </div>
            </div>

            <div class="error-message"><?php if(!empty($mail_error)) echo $mail_error; ?></div>
            <div class="error-message"><?php if(!empty($mdp_error)) echo $mdp_error; ?></div>

        
                <button class="bouton" name="envoi" value="S'inscrire">S'inscrire</button>
                <a href="../accueil.php" class="bouton_retour" id="btn">Retour</a>
            <br>
            <p>Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous !</a></p>
        </form>
    </div>
</div>
</div>
</body>
<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</html>
