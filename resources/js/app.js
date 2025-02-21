import './bootstrap';

// melihat password
const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");
const eyeIcon = document.getElementById("eyeIcon");

togglePassword.addEventListener("click", function() {
    // Toggle tipe input password
    const isPassword = passwordInput.type === "password";
    passwordInput.type = isPassword ? "text" : "password";

    // Ganti ikon mata
    eyeIcon.innerHTML = isPassword ?
        '<path d="M17.94 17.94A10 10 0 0 1 6.06 6.06M1 1l22 22M9.88 9.88A3 3 0 0 0 14.12 14.12"/>' :
        '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
});