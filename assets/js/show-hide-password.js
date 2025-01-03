document.addEventListener('DOMContentLoaded', function() {
     'use strict';
 
     const elToggle = document.querySelector('.js-password-show-toggle'),
           passwordInput = document.getElementById('password');
 
     elToggle.addEventListener('click', (e) => {
         e.preventDefault();
 
         if (elToggle.classList.contains('active')) {
             passwordInput.setAttribute('type', 'password');
             elToggle.classList.remove('active');
         } else {
             passwordInput.setAttribute('type', 'text');
             elToggle.classList.add('active');
         }
     });
 });