<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="./assets/bootstrap3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/loginStyle.css">
	</head>
	<body>
		
		
		<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 header">
						<nav class="navbar navbar-default" role="navigation">
							<div class="container-fluid">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a class="navbar-brand" style="font-size: 40px;" href="#">Deli Shop</a>
								</div>
								<div class="collapse navbar-collapse navbar-ex1-collapse">						
									<ul class="nav navbar-nav navbar-right">
									</ul>
								</div><!-- /.navbar-collapse -->
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div class="container">
			<div class="row">
				<div class="col-md-4">
					
				</div>
				<div class="col-md-4" id="container-form">
					<form action="loginProcess.php" method="POST" role="form">
						<legend>Login</legend>
					
						<div class="form-group">
							<label for="">Username</label>
							<input type="text" name="username" class="form-control" id="username" placeholder="Username" required="required">
						</div>
						
						<div class="form-group">
							<label for="">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Password" required="required">
						</div>
						<!-- <div class="form-group">
							<label>Level</label>
							<select name="level" class="form-control">
								<option value="admin">Admin</option>
								<option value="casier">Casir</option>
								
							</select>
						</div> -->
						
					
						<button type="submit" class="btn btn-primary">Login</button>
						
					</form>
				</div>
				<div class="col-md-4">
					
				</div>
			</div>
		</div>
		<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);
		?>
		<script src="./assets/jquery.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="./assets/bootstrap3.3.7/js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function() {
				var message='<?php echo $session_value;?>';
				if(message!="")
				{
					alert(message);
				}
			});
		</script>
	</body>
</html>