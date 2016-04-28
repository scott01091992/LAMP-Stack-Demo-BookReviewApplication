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
				<div class='col-xs-8'>
					<span id='title'><?= $data[0]['title'] ?></span>
				</div>
				<div class='col-xs-offset-8'>
					<a id='home' href='/books'>Home</a>
					<a id='logout' href='/logout'>Logout</a>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-7' class='col-xs-12'>
					<h4>Author: <?= $data[0]['author'] ?></h4>
					<h3>Reviews:</h3>
					<?php
						foreach($data as $review){
							echo "<p>Rating: ";
							for($i=0; $i<$review['rating']; $i++){
								echo "<img src='/assets/star.png'>";
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
				<div class='col-sm-5' class='col-xs-12'>
						<form role='form' action=<?= "'/post_review/{$data[0]['id']}'" ?> method='post'>
						<div class='form-group'>
							<label for='review'>Add a Review: <?= form_error('review') ?></label>
							<textarea name='review' class='form-control' rows='5' name='review'></textarea>
						</div>
						<div class='form-group'>
							<label for='rating'>Rating: <?= form_error('rating') ?></label>
							<select name='rating' class="c-select">
							  	<option selected value="1">1 Star</option>
							  	<option value="2">2 Stars</option>
							  	<option value="3">3 Stars</option>
							  	<option value="4">4 Stars</option>
							  	<option value="5">5 Stars</option>
							</select>
						</div>
						<button type='submit' class='btn btn-default'>Submit Review</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
