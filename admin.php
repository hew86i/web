<?php 

session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != TRUE){
	header('location: index.php?err=2');
} else {

?>

<!DOCTYPE html>
<html lang="en">
  <head>  
  
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
 
  </head>
  <body>

  	<div class="container">
  		<div class="row well">
  			<h1> WEB ВАУЧЕРИ </h1>
  		</div>
  		
  		<div class="row well">
  			<form role="form" method="post" action="">

  				<div class="form-group">
  					<label class="col-md-3 control-label" for="textinput"><em>Внесете го кодот на картичката</em></label>  
  				<div class="col-md-4">
  				<input id="textinput" name="textinput" type="text" placeholder="Код на картичка" class="form-control input-md" required="">

  				<!-- <label><span>Внеси го кодот на картичката:   </span>
  					<input type="text" name="prebaraj" />
  					
  				</label> -->
  				</div>
  				<button type="submit" class="btn btn-default">Пребарај</button>
  			</form>

  		</div>

  		 <?php

			$conn = new PDO("sqlsrv:Server=MS00, 1488;Database=BetBookingMaster", "Josip", "Gal!leja123*");

			$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

			try			
			{
				if(isset($_POST['textinput'])) {
					//echo "Setiran post";					
					$karticka_kod = $_POST['textinput'];
				} else $karticka_kod = '';
				
				// $tsql = "SELECT * FROM dbo.WebVauceriTip";

				if (strlen($karticka_kod)<>36) {						
						?>
						<div class="row well">
							<h3 style="color:red"> Внесете <strong>валиден</strong> код на картичка </h3>
						</div>
						<?php
						die();
				}
			  $sql = "SELECT TOP 100
			  	  dbo.WebVauceri.CreatedDate,
			      dbo.WebVauceri.PosledenVaucer,
			      dbo.WebVauceri.VaznostSerija,
			      dbo.WebVauceri.Vauceri,				 
				  dbo.WebVauceri.IskoristeniVauceri,
				  dbo.WebVauceri.IznosVaucer,
				  dbo.WebVauceriTip.WVTipNaziv	   
			  FROM [BetBookingMaster].[dbo].[WebVauceri]
			  FULL JOIN dbo.WebVauceriTip
				ON (dbo.WebVauceri.PotekloTiketID = dbo.WebVauceriTip.WVTipID)
			  WHERE KartickaKod = '".$karticka_kod.
			  "' ORDER BY dbo.WebVauceri.PosledenVaucer DESC";
			  // print_r($sql);
			  // die();

				$stmt = $conn->query($sql);	
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				// echo "<pre>";
				// print_r($result);
				// echo "</pre>";
				}
				catch(Exception $e)
				{ 
				die( print_r( $e->getMessage() ) ); 
			}

		// if (isset($_POST) AND strlen($karticka_kod)<10) {
		// 	echo "test";
		// }	

			 ?>

 
  		<div class="row well">
  		
  			<div class="col-sm-12">
		  		<table class="table table-striped table-hover">

		  			<th>Доделен на</th>
		  			<th>Искористен ваучер</th>
		  			<th>Важност на серија</th>
		  			<th>Ваучери</th>
		  			<th>Искористени ваучери</th>
		  			<th>Износ на ваучер</th>
		  			<th>Тип на ваучер</th>

		  		<?php foreach ($result as $red) {

		  			echo "<tr>";
		  			foreach ($red as $key => $value) {

		  				if ($key == 'CreatedDate') { 

		  					// ZA DA GI OTSTRANI MILISEKUNDITE

		  					$var = substr($value, 0, -4); 
		  					$var = date("d-M-Y H:i", strtotime($var));
		  					echo "<td>".$var."</td>";
		  					continue;				
		  				} elseif ($key == 'PosledenVaucer') {
		  					
		  					$var = date("d-M-Y", strtotime($value));
		  					echo "<td>".$var."</td>";
		  					continue;	  
		  				} elseif ($key == 'VaznostSerija') {

		  					$var = date("d-M-Y", strtotime($value));
		  					echo "<td>".$var."</td>";
		  					continue;	  
		  				} elseif ($key == 'WVTipNaziv') {

		  					if ($value == ""){
		  						echo "<td>"." Втора шанса"."</td>";
		  					} else {
		  						echo "<td>".$value."</td>";
		  					}
		  					
		  					continue;	  
		  				} 


		  				else {
		  					echo "<td>".$value."</td>";
		  				}
		  				
		  				// echo "<td>".$value."</td>";

		  			}
		  			echo "</tr>";
		  		} 
		  		?>		  			
		  		
		  		</table>
		  	</div>

 		</div>

 	</div>  <!-- GLAVEN CONTEJNER -->

 	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>    

  </body>
</html>	

<?php } ?>
