<!DOCTYPE HTML>
<html>
	<head>
		<title> User Reviews </title>
		<link rel='stylesheet' type='text/css' href='/assets/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='/assets/user.css'>
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='nav_bar'>
					<img id='logo' src='/assets/paypyr.png'>
			
					<a id='home' href='/books'>Home </a>

					<a id='logout' href='/logout'> Logout </a>
					
				</div>
			</div>
			<div class='row'>
				<div class='col-xs-12'>
					<h3>User Alias: <?= $data[0]['alias'] ?></h3>
				</div>
				<div class='col-xs-12'>
					<h5>Name: <?= $data[0]['name'] ?></h5>
					<h5>Email: <?= $data[0]['email'] ?></h5>
					<h5>Total Reviews: <?= COUNT($data) ?></h5><hr>
					<h4>Posted Reviews on the following books:</h4>
						<?php
							foreach($data as $book){
								echo "<p class='book'><a href='/book/{$book['bookid']}'>".$book['title']."</a></p>";
							}
						?>
				</div>
			</div>
		</div>
	</body>
</html>
