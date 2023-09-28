<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// Variable pour suivre l'état de la soumission
$formSubmitted = false;

if(isset($_POST['envoie'])){
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prenom = isset($_POST['prenom']) ? trim($_POST['prenom']) : "";
    $mail = isset($_POST['mail']) ? trim($_POST['mail']) : "";
    $telephone = isset($_POST['telephone']) ? trim($_POST['telephone']) : "";
    $mdp = isset($_POST['mdp']) ? trim($_POST['mdp']) : "";

    // Validation des champs
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
        $telephone = intval($telephone); // Utilisez intval pour convertir en entier
        $mdp = sha1($mdp);

        $inserUser = $bdd->prepare('INSERT INTO participant(nom, prenom, mail, telephone, mdp) VALUES(?, ?, ?, ?, ?)');
        $inserUser->execute(array($nom, $prenom, $mail, $telephone, $mdp));

        // Vous devez récupérer l'ID du nouvel utilisateur après l'insertion
        $recupPart = $bdd->query('SELECT id FROM participant WHERE nom = "'.$nom.'" AND prenom = "'.$prenom.'"');
        if($recupPart->rowCount() > 0){
            $result = $recupPart->fetch();
            $_SESSION['id'] = $result['id'];
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['mail'] = $mail;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['mdp'] = $mdp;
            $formSubmitted = true; // Marquer que le formulaire a été soumis avec succès
        }
    }
}

// Réinitialiser les valeurs du formulaire uniquement si le formulaire a été soumis avec succès
if ($formSubmitted) {
    unset($_SESSION['nomValue']);
    unset($_SESSION['prenomValue']);
    unset($_SESSION['mailValue']);
    unset($_SESSION['telephoneValue']);
    unset($_SESSION['mdpValue']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST" action="" align="center">
        <input type="text" name="nom" autocomplete="off" placeholder="Nom" value="<?php echo isset($_SESSION['nomValue']) ? $_SESSION['nomValue'] : ''; ?>">
        <br>
        <span class="error-message">
            <?php if(isset($nomError)) echo $nomError; ?>
        </span>
        <br>
        <input type="text" name="prenom" autocomplete="off" placeholder="Prenom" value="<?php echo isset($_SESSION['prenomValue']) ? $_SESSION['prenomValue'] : ''; ?>">
        <br>
        <span class="error-message">
            <?php if(isset($prenomError)) echo $prenomError; ?>
        </span>
        <br>
        <input type="text" name="mail" autocomplete="off" placeholder="Mail" value="<?php echo isset($_SESSION['mailValue']) ? $_SESSION['mailValue'] : ''; ?>">
        <br>
        <span class="error-message">
            <?php if(isset($mailError)) echo $mailError; ?>
        </span>
        <br>
        <input type="text" name="telephone" autocomplete="off" placeholder="Téléphone" value="<?php echo isset($_SESSION['telephoneValue']) ? $_SESSION['telephoneValue'] : ''; ?>">
        <br>
        <span class="error-message">
            <?php if(isset($telephoneError)) echo $telephoneError; ?>
        </span>
        <br>
        <input type="password" name="mdp" autocomplete="off" placeholder="Mot de passe" value="<?php echo isset($_SESSION['mdpValue']) ? $_SESSION['mdpValue'] : ''; ?>">
        <br>
        <span class="error-message">
            <?php if(isset($mdpError)) echo $mdpError; ?>
        </span>
        <br><br>
        <input type="submit" name="envoie">
    </form>

    <script>
        // Réinitialise le formulaire si le formulaire a été soumis avec succès
        <?php if ($formSubmitted) : ?>
        document.querySelector("form").reset();
        <?php endif; ?>
    </script>
</body>
</html>
