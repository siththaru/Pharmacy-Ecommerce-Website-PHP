const menu = document.querySelector('.menu');
const titles = document.querySelector('.titles');
const line1 = document.getElementById('line1');
const line2 = document.getElementById('line2');
const line3 = document.getElementById('line3');
const nav = document.querySelector('.nav');
const up = document.querySelector('.fa-arrow-up');

menu.addEventListener('click', () => {
  titles.classList.toggle('titles-active');
  line1.classList.toggle('line1');
  line2.classList.toggle('line2');
  line3.classList.toggle('line3');
})

window.addEventListener('scroll', () => {
  nav.classList.toggle("nav-color", window.scrollY);
})

