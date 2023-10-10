document.getElementById("chargerInfosActivite").addEventListener("click", function() {
    // Utilisez JavaScript pour déclencher une requête AJAX vers PHP
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var activiteData = JSON.parse(xhr.responseText);
            afficherInfosActivite(activiteData);
        }
    };
    xhr.open("GET", "charger_infos_activite.php", true);
    xhr.send();
});

function afficherInfosActivite(activiteData) {
    var activiteContainer = document.getElementById("activiteContainer");
    // Affichez les informations dans la div
    activiteContainer.innerHTML = "Dernières informations de la page activité : " + activiteData.information;
}
