<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="resources/css/lightbox.css">
	<link rel="stylesheet" href="resources/css/styles.css">
	
	<script src="resources/js/jquery.min.js"></script>
	<script src="resources/js/lightbox.min.js"></script>
	<script src="resources/js/gallery.js"></script>
</head>
<body>
	<header class="site-header">
		<h1>Gallery</h1>

		<nav>
			<span class="user">Emanuel Alenius</span>
			
			<input type="text" class="search-bar">
			<a href="#"><span class="icon-search search-btn"></span></a>

			<a href="#"><span class="icon-more-vert menu-btn"></span></a>

			<ul class="dropdown-menu misc-menu">
				<a href="#">
					<li>Settings</li>

					<li class="logout-btn">Logout</li>
				</a>
			</ul>
		</nav>
	</header>
	
	<div class="tabs-wrapper">
		<nav>
			<div class="tabs">
				<a href="#" id="my-images-tab" class="active">My Images</a>
				<a href="#" id="images-tab">Images</a>
				<a href="#" id="saved-images-tab">Saved</a>
			</div>

			<div class="actions">
				<div class="filter">
					<a href="#"><h3 class="filter-name">Date</h3></a>

					<a href="#"><span class="icon-arrow-drop-down filter-btn"></span></a>

					<ul class="dropdown-menu filter-menu">
						<a href="#">
							<li class="user-filter">User</li>
						</a>
						<a href="#">
							<li class="date-filter">Date</li>
						</a>
						<a href="#">
							<li class="rating-filter">Rating</li>
						</a>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	
	<div class="gallery-wrapper">
		<section class="gallery">
			@foreach($images as $image)
				<article class="image-wrapper" id="{{$image['image_id']}}">
					<a href="{{$image['image_src']}}">
						<img src="{{$image['image_src']}}" alt="An image">
					</a>

					<div class="details">
						<a href="{{$image['image_src']}}" class="image-name">{{$image['title']}}</a>

						<span>Uploaded by <a href="#" class="accent-color">{{$image['uploaded_by']}}</a></span>

						<a href=""><span class="icon-favorite-outline"></span></a>
					</div>

					<div class="misc">
						@if($image['avg_rating'] !== 0)
							<span class="icon-star"></span>
							<span class="rating">{{$image['avg_rating']}}</span>
						@else
							<div class="stars">
								<span class="icon-star-outline"></span>
								<span class="icon-star-outline"></span>
								<span class="icon-star-outline"></span>
								<span class="icon-star-outline"></span>
								<span class="icon-star-outline"></span>
							</div>
						@endif

						<a href=""><span class="icon-share share"></span></a>
					</div>
				</article>
			@endforeach
		</section>	
	</div>
	
	<!-- Hide the default file input button, and use our own to trigger the same behaviour -->
	<div style="height:0px;overflow:hidden">
		<input type="file" id="fileInput" name="fileInput" accept="image/*" />
	</div>
	<a href="#"><span class="icon-add add-image-btn"></span></a>

	<!-- Used for notifications -->
	<div class="toast">
		<p>Image has been uploaded.</p>
	</div>

	<div class="image-viewer">
		<header>
			<h3></h3>

			<span class="close icon-close"></span>
		</header>
		<section>
			<img src="#" alt="">

			<span class="icon-keyboard-arrow-left btn-prev"></span>
			<span class="icon-keyboard-arrow-right btn-next"></span>
		</section>
		<footer>
			<span class="icon-star"></span>
			<span class="rating">4.3</span>

			<a href=""><span class="icon-share share"></span></a>
		</footer>
	</div>

	<!-- Popup panel, used for settings and to add an image -->
	<div class="popup-panel">
		
	</div>
	
	<!-- Opacity cover, that darkens the whole screen, so that other content pops out -->
	<div class="opacity-cover"></div>
</body>
</html>