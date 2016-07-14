<!DOCTYPE HTML>
<html>
	<head>
		<title> Books Home </title>
		<link rel='stylesheet' type='text/css' href='/assets/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='/assets/add.css'>
	</head>
	<body>
		<div class='container'>
			<div class='row title_row'>
				<div class='col-xs-9 '>
					<h3>Add a New Book Title and a Review</h3>
				</div>
				<div class='col-xs-3 title_row'>
					<a id='home' href='/books'>Home</a>
					<a id='logout' href='/logout'>Logout</a>
				</div>					
			</div>
			<div class='row'>
				<div class='col-xs-12'>
					<form role='form' action='/add_book' method='post'>
						<div class='form-group'>
							<label for='book_title'>Book Title: <?= "<span class='fail'>".form_error('book_title')."</span>" ?></label>
							<input class='form-control' type='text' name='book_title'>
						</div>
						<label>Author:</label>
						<div id='choose_author'>
							<div class='form-group'>
								<label for='list_author'>Choose from the list:</label>
								<select class='selectpicker form-control' name='list_author'>
									<option selected>None Selected</option>
									<?php
										foreach($authors as $author){
											echo "<option class='author_option'>{$author['author']}</option>";
										}
									?>
								</select>
							</div>
							<div class='form-group'>
								<label for='text_author'>Or add a new author:</label>
								<input class='form-control' name='text_author' type='text'>
							</div>
						</div>
						<div class='form-group'>
							<label for='review'>Review: <?= "<span class='fail'>".form_error('review')."</span>" ?></label>
							<textarea class='form-control custom_textarea' name='review' rows='5'></textarea>
						</div>
						<div class='form-group'>
							<label for='rating'>Rating</label>
							<select name='rating' class="c-select">
							  	<option selected value="1">1 Star</option>
							  	<option value="2">2 Stars</option>
							  	<option value="3">3 Stars</option>
							  	<option value="4">4 Stars</option>
							  	<option value="5">5 Stars</option>
							</select>
						</div>
						<button type='submit' class='custom_button'>Add Book and Review</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
