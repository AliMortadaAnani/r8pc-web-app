
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="file1.css">
</head>
<body>
    <div class="wrapper">
        <form action="signupDB.php" method="POST" onsubmit="return validateForm()">
            <h1>Signup</h1>

            <div class="input-box">
                <input type="text" name="username" placeholder="Choose a Username">
            </div>

            <div class="input-box">
                <input type="email" name="email" placeholder="Enter Your Email">
            </div>
            <?php
                
                if (isset($_GET['error']) && $_GET['error'] === 'email_exists') {
                   
                    if (isset($_GET['message'])) {
                       
                        $errorMessage = urldecode($_GET['message']);
                        $errorClass = 'error-message';
                        echo '<div class="' . $errorClass . '">'. $errorMessage . '</div>';
                    }
                }
            ?>

            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Choose a Password" onkeyup="validatePassword()">
                <span id="password-length-message" class="error-message"></span>
            </div>

            <div class="input-box">
                <input type="password" name="password-repeat" placeholder="Rewrite Your password">
                <?php
           
                if (isset($_GET['error']) && $_GET['error'] === 'password_mismatch') {
               
                    if (isset($_GET['message'])) {
                 
                        $errorMessage = urldecode($_GET['message']);
                        $errorClass = 'error-message2';
                        echo '<div class="' . $errorClass . '">'. $errorMessage . '</div>';
                    }
                }
            ?>
            </div>

            <div class="">
                    <input type="checkbox" name="agree_terms" id="agree-terms">
                    I agree to the terms and conditions<br>
                <span id="terms-message" class="error-message"></span>
            </div>

            <div class="">
                <input type="submit" class="btn" value="SIGNUP" name="signup">
            </div>

            <div class="return-home">
                <p>
                    Already have an Account ? 
                    <a href="login.php">
                        LOGIN
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
        
            if (isEmptyFields()) {
                alert('All fields are required ya mohammad ');
                return false;
            }

          
            return validatePassword() && validateTerms();
        }

        function isEmptyFields() {
        var fields = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
            for (var i = 0; i < fields.length; i++) {
                if (fields[i].value.trim() === '') {
                    return true;
                }
            }
            return false;
        }

        


                function validatePassword() {
            var password = document.getElementById('password').value;
            var passwordLengthMessage = document.getElementById('password-length-message');
          
            if (password.length < 8) {
                passwordLengthMessage.innerHTML = 'Password must be at least 8 characters';
            } else {
                passwordLengthMessage.innerHTML = '';
            }
            
            return password.length >= 8;
        }


        function validateTerms() {
            var agreeTerms = document.getElementById('agree-terms').checked;
            var termsMessage = document.getElementById('terms-message');
          
            if (!agreeTerms) {
                termsMessage.innerHTML = 'You must agree to the terms and conditions';
            } else {
                termsMessage.innerHTML = '';
            }
            return agreeTerms;
        }
    </script>
</body>
</html>
