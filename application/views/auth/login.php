<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

	<title>Majoo | Login Dashboard</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

	<!-- Bootstrap core CSS -->
	<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="https://getbootstrap.com/docs/4.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
	<form class="form-signin" action="<?php echo base_url()?>auth/prosesLogin" method="POST">
		<img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72"
			height="72">
		<h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
		<?php
		if($this->session->flashdata('message')){
			echo '<div class="alert alert-info" role="alert">'.$this->session->flashdata('message').'</div>';
		}
		?>
		<label for="Username" class="sr-only">Username</label>
		<input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
		<label for="Password" class="sr-only">Password</label>
		<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y')?></p>
	</form>
</body>

</html>