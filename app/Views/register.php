<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                <form action="SignUp_Process" method="POST" id="signup-form" class="signup-form">
    <h2 class="form-title">Create account</h2>

            <!-- Affichage des erreurs générales -->
            <?php if (session('general_error')): ?>
                <div style="color: red; margin-bottom: 15px; text-align: center;">
                    <?= session('general_error') ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <input type="text" class="form-input" name="UserFname" id="name" placeholder="First Name" value="<?= old('UserFname') ?>" required/>
            </div>

            <div class="form-group">
                <input type="text" class="form-input" name="UserName" id="name" placeholder="Last Name" value="<?= old('UserName') ?>" required/>
            </div>

            <div class="form-group">
                <input type="email" class="form-input" name="UserEmail" id="email" placeholder="Email" value="<?= old('UserEmail') ?>" required/>
            </div>

            <div class="form-group">
                <input type="password" class="form-input" name="UserPass" id="password" placeholder="Password" required/>
            </div>

            <div class="form-group">
                <input type="password" class="form-input" name="UserConfpass" id="re_password" placeholder="Repeat your password" required/>
            </div>
            <div id="password-error" style="color: red; display: none;">
                             Passwords do not match.
                        </div>
            <div class="form-group">
                <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
            </div>
        </form>

                            <p class="loginhere">
                                Have already an account ? <a href="<?= site_url('login') ?>" class="loginhere-link">Login here</a>
                            </p>
                        </div>
                    </div>
                </section>

            </div>

            <!-- JS -->
            <script src="assets/vendor/jquery/jquery.min.js"></script>
            <script src="assets/js/main.js"></script>
            <script src="assets/js/pass.js"></script>
        </body>
        </html>