<!DOCTYPE HTML>
<html>
<head>
	<title>Login Page</title>

	<link rel="stylesheet" href="resources/css/main.css">

	<script src="resources/js/jquery.min.js"></script>
	<script src="resources/js/login.js"></script>
</head>
<body>
	<!-- Background overlay -->
	<div class="bg-overlay"></div>
	
	<!-- The chat wrapper, that wraps all chat related things -->
	<section class="chat-wrapper">
		<aside class="friendlist">
			<header>
				<img src="resources/images/137H.jpg" alt="">

				<span class="name">Emanuel Alenius</span>
			</header>

			<section>
				<a href="#">
					<article>
						<img src="resources/images/137H.jpg" alt="">

						<span class="name">Emanuel Alenius</span>

						<span class="date">2015-03-03</span>

						<span class="last-message">Hello man how was it goin...</span>
					</article>
				</a>
			</section>
		</aside>

		<section class="chat">
			<header>
				
			</header>

			<section>
				<div class="bubble-wrapper">
					<article class="bubble text">
						This is some text, and is supposed to be a message, I hope it comes out great.
					</article>	
				</div>

				<div class="bubble-wrapper">
					<article class="bubble text right">
						This is some text, and is supposed to be a message, I hope it comes out great.
					</article>	
				</div>

				<div class="bubble-wrapper">
					<article class="bubble text">
						This is some text, and is supposed to be a message, I hope it comes out great.
					</article>	
				</div>

				<div class="bubble-wrapper">
					<article class="bubble formatted-text">
						<h2>Heading</h2>

						<p>
							This is some text, let's hope this looks good. I'm going to continue to write
							like this in hopes that it fills up more real estate.
						</p>

						<ul>
							<li>This is an unordered list</li>
							<li>It gots items</li>
							<li>Hopefully many more</li>
						</ul>

						<p>This is an ordered list: </p>

						<ol>
							<li>Item number 1</li>
							<li>Are you expecting a second?</li>
						</ol>

						<a href="#">This is a link to something important</a>

						<p>
							This is some text, let's hope this looks good. I'm going to continue to write
							like this in hopes that it fills up more real estate.
						</p>

						<img src="resources/images/137H.jpg" alt="">

						<p>
							This is some text, let's hope this looks good <a href="#">This is a link to something important</a>. I'm going to continue to write
							like this in hopes that it fills up more real estate.
						</p>
					</article>	
				</div>

				<div class="bubble-wrapper">
					<article class="bubble image">
						<a href="#">
							<img src="resources/images/137H.jpg" alt="">	
						</a>
					</article>	
				</div>
				
			</section>

			<footer>
				<div class="left-options">
					
				</div>

				<textarea class="message-bubble" placeholder="Type here..."></textarea>

				<div class="right-options">
					
				</div>
			</footer>
		</section>
	</section>

	<div class="notification">
		<span class="description">User deleted</span>

		<a href="#" class="action">UNDO</a>
	</div>
</body>
</html>