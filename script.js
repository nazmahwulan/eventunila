document.addEventListener("DOMContentLoaded", function () {
    const dropdownButton = document.getElementById("dropdownButton");
    const navbarDropdownMenu = document.getElementById("navbarDropdownMenu");
    if (dropdownButton && navbarDropdownMenu) {
        dropdownButton.addEventListener("click", function () {
            navbarDropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function (event) {
            if (!dropdownButton.contains(event.target) && !navbarDropdownMenu.contains(event.target)) {
                navbarDropdownMenu.classList.add("hidden");
            }
        });
    }

    // Dropdown kategori di daftar event
    const dropdownInput = document.getElementById('kategoriDropdownInput');
    const dropdownMenu = document.getElementById('kategoriDropdownMenu');
    if (dropdownInput && dropdownMenu) {
        const options = dropdownMenu.querySelectorAll('button');

        dropdownInput.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        options.forEach(option => {
            option.addEventListener('click', (event) => {
                dropdownInput.value = event.target.textContent;
                dropdownMenu.classList.add('hidden');
            });
        });

        document.addEventListener('click', (event) => {
            if (!dropdownInput.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }

    // Dropdown status event halaman admin
    const statusDropdownInput = document.getElementById('statusDropdownInput');
    const statusDropdownMenu = document.getElementById('statusDropdownMenu');
    if (statusDropdownInput && statusDropdownMenu) {
        const options = statusDropdownMenu.querySelectorAll('button');

        statusDropdownInput.addEventListener('click', () => {
            statusDropdownMenu.classList.toggle('hidden');
        });

        options.forEach(option => {
            option.addEventListener('click', (event) => {
                statusDropdownInput.value = event.target.textContent;
                statusDropdownMenu.classList.add('hidden');
            });
        });

        document.addEventListener('click', (event) => {
            if (!statusDropdownInput.contains(event.target) && !statusDropdownMenu.contains(event.target)) {
                statusDropdownMenu.classList.add('hidden');
            }
        });
    }

    // Preview gambar
    const gambarInput = document.getElementById("gambar");
    if (gambarInput) {
        gambarInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const box = document.getElementById('box');
                    box.src = e.target.result;
                    box.classList.remove('hidden');
                    document.querySelector('#upload-label i').classList.add('hidden');
                    document.getElementById('upload-text').classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Alert notifikasi
    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.classList.add('opacity-0');
            setTimeout(() => {
                flashMessage.remove();
            }, 1000);
        }, 1000);
    }

    
    // Toggle password visibility
    const togglePasswordButton = document.getElementById('togglePassword');
    if (togglePasswordButton) {
        togglePasswordButton.addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password2');
            const eyeIconOpen = document.getElementById('eyeIconOpen');
            const eyeIconClosed = document.getElementById('eyeIconClosed');
            const isPassword = passwordField.getAttribute('type') === 'password';

            if (isPassword) {
                passwordField.setAttribute('type', 'text');
                confirmPasswordField.setAttribute('type', 'text');
                eyeIconOpen.classList.remove('hidden');
                eyeIconClosed.classList.add('hidden');
            } else {
                passwordField.setAttribute('type', 'password');
                confirmPasswordField.setAttribute('type', 'password');
                eyeIconOpen.classList.add('hidden');
                eyeIconClosed.classList.remove('hidden');
            }
        });
    }

    
});
