


<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cravitae</title>
    <link rel="stylesheet" href="/cssfile/style.css">
    <style>
        .error-message {
            color: red;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login.store') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            <div class="input-box">
                <input type="text" name="email" placeholder="Enter your email" required>
                <div id="email-error" class="error-message"></div>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Enter your password" required>
                <div id="password-error" class="error-message"></div>
            </div>
            <div class="input-box button">
                <input type="submit" value="Login Now">
            </div>
            <div class="text">
                <h3>Don't have an account? <a href="/register">Register now</a></h3>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            var email = document.getElementsByName("email")[0].value;
            var password = document.getElementsByName("password")[0].value;

            // Clear previous error messages
            document.getElementById('email-error').innerHTML = '';
            document.getElementById('password-error').innerHTML = '';

            // Check if the email is not empty and has a valid format
            if (!email || !isValidEmail(email)) {
                showAlert('Email yang anda masukan salah.', 'email-error');
                return false;
            }

            // Check if the password is at least 8 characters
            if (password.length < 8) {
                showAlert('Password yang anda masukan salah.', 'password-error');
                return false;
            }

            // You can add more checks here based on your requirements

            // If all checks pass, return true to submit the form
            return true;
        }

        function showAlert(message, errorDivId) {
            // You can customize the alert appearance using SweetAlert or other libraries
            document.getElementById(errorDivId).innerHTML = message;
        }

        function isValidEmail(email) {
            // A simple email validation regex
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>

</body>

</html>

