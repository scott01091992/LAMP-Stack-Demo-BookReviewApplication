<!DOCTYPE HTML>
<html>
	<head>
		<title> Add Book and Review </title>
		<link rel='stylesheet' type='text/css' href='/assets/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='/assets/book_review.css'>
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='nav_bar'>
					<img id='logo' src='/assets/paypyr.png'>
					<a id='home' href='/books'>Home</a>
					<a id='logout' href='/logout'>Logout</a>

				</div>

			</div>
			<div class='row'>
				<div class='col-xs-12 col-sm-7'>
					<span id='title'><?= ucwords($data[0]['title']) ?></span>
					<h5>Author: <?= $data[0]['author'] ?></h5>
					<h4>Reviews:</h4>
					<?php
												foreach($data as $review){
							echo "<p>Rating: ";
							for($i=0; $i<$review['rating']; $i++){
								echo "<img height='15' width='15' src='/assets/star.png'>";
							}
							echo "</p><p>".$review['name']." says:".$review['review']."</p>";
							$date = date_format(date_create($review['created_at']), "F j, Y");
							echo "<p>Posted on ".$date." ";
							if($review['users_id'] == $this->session->userdata('current_user')){
								echo "<a href='/delete/{$review['id']}'>Delete this Review</a></p><hr>";
							}else{
								echo "</p><hr>";
							}

						}
					?>
				</div>
				<div class='col-xs-12 col-sm-5'>
					<form role='form' action=<?= "'/post_review/{$data[0]['book_id']}'" ?> method='post'>
						<div class='form-group'>
							<label for='review'>Add a Review: <?= form_error('review') ?></label>
							<textarea name='review' class='form-control custom_textarea' rows='5' name='review'></textarea>
						</div>
						<div class='form-group'>
							<label for='rating'>Rating: <?= form_error('rating') ?></label>
							<select name='rating' class="c-select selectpicker">
							  	<option selected value="1">1 Star</option>
							  	<option value="2">2 Stars</option>
							  	<option value="3">3 Stars</option>
							  	<option value="4">4 Stars</option>
							  	<option value="5">5 Stars</option>
							</select>
						</div>
						<button type='submit' class='custom_button'>Submit Review</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
