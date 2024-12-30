<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="http://localhost/codeigniter4-projets/public/assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="row">
		<div class="col-md-6 mx-auto p-0">
			<div class="card">
				<div class="login-box">
					<div class="login-snip">
						<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
						<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
						<div class="login-space">
							<div class="login">
								<form action="/process_login" method="post">
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
								<!-- Placez ici le formulaire "Sign Up" si nécessaire -->
							</div>
						</div>
					</div>   
				</div>
			</div>
		</div>
	</div>
</body>
</html>
