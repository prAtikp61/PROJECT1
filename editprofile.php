<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditProfile</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #9ebc9e;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .edit-profile-container {
            width: 80%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            cursor: pointer;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn {
            border: 2px solid gray;
            color: gray;
            background-color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="edit-profile-container">
        <h1>Edit Profile</h1>

        <form id="edit-profile-form" enctype="multipart/form-data" method="POST" action="edit.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                <div id="name-error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
                <div id="email-error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Your Password" required>
                <div id="password-error" class="error-message"></div>
            </div>

             <div class="form-group">
                <label for="profile-photo">Profile Photo:</label>
                <div class="upload-btn-wrapper">
                    <button class="btn">Upload a file</button>
                    <input type="file" name="profile-photo" id="profile-photo" accept="image/*" />
                </div>
            </div> 

            <button type="submit" class="submit-btn">Save Changes</button>
        </form>
    </div>

    <script>
        document.getElementById('edit-profile-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(function(errorMessage) {
            errorMessage.textContent = '';
        });

        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        var isValid = true;

        if (!name) {
            document.getElementById('name-error').textContent = 'Name is required';
            isValid = false;
        }

        if (!email) {
            document.getElementById('email-error').textContent = 'Email is required';
            isValid = false;
        } else if (!isValidEmail(email)) {
            document.getElementById('email-error').textContent = 'Invalid email format';
            isValid = false;
        }

        if (!password) {
            document.getElementById('password-error').textContent = 'Password is required';
            isValid = false;
        }

        if (isValid) {
            document.getElementById('edit-profile-form').submit();
        }
    });

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>

</body>
</html>