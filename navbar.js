document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sideNav = document.getElementById('sidenav');

    // Toggle navigation on menu icon click
    menuToggle.addEventListener('click', function () {
        sideNav.classList.toggle('hidden');
    });
});
