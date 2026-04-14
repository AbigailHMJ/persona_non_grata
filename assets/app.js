/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

// DEFINES ALL SCRIPTS FOR THE WEBSITE

// Responsive navbar for mobile use
window.onload = () => {
    const navButton = document.querySelector("#navbar .nav-button");
    // Open menu on click
    navButton.addEventListener("click", function(event){
        // Stops from propagating
        event.stopPropagation();
        // Adding and removing class show for navigation button
        this.nextElementSibling.classList.toggle('show');
    });

    // If clicked anywhere on page, menu is closed
    document.addEventListener("click", function(){
        navButton.nextElementSibling.classList.remove('show');
    });
}

// Toggle view for dark and light themes
let darkMode = localStorage.getItem('darkMode');

const darkModeToggle = document.querySelector('#dark-mode-toggle');
const enableDarkMode = () => {
    document.body.classList.add('darkmode');
    localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
    document.body.classList.remove('darkmode');
    localStorage.setItem('darkMode', null);
}

// If the user has already selected dark mode on previous visit
if (darkMode === 'enabled'){
    enableDarkMode();
}

// Event listener on click to toggle dark mode on and off
darkModeToggle.addEventListener('click', () => {
    // Gets darkMode settings
    darkMode = localStorage.getItem('darkMode');

    // If dark mode is not currently enabled, enable it
    if (darkMode !== 'enabled'){
        enableDarkMode();
    }
    else{
        disableDarkMode();
    }
});

// Image preview on upload when creating a new character
document.querySelector("#character_illustration").addEventListener("change", checkFile);
function checkFile(){
    let preview = document.querySelector(".preview");
    let image =  preview.querySelector("img");
    let file = this.files[0];
    const types = ["image/jpeg", "image/png", "image/webp", "image/gif"];
    let reader = new FileReader();

    reader.onloadend = function(){
        image.src = reader.result;
        preview.style.display = "block";
    }
    reader.readAsDataURL(file);
}