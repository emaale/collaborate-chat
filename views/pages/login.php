<!DOCTYPE HTML>
<html>
<head>
	<title>Login Page</title>

	<link rel="stylesheet" href="resources/css/login.css">

	<script src="resources/js/jquery.min.js"></script>
	<script src="resources/js/login.js"></script>
</head>
<body>
	<section class="form-wrapper">
		<h1>Login</h1>

		<form action="/user/login" method="POST" id="login-form">
			<input type="text" name="username" placeholder="Username" required>
			<input type="password" name="password" placeholder="Password" required>

			<button class="login-btn">Login</button>

			<span class="error"></span>
		</form>

		<span>Don't have an account? <a href="/register">Register here.</a></span>
	</section>
	
</body>
</html>