// Add any client-side JavaScript functionality here
document.addEventListener('DOMContentLoaded', function() {
    // Example: Add active class to current nav item
    const currentPage = window.location.search.split('page=')[1]?.split('&')[0] || 'dashboard';
    const navItems = document.querySelectorAll('nav a');
    navItems.forEach(item => {
        if (item.getAttribute('href').includes(currentPage)) {
            item.classList.add('active');
        }
    });
});
