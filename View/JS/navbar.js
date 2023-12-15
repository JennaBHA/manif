// Supprimez la fonction myFunction et l'événement onclick

// Récupérer les éléments de dropdown
var dropdowns = document.querySelectorAll('.dropdown');

// Ajouter un événement pour afficher le dropdown lorsqu'on survole
dropdowns.forEach(function(dropdown) {
    dropdown.addEventListener('mouseenter', function() {
        this.querySelector('.dropdown-content').classList.add('show');
    });

    dropdown.addEventListener('mouseleave', function() {
        this.querySelector('.dropdown-content').classList.remove('show');
    });
});

// Récupérer la barre de navigation
var navbar = document.querySelector('.navbar');

// Fonction pour gérer le défilement
function handleScroll() {
  if (window.scrollY > 0) {
    // Ajouter la classe "scrolled" lorsque la page est défilée
    navbar.classList.add('scrolled');
  } else {
    // Retirer la classe "scrolled" lorsque la page est en haut
    navbar.classList.remove('scrolled');
  }
}

// Attacher la fonction de gestion du défilement à l'événement de défilement
window.addEventListener('scroll', handleScroll);

// -------------------------------------------------------------------------
/* navbar.js */
const header = document.querySelector('.header');

// Fonction pour changer la classe en fonction de la position de défilement
function toggleNavbarColor() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
}

// Écouteur d'événement de défilement
window.addEventListener('scroll', toggleNavbarColor);

// Appel initial pour gérer l'état initial de la navbar
toggleNavbarColor();

