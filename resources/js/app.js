import "./bootstrap";

// Fungsi untuk toggle visibility password
function togglePasswordVisibility(passwordFieldId, iconId) {
    const passwordInput = document.getElementById(passwordFieldId);
    const eyeIcon = document.getElementById(iconId);

    // Toggle tipe input
    const isPassword = passwordInput.type === "password";
    passwordInput.type = isPassword ? "text" : "password";

    // Ganti ikon mata sesuai status
    eyeIcon.innerHTML = isPassword
        ? '<path d="M17.94 17.94A10.42 10.42 0 0 1 12 20c-7 0-11-8-11-8a18.16 18.16 0 0 1 3.66-4.88m3.92-2.52A10.31 10.31 0 0 1 12 4c7 0 11 8 11 8a18.16 18.16 0 0 1-3.66 4.88"/><path d="M1 1l22 22"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
}

// Event listener untuk password utama
document
    .getElementById("togglePassword")
    .addEventListener("click", function () {
        togglePasswordVisibility("password", "eyeIcon");
    });

// Event listener untuk konfirmasi password
document
    .getElementById("toggleConfirmPassword")
    .addEventListener("click", function () {
        togglePasswordVisibility("password_confirmation", "eyeIconConfirm");
    });