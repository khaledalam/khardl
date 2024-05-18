<!-- resources/views/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Retaurant Owner</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        /* Add your CSS styles for the popup here */
        /* Make sure to hide the popup by default */
        #loginPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
    </style>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh;    ">

<button id="showLoginPopup">Login</button>

<!-- Login Popup -->
<div id="loginPopup">
    <h2>Login</h2>
    <form id="loginForm">
        <label for="username">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Add your JavaScript code for handling the popup here
    $(document).ready(function () {
        $('#showLoginPopup').click(function () {
            $('#loginPopup').fadeIn();
        });

        $('#loginForm').submit(function (e) {
            e.preventDefault();

            // Handle form submission and HTTP Basic Authentication using Ajax
            // ...

            // Close the popup after successful login or handle errors
            $('#loginPopup').fadeOut();
        });
    });


    // Add your JavaScript code for handling the popup here
    $(document).ready(function () {
        $('#showLoginPopup').click(function () {
            $('#loginPopup').fadeIn();
        });

        $('#loginForm').submit(function (e) {
            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: '/login/owner', // Update with your Laravel route for handling login
                type: 'POST',
                headers: {
                    'Authorization': 'Basic ' + btoa(email + ':' + password),
                },
                data: {
                    email: email,
                    password: password
                },
                success: function (data) {
                    // Handle successful login
                    $('#loginPopup').fadeOut();
                },
                error: function (xhr, status, error) {
                    // Handle login error
                    console.error('Login failed:', error);
                }
            });
        });
    });


</script>

</body>
</html>
