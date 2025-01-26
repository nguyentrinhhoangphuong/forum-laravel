document.addEventListener('DOMContentLoaded', function () {
    // Xử lý form đăng nhập
    const signinForm = document.getElementById('signinForm');
    if (signinForm) {
        signinForm.addEventListener('submit', function (e) {
            e.preventDefault();
            signin();
        });
    }

    // Xử lý form đăng ký (nếu có)
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', function (e) {
            e.preventDefault();
            signup();
        });
    }
});

function signup() {
    // Clear previous error messages
    document.querySelectorAll('.text-danger').forEach(el => el.innerText = '');

    // Get form data
    const form = document.getElementById('signupForm');
    const formData = new FormData(form);

    // Client-side validation
    let hasError = false;
    if (!formData.get('username')) {
        document.getElementById('usernameError').innerText = 'Username is required.';
        hasError = true;
    }
    if (!formData.get('email')) {
        document.getElementById('emailError').innerText = 'Email is required.';
        hasError = true;
    }
    if (!formData.get('password')) {
        document.getElementById('passwordError').innerText = 'Password is required.';
        hasError = true;
    }
    if (!formData.get('password_confirmation')) {
        document.getElementById('confirmPasswordError').innerText = 'Confirm password is required.';
        hasError = true;
    }
    if (formData.get('password') !== formData.get('password_confirmation')) {
        document.getElementById('confirmPasswordError').innerText = 'Passwords do not match.';
        hasError = true;
    }

    if (hasError) return;

    // CSRF token
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send AJAX request
    fetch('/signup', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify(Object.fromEntries(formData)),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = data.redirect;
            } else {
                // Handle errors and display messages
                if (data.errors) {
                    for (const [field, message] of Object.entries(data.errors)) {
                        const errorElement = document.getElementById(`${field}Error`);
                        if (errorElement) {
                            errorElement.innerText = message[0]; // Hiển thị lỗi đầu tiên
                        }
                    }
                } else {
                    alert(data.message || 'An error occurred.');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
}

function signin() {
    // Clear previous error messages
    document.querySelectorAll('.text-danger').forEach(el => el.innerText = '');

    // Get form data
    const form = document.getElementById('signinForm');
    const formData = new FormData(form);

    // Client-side validation
    let hasError = false;
    if (!formData.get('email')) {
        document.getElementById('emailError').innerText = 'Email is required.';
        hasError = true;
    }
    if (!formData.get('password')) {
        document.getElementById('passwordError').innerText = 'Password is required.';
        hasError = true;
    }

    if (hasError) return;

    // CSRF token
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send AJAX request
    fetch('/signin', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify(Object.fromEntries(formData)),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                // Handle errors and display messages
                if (data.errors) {
                    for (const [field, message] of Object.entries(data.errors)) {
                        const errorElement = document.getElementById(`${field}Error`);
                        if (errorElement) {
                            errorElement.innerText = message; // Hiển thị lỗi
                        }
                    }
                } else {
                    alert(data.message || 'Login failed.');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
}
