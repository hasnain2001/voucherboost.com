let lastScrollY = window.scrollY;
const navbar = document.getElementById('navbar');
const mobileMenu = document.getElementById('mobile-menu');
const navList = document.getElementById('nav-list');
const categoriesButton = document.getElementById('categories-button');
const modal = document.getElementById('categories-modal');
const closeModal = document.querySelector('.close-modal');
const regionButton = document.getElementById('region-button');
const regionModal = document.getElementById('region-modal');
const closeRegionModal = document.querySelector('.close-region-modal'); // Add a specific close button for region modal

window.addEventListener('scroll', () => {
    // If scrolling down, hide the navbar by setting top to '-100%'
    if (window.scrollY > lastScrollY) {
        navbar.style.top = '-100%'; // Completely hide the navbar
    } else {
        navbar.style.top = '0'; // Show the navbar when scrolling up
    }
    navbar.classList.toggle('scrolled', window.scrollY > 50);
    lastScrollY = window.scrollY;
});

mobileMenu.addEventListener('click', () => {
    navList.classList.toggle('active');

    // Toggle the mobile menu icon
    if (navList.classList.contains('active')) {
        mobileMenu.innerHTML = '&#10006;'; // Close icon
        mobileMenu.style.color = '#ffffff'; // Change color to white
        // Close the modal when mobile menu is toggled
        modal.style.display = 'none';
        regionModal.style.display = 'none'; // Close region modal when mobile menu is toggled
    } else {
        mobileMenu.innerHTML = '&#9776;'; // Menu icon
        mobileMenu.style.color = '#ffffff'; // Default color
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Open categories modal
    categoriesButton.addEventListener('click', function (e) {
        e.preventDefault();
        modal.style.display = 'block';
    });

    // Close categories modal on close button click
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Close categories modal on outside click
    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Open region modal
    regionButton.addEventListener('click', function (e) {
        e.preventDefault();
        regionModal.style.display = 'block';
    });

    // Close region modal on close button click
    closeRegionModal.addEventListener('click', function () {
        regionModal.style.display = 'none';
    });

    // Close region modal on outside click
    window.addEventListener('click', function (e) {
        if (e.target === regionModal) {
            regionModal.style.display = 'none';
        }
    });
});


// "Go to Top" button functionality
function topFunction() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
