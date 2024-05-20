document.addEventListener("DOMContentLoaded", function() {
    let currentUrl = window.location.href;

    document.querySelectorAll('.nav-link').forEach(function(link) {
        if (currentUrl === link.href) {
            link.classList.add('active');
            // Menambahkan kelas Tailwind secara langsung
            link.classList.add('text-white', 'w-11/12', 'rounded-r-full', 'bg-gradient-to-b', 'from-[#AC87C5]', 'via-[#E0AED0]', 'to-[#FFE5E5]');
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    dropdownButton.addEventListener("click", function() {
        dropdownMenu.classList.toggle("hidden");
    });

    document.addEventListener("click", function(event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add("hidden");
        }
    });
});
