/*MENU A BARRE*/
/*dichiaro la variabile menu e navbar*/
const navbar = document.querySelector('.header .navbar');
const menu = document.querySelector('#menu-btn');

menu.addEventListener('click', ()=>{
    menu.classList.toggle('fa-times'); /**toggle rende visibile o nascosto un elemento  */
    navbar.classList.toggle('active');
    user.classList.remove('fa-times');
    navbar2.classList.remove('active');
});


const navbar2 = document.querySelector('.header .navbar2');
const user = document.querySelector('#user-icon');

user.addEventListener('click', ()=>{
    user.classList.toggle('fa-times');
    navbar2.classList.toggle('active');
    menu.classList.remove('fa-times'); /**remove rende visibile o nascosto un elemento  */
    navbar.classList.remove('active');
    user.classList.remove('fa-times');
});
