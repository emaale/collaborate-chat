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