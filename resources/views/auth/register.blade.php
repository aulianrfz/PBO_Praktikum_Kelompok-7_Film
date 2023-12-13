<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Cravitae</title>
    <link rel="stylesheet" href="/cssfile/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .error-message {
            color: red;
            font-size: 10px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Registration</h2>
        <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            <div class="input-box">
                <input type="text" name="name" placeholder="Enter your name" required>
                <div id="name-error" class="error-message"></div>
            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="Enter your email" required>
                <div id="email-error" class="error-message"></div>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Create password" required>
                <div id="password-error" class="error-message"></div>
            </div>
            <div class="input-box">
                <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                <div id="confirm-password-error" class="error-message"></div>
            </div>
            <div class="policy">
                <input type="checkbox">
                <h3>I accept all terms & condition</h3>
            </div>
            <div class="input-box button">
                <input type="submit" value="Register Now">
            </div>
            <div class="text">
                <h3>Already have an account? <a href="/login">Login now</a></h3>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementsByName("name")[0].value;
            var email = document.getElementsByName("email")[0].value;
            var password = document.getElementsByName("password")[0].value;
            var confirmPassword = document.getElementsByName("password_confirmation")[0].value;

            // Clear previous error messages
            document.getElementById('name-error').innerHTML = '';
            document.getElementById('email-error').innerHTML = '';
            document.getElementById('password-error').innerHTML = '';
            document.getElementById('confirm-password-error').innerHTML = '';

            if (name.length < 3) {
                showAlert('Name must be at least 3 characters.', 'name-error');
                return false;
            }

            if (email.length < 3 || !isValidEmail(email)) {
                showAlert('Enter a valid email address.', 'email-error');
                return false;
            }

            if (password.length < 8) {
                showAlert('Password must be at least 8 characters.', 'password-error');
                return false;
            }

            if (password !== confirmPassword) {
                showAlert('Password confirmation does not match.', 'confirm-password-error');
                return false;
            }

            return true;
        }

        function showAlert(message, errorDivId) {
            Swal.fire({
                icon: 'error',
                title: 'Form Validation Failed!',
                text: message,
                confirmButtonText: 'OK'
            });
            document.getElementById(errorDivId).innerHTML = message;
        }

        function isValidEmail(email) {
            // A more permissive email validation regex
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>    
</body>

</html>

