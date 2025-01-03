<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="row">
		<div class="col-md-6 mx-auto p-0">
			<div class="card">
				<div class="login-box">
					<div class="login-snip">
						<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
						<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"><a href="register.php">Sign Up</a></label>
						<div class="login-space">
							<div class="login">
								
								 <!-- Affichage du message d'erreur -->
								 <?php if (session()->has('error')) : ?>
        						 <div id="echec" class="alert alert-danger">
           						 <?= session('error') ?>
       							 </div>
   								 <?php endif; ?>
								 
								 <br>
								<form action="process_login" method="post">
									<div class="group">
										<label for="user" class="label">Email</label>
										<input id="user" type="text" class="input" name="logemail" placeholder="Enter your email" required>
									</div>
									<div class="group">
										<label for="pass" class="label">Password</label>
										<input id="pass" type="password" class="input" name="logpass" data-type="password" placeholder="Enter your password" required>
									</div>
									<div class="group">
										<input id="check" type="checkbox" class="check" name="remember" checked>
										<label for="check"><span class="icon"></span> Keep me Signed in</label>
									</div>
									<div class="group">
										<input type="submit" class="button" value="Sign In">
									</div>
									<div class="hr"></div>
									<div class="foot">
										<a href="#">Forgot Password?</a>
									</div>
								</form>
							</div>
							
							<div class="sign-up-form">
							<form action="/process_register" method="post">
                                <div class="group">
                                    <label for="username" class="label">Username</label>
                                    <input id="username" type="text" class="input" placeholder="Create your Username" name="Username" required>
                                </div>
                                <div class="group">
                                    <label for="password" class="label">Password</label>
                                    <input id="password" type="password" class="input" data-type="password" placeholder="Create your password" name="Password" required>
                                </div>
                                <div class="group">
                                    <label for="password_repeat" class="label">Repeat Password</label>
                                    <input id="password_repeat" type="password" class="input" data-type="password" placeholder="Repeat your password" name="Password_repeat" required>
                                </div>
                                <div class="group">
                                    <label for="email" class="label">Email Address</label>
                                    <input id="email" type="email" class="input" placeholder="Enter your email address" name="Email" required>
                                </div>
                                <div class="group">
                                    <input type="submit" class="button" name="submit" value="Sign Up">
                                </div>
                                <div class="hr"></div>
                                <div class="foot">
                                    <label for="tab-1">Already Member? Login</label>
                                </div>
                            </form>
							</div>
						</div>
					</div>   
				</div>
			</div>
		</div>
	</div>
</body>
</html>
