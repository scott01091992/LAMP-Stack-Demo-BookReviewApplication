<!DOCTYPE HTML>
<html>
	<head>
		<title> Welcome </title>
		<link rel='stylesheet' type='text/css' href='/assets/bootstrap.min.css'>
		<link rel='stylesheet' type='text/css' href='/assets/index.css'>
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='col-xs-12  heading' >
					<img id='logo' src='/assets/paypyr.png'>
				</div>
			</div>
			<div class='row'>
				<div class='col-sm-6' class='col-xs-12'>
					<?php 
					if($this->session->flashdata('fail'))
						{ 
							echo "<span class='fail'>".$this->session->flashdata('fail')."</span>";
						}
					elseif($this->session->flashdata('success'))
						{ 
							echo "<span class='success'>".$this->session->flashdata('success')."</span>"; 
						} 
					?>
					<h4 class='heading'>Register</h4>
					<form action='/register' method='post' role='form'>
						<div class='form-group'>
							<label for='name'>Name: <?= "<span class='fail'>".form_error('name')."</span>" ?></label>
							<input type='text' name='name' class='form-control'>
						</div>
						<div class='form-group'>
							<label for='alias'>Alias: <?= "<span class='fail'>".form_error('alias')."</span>" ?></label>
							<input type='text' name='alias' class='form-control'>
						</div>
						<div class='form-group'>
							<label for='email'>Email: <?= "<span class='fail'>".form_error('email')."</span>" ?></label>
							<input type='email' name='email' class='form-control'>
						</div>
						<div class='form-group'>
							<label for='name'>Password: <?= "<span class='fail'>".form_error('password')."</span>" ?></label>
							<input type='password' name='password' class='form-control'>
							<label>*Password should be at least 8 characters</label>
						</div>
						<div class='form-group'>
							<label for='confirm'>Confirm PW: <?= "<span class='fail'>".form_error('confirm')."</span>" ?></label>
							<input type='password' name='confirm' class='form-control'>
						</div>
						<button type='submit' class='custom_button'>Register</button>
					</form>
				</div>
				<div class='col-sm-6' class='col-xs-12'>
					<h4 class='heading'>Log in</h4>
					<?= "<span class='fail'>".$this->session->flashdata('login_fail')."</span>" ?>
					<form action='login' method='post' role='form'>
						<div class='form-group'>
							<label for='login_email'>Email: <?= "<span class='fail'>".form_error('login_email')."</span>" ?></label>
							<input type='email' name='login_email' class='form-control'>
						</div>
						<div class='form-group'>
							<label for='login_password'>Password: <?= "<span class='fail'>".form_error('login_password')."</span>" ?></label>
							<input type='password' name='login_password' class='form-control'>
						</div>
						<button type='submit' class='custom_button'>Login</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
