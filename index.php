<?php

session_start();

$_SESSION['logged_in'] = FALSE;

?>

<!DOCTYPE html>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> - ВАУЧЕРИ - </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 <!--    <link rel="stylesheet" type="text/css" href="css/template.css">  -->
 	<style type="text/css">

 		.table-striped > tbody > tr:nth-child(odd) > td,
		.table-striped > tbody > tr:nth-child(odd) > th {
  		background-color: #CFDBFF;
		}
		.table-hover > tbody > tr:hover > td,
		.table-hover > tbody > tr:hover > th {
  		background-color: #AA9AFC;
  		}
  		.well {
		  min-height: 20px;
		  padding: 19px;
		  margin-bottom: 20px;
		  background-color: #f5f5f5;
		  border: 1px solid #e3e3e3;
		  border-radius: 4px;
		  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
		          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
		    }
 	</style>

<html>
	<head>
		<title>WEB - VAUCERI</title>
	</head>
	<body>

		 <div class="container">
		 	<div class="row well">
			<form action="verify.php" method="post">
				<fieldset>
					<legend><h1>WEB login</h1></legend>
					<!-- <label for="password">Enter your password :</label><br/>
					<input type="password" name="password" id="password"/><br/><br/>
					<input type="submit" value=" Log In "/> -->

					<div class="form-group">
  					<label class="col-md-3 control-label" for="password"><em>Внесете ја вашата лозинка :</em></label>  
  					<div class="col-md-4">
  					<input id="password" name="password" type="password" placeholder="лозинка" class="form-control input-md" required="">

  					</div>
  				<button type="submit" class="btn btn-default">Login</button>

				</fieldset>
			</form>
			<?php 
			 //--------------- GET se setira vo admin.php i verify.php a ovde se pojavuva poraka -------------- 
			 ?>

			<?php if(isset($_GET['err']) && $_GET['err'] == 1){ ?>
				<h4>Please try again. Wrong username or password</h4>
			<?php } ?>
			<?php if(isset($_GET['err']) && $_GET['err'] == 2){ ?>
				<h4>Unauthorized access. Please log in first!</h4>
			<?php } ?>

			<?php 
			 //***************************************************************************************************
			 ?>

			</div>
		 </div>


		
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="js/bootstrap.min.js"></script>    


	</body>
</html>