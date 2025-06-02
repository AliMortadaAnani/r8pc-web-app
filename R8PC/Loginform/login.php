
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="file1.css">
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="loginDB.php" method="POST" onsubmit="return validateLoginForm()">
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" name="email" placeholder="Email">
                <img class="icons" src="images\person.png" alt="person photo">
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password">
                <img  class="icons" src="images\lock.png" alt="lock photo">
            </div>

           

            <button type="submit" class="btn" name="signin">
                Login
            </button>

            <div class="register-link">
                <p>
                    Don't have an account? 
                    <a href="signup.php">
                        SIGNUP
                    </a>
                </p>
            </div>
                        <script>
                
                const urlParams = new URLSearchParams(window.location.search);
                const errorParam = urlParams.get('error');

                
                if (errorParam === '1') {
                    alert('Incorrect email or password. Please try again.');
                }
                    </script>
        </form>
    </div>

    <script>
        function validateLoginForm() {
          
            if (isEmptyFields()) {
                alert('All fields are required');
                return false;
            }
            return true;
        }

        function isEmptyFields() {
            var fields = document.querySelectorAll('input[type="text"], input[type="password"]');
            
            for (var i = 0; i < fields.length; i++) {
                if (fields[i].value.trim() === '') {
                    return true;
                }
            }

            return false;
        }
    </script>
   
</body>
</html>
