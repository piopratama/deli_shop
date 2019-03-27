<?php 
session_start(); 
$title="Login";
?>
<!DOCTYPE html>
<html>
	<?php include("./templates/header.php"); ?>
	<link rel="stylesheet" type="text/css" href="./css/loginStyle.css">
	<body>
		
		
		<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 header" style="border-radius:0px;padding-left:0px;padding-right:0px;">
						<nav class="navbar navbar-default" role="navigation" style="background-color: #38B593;border-radius:0px;height:80px;">
							<div class="container-fluid">
								<!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a class="navbar-brand" style="font-size: 40px;margin-top:15px; color:black;" href="#">Deli Point</a>
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
			<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					
				</div>
				<div class="col-md-4" id="container-form">
					<form action="loginProcess.php" method="POST" role="form" style="background-color: #38B593;padding:50px;">
						<legend style="font-size:30px;">Login</legend>
					
						<div class="form-group" style="position:relative;">
							<label for="">Username</label>
							<input type="text" name="username" class="form-control" id="username" placeholder="Username" required="required">
							<span class="glyphicon glyphicon-user" style="position:absolute;Right:10px;Top:35px;"></span>
						</div>
						
						<div class="form-group" style="position:relative;">
							<label for="">Password</label>
							<input type="password" name="password" class="form-control" id="password" placeholder="Password" required="required">
							<span class="glyphicon glyphicon-lock" style="position:absolute;Right:10px;Top:35px;"></span>
						</div>
						<!-- <div class="form-group">
							<label>Level</label>
							<select name="level" class="form-control">
								<option value="admin">Admin</option>
								<option value="casier">Casir</option>
								
							</select>
						</div> -->
						
					
						<button type="submit" class="btn btn-default pull-right" style="border-radius:0px;width:100px;background-color:white;">Login</button>
						<div class="clear" style="clear:both;"></div>
					</form>
				</div>
				<div class="col-md-4">
					
				</div>
			</div>
		</div>

		<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel2">Warning</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Login Failed.</p>
					<p>Please check your username and password are correct</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
        </div>
		
		<?php 
			$session_value=(isset($_SESSION['message']))?$_SESSION['message']:'';
			unset($_SESSION['message']);
		?>
		<?php include("./templates/footer.php"); ?>
		<script>
			$(document).ready(function() {
				var message='<?php echo $session_value;?>';
				if(message!="")
				{
					$("#exampleModal2").modal('show');
				}
			});
		</script>
	</body>
</html>