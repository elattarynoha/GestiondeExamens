document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('re_password');
    const errorElement = document.getElementById('password-error');
    
    confirmPassword.addEventListener('input', function () {
        if (password.value !== confirmPassword.value) {
            errorElement.style.display = 'block';
            errorElement.textContent = 'Passwords do not match.';
        } else {
            errorElement.style.display = 'none';
        }
    });

    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            alert('Passwords do not match. Please try again.');
        }
    });
});
