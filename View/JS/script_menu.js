function toggleMenu () {  
    const navbar = document.querySelector('.navbar');
    const burger = document.querySelector('.burger');
    
    burger.addEventListener('click', (e) => {    
      navbar.classList.toggle('show-nav');
    });    
    // bonus
    const navbarLinks = document.querySelectorAll('.navbar a');
    navbarLinks.forEach(link => {
      link.addEventListener('click', (e) => {    
        navbar.classList.toggle('show-nav');
      }); 
    })
     
  }
  toggleMenu();

  document.addEventListener("DOMContentLoaded", function() {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector("nav");
  
    burger.addEventListener("click", function() {
      if (nav.classList.contains("menu-hidden")) {
        nav.classList.remove("menu-hidden");
        nav.classList.add("show-nav");
      } else {
        nav.classList.remove("show-nav");
        nav.classList.add("menu-hidden");
      }
    });
  });
  