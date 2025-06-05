
//script.js
// Function to open the popup
function openPopup() {
    document.getElementById('popup').style.display = 'flex';
}

// Function to close the popup
function closePopup() {
    document.querySelector('.popup-overlay').style.display = 'none'; // Hide the popup
}

// Function for Log in button
function loginFunction() {
    window.location.href = "login.php"; // Redirects to login.php
}

// Function for Create Account button
function createAccountFunction() {
    window.location.href = "createaccount.php"; // Redirects to create account page
}

// Function for Home page button
function goToHomePage() {
    window.location.href = "home.php"; // Redirects to homepage
}

// Function for Order Now button
function orderNow() {
    window.location.href = "Ordernow.php"; // Redirects to order page
}

// Function for Contact Us button
function contactUs() {
    window.location.href = "contact.html"; // Redirects to contact page
}

// Function to show slides
let slideIndex = 0;
showSlides();

function showSlides() {
    let slides = document.getElementsByClassName("mySlides");
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}

// Function for Search button
function searchFunction() {
    alert('Search button clicked'); // Placeholder action for search button
}

// Function for login page button
function loginpageFunction() {
    window.location.href = "Ordernow.php"; // Redirects to order page
}

