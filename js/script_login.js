const navbar = document.querySelector('.header .navbar');
const menu = document.querySelector('#menu-btn');

menu.addEventListener('click', ()=>{
    menu.classList.toggle('fa-times'); /**toggle rende visibile o nascosto un elemento  */
    navbar.classList.toggle('active');
});