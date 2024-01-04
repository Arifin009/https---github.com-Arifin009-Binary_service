function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.querySelector('.toggle-password');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleBtn.textContent = 'Hide';
    } else {
        passwordInput.type = 'password';
        toggleBtn.textContent = 'Show';
    }
}

function validateForm() {
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const repassword = document.getElementById('repassword').value;

    // Basic validation, you can add more specific checks
    if (username === '' || email === '' || password === '' || repassword === '') {
        alert('All fields are required.');
        return;
    }

    if (password !== repassword) {
        alert('Passwords do not match.');
        return;
    }

    // Additional validation logic if needed

    // If all validation passes, you can submit the form or take appropriate action
    alert('Form submitted successfully!');
}
