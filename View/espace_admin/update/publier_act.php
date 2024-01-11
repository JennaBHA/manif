    <?php
    session_start();

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=manif', 'root', '');
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }

    if (!isset($_SESSION['mdp'])) {
        header('Location: ../espace_admin/connexion/connexion.php');
        exit;
    }

    $message = '';
    $responsables = array();

    $requeteResponsables = $bdd->query('SELECT nom FROM responsable');
    while ($responsable = $requeteResponsables->fetch()) {
        $responsables[] = $responsable['nom'];
    }

    if (isset($_POST['envoie'])) {
        if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['date'])) {
            $titre = htmlspecialchars($_POST['titre']);
            $description = nl2br(htmlspecialchars($_POST['description']));
            $date = date('Y-m-d', strtotime($_POST['date']));
            $heure = empty($_POST['creneau']) ? null : $_POST['creneau'];
    
            $responsableName = $_POST['responsable'];
    
            // Get the responsible ID based on the name
            $responsableId = array_search($responsableName, $responsables);
    
            $inserAct = $bdd->prepare('INSERT INTO activite(titre, description, date, heure, responsable, id_responsable) VALUES(:titre, :description, :date, :heure, :responsableName, :responsableId)');
            $inserAct->execute(array(':titre' => $titre, ':description' => $description, ':date' => $date, ':heure' => $heure, ':responsableName' => $responsableName, ':responsableId' => $responsableId));
    
            $message = '<p style="color: green;">L\'activité a bien été envoyée</p>';
        } else {
            $message = '<p style="color: red;">Veuillez compléter tous les champs</p>';
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../style/style_admin/publier_act.css">
        <link rel="stylesheet" href="../../style/general/bouton.css">
        <link rel="stylesheet" href="../../style/general/card.css">
        <link rel="stylesheet" href="../../style/general/navbar.css">
        <link rel="stylesheet" href="../../style/general/scrollbar.css">
        <link rel="stylesheet" href="../../style/general/general.css">
        <link rel="stylesheet" href="../../style/general/footer.css">
        <title>Publier une activité</title>
    </head>
    <body>
        <!-- début menu -->
        <header class="header">
        <a class="logo">FATALYS</a>
        <nav class="navbar">
                <a href="../index.php">Accueil</a>
                <div class="dropdown">
                    <a href="#" class="with-dropdown">Activité</a>
                    <i class="fa fa-caret-down"></i>
                    <div class="dropdown-content">
                        <a href="../activite/activite.php">Afficher</a>
                        <a href="publier_act.php">Publier</a>
                        <!-- <a href="modifier_act.php">Modifier</a> -->
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="with-dropdown">Membres</a>
                    <i class="fa fa-caret-down"></i>
                    <div class="dropdown-content">
                        <a href="../membre.php">Participant</a>
                        <a href="../update/gerer_participant.php">Participation</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="with-dropdown">Responsable</a>
                    <i class="fa fa-caret-down"></i>
                    <div class="dropdown-content">
                        <a href="../../espace_resp/responsable.php">Afficher</a>
                        <a href="../../espace_admin/update/ajouter_resp.php">Ajouter</a>
                    </div>
                </div>
                <a href="../connexion/deconnexion.php">Déconnexion</a>
            </nav>
        </header>
        <!-- fin menu -->
        <div class="container">
            <div class="main" id="main">
                <main class="body_card_head">
                    <div class="ajout">
                        <div class="body_card">
                            <div class="card activity-form"> 
                                <form method="post" class="card-form">
                                    <h2>Publier une activité</h2>

                                    <div class="form-group">
                                        <label for="titre"><B>Titre de l'activité :</B></label>
                                        <input type="text" id="titre" name="titre" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description"><B>Description de l'activité :</B></label>
                                        <textarea id="description" name="description" rows="4" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="responsable"><B>Responsable de l'activité :</B></label>
                                        <select id="responsable" name="responsable" required>
                                            <?php foreach ($responsables as $responsable) : ?>
                                                <option value="<?php echo $responsable; ?>"><?php echo $responsable; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="date"><B>Date :</B></label>
                                        <input type="date" id="date" name="date" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="creneau"><B>Heure :</B></label>
                                        <input type="time" id="creneau" name="creneau" autocomplete="off" placeholder="Créneau">
                                    </div>

                                    <div class="btn_act">
                                        <button class="bn3637 bn37" type="submit" name="envoie">Envoie</button>
                                        <a href="../activite/activite.php" class="bn3637 bn37"><- Retour</a>
                                    </div>
                                </form>
                            </div>
                            <div id="message-container">
                                <?php
                                if (!empty($message)) {
                                    echo $message;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <br>              
                <div class="bar-sp"></div>
                <footer>
                    <p>© FATALYS 2024</p>
                </footer>   
                <script src="../../JS/navbar.js"></script>
                <script src="../../JS/buttom.js"></script>
            </body>
            </html>
