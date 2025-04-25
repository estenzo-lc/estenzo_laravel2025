document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const strengthIndicator = document.getElementById('password-strength');

    if (passwordInput && strengthIndicator) {
        passwordInput.addEventListener('input', function () {
            const val = passwordInput.value;
            let strength = 0;

            if (val.length >= 8) strength++;
            if (/[A-Z]/.test(val)) strength++;
            if (/[a-z]/.test(val)) strength++;
            if (/[0-9]/.test(val)) strength++;
            if (/[\W]/.test(val)) strength++;

            strengthIndicator.className = '';
            if (val.length === 0) {
                strengthIndicator.textContent = '';
            } else if (strength < 3) {
                strengthIndicator.textContent = 'Weak';
                strengthIndicator.classList.add('strength-weak');
            } else if (strength < 5) {
                strengthIndicator.textContent = 'Medium';
                strengthIndicator.classList.add('strength-medium');
            } else {
                strengthIndicator.textContent = 'Strong';
                strengthIndicator.classList.add('strength-strong');
            }
        });
    }
});
