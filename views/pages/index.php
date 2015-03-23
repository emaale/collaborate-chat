<!DOCTYPE HTML>
<html>
<head>
	<title>Login Page</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
			<!-- Button to add user/group -->
			<a href="#" class="add-btn">
				<span class="icon-add"></span>
			</a>

			<header>
				<span class="search-btn icon-search"></span>
				<input type="text" class="search-bar">

				<span class="menu-btn icon-more-vert"></span>

				<div class="dropdown">
					<span class="current-option">All</span>
					<span class="icon-arrow-drop-down"></span>
				</div>
			</header>

			<nav>
				<a href="#" class="active"><span class="icon-person"></span></a>
				<a href="#"><span class="icon-group"></span></a>
				<a href="#"><span class="icon-notifications"></span></a>
			</nav>

			<section>
				<a href="#">
					<article>
						<img src="resources/images/137H.jpg" alt="">
						
						<div class="information-container">
							<span class="name">
								Emanuel Alenius
								<span class="favorite icon-star"></span>
							</span>

							<span class="online-status online icon-lens"></span>

							<span class="last-message">Hello man how was it...</span>

							<span class="date">15 Jan</span>
						</div>
					</article>
				</a>
				<a href="#">
					<article class="active">
						<img src="resources/images/137H.jpg" alt="">
						
						<div class="information-container">
							<span class="name">
								Test Alenius
								<span class="favorite icon-star-outline"></span>
							</span>

							<span class="online-status online icon-lens"></span>

							<span class="last-message unread">Hello man how was it...</span>

							<span class="date">15 Jan</span>
						</div>
					</article>
				</a>
				<a href="#">
					<article>
						<img src="resources/images/137H.jpg" alt="">
						
						<div class="information-container">
							<span class="name">
								Offline User
								<span class="favorite icon-star-outline"></span>
							</span>

							<span class="online-status offline icon-lens"></span>

							<span class="last-message">Hello man how was it...</span>

							<span class="date">15 Jan</span>
						</div>
					</article>
				</a>
			</section>
		</aside>

		<section class="chat">
			<header>
				<div class="details">
					<img src="resources/images/137H.jpg" alt="">

					<span class="name">Emanuel Alenius</span>
				</div>
				
				<div class="options">
					<div class="dropdown">
						<span class="current-option">All</span>
						<span class="icon-arrow-drop-down"></span>
					</div>

					<span class="menu icon-more-vert"></span>
				</div>
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
					<a href="#">
						<span class="smiley-btn icon-keyboard-alt"></span>	
					</a>
				</div>

				<textarea class="message-bubble" placeholder="Type here..."></textarea>

				<div class="right-options">
					<a href="#">
						<span class="attachment-btn icon-attach-file"></span>
					</a>
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