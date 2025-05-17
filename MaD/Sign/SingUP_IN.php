<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- normalized all element  -->
    <link rel="stylesheet" href="../../css/normalized.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="./Sign.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="Sign">

            <div class="Sign_IN active">
                <div>
                    <h2>Sign In <i class="fa-solid fa-right-to-bracket"></i></h2>
                    <p>Welcome Back </p>
                </div>
                
                <form action="Sign_IN.php" method="POST">
                    <div class="inputBox">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                        
                    </div>
                    <div class="inputBox">
                        <label for="password">Password</label>
                        <input type="password" name="password" required>
                        
                    </div>
                    <div>
                        <button class="SignIn" type="submit">Sign In</button>
                        <p>Don't have an account? <a >Sign Up</a></p>
                    </div>
                 
                </form>
            </div>
            <div class="Sign_UP">
                <div>
                    <h2>Sign Up <i class="fa-solid fa-user-plus"></i></h2>
                    <p>Create an account</p>
                </div>
                
                <form action="Sign_UP.php" method="POST">
                    <div class="inputBox">
                        <label for="name">Name</label>
                        <input type="text" name="name" required>
                        
                    </div>
                    <div class="inputBox">
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                        
                    </div>
                    <div class="inputBox">
                        <label for="password">Password</label>
                        <input type="password" name="password" required>
                        
                    </div>
                    <div class="inputBox">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" required>
                        
                    </div>
                    <button class="SignUp" type="submit">Sign Up</button>
                </form>
                <p>Already have an account? <a >Sign In</a></p>

            </div>


    </div>
    
    <script src="./Sign.js"></script>
</body>
</html>
<?php


?>