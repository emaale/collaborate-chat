<!DOCTYPE HTML>
<html>
<head>
	<title>Register Page</title>

	<link rel="stylesheet" href="resources/css/login.css">

	<script src="resources/js/jquery.min.js"></script>
	<script src="resources/js/login.js"></script>
</head>
<body>
	<section class="form-wrapper">
		<h1>Register</h1>

		<form action="/user/register" method="POST" id="register-form">
			<input type="text" name="username" placeholder="Username" required />
			<input type="password" name="password" placeholder="Password" required />
			<input type="password" name="password_repeat" placeholder="Repeat Password" />
			
			<button class="register-btn">Register</button>

			<span class="error"></span>
		</form>

		<span>Already have an account? <a href="/login">Login here.</a></span>
	</section>
</body>
</html>