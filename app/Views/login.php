<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form action="SignIn_Process" method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Sign in</h2>
                         <!-- Affichage des erreurs générales -->
                            <?php if (session('general_error')): ?>
                                <div style="color: red; margin-bottom: 15px; text-align: center;">
                                    <?= session('general_error') ?>
                                </div>
                            <?php endif; ?>
                        <div class="form-group">
                            <input type="email" class="form-input" name="logemail" id="email" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group"> 
                            <input type="password" class="form-input" name="logpass" id="password" placeholder="Password" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign in"/>
                      
                </div>
                <!----here-->
            </div>
        </section>

    </div>


    

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>



