<?php
$bdd = new PDO('mysql:host=localhost;dbname=votre_base_de_donnees', 'votre_utilisateur', 'votre_mot_de_passe');

// Sélectionnez les participants inscrits aux activités avec leurs informations.
$query = $bdd->query('SELECT p.nom, p.prenom, a.nom AS activite_nom, a.date AS activite_date 
                      FROM participants p 
                      JOIN inscriptions i ON p.id = i.participant_id 
                      JOIN activites a ON i.activite_id = a.id');

echo '<h1>Liste des Participants et de leurs Activités</h1>';
echo '<table>';
echo '<tr><th>Nom</th><th>Prénom</th><th>Activité</th><th>Heure</th></tr>';

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td>' . $row['nom'] . '</td>';
    echo '<td>' . $row['prenom'] . '</td>';
    echo '<td>' . $row['activite_nom'] . '</td>';
    echo '<td>' . $row['activite_date'] . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
