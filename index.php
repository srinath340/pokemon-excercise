<?php
	session_start();
	require_once("functions.php");
	
	//cost of each pokemon
	$Cost_Pikachu = 6;
	$Cost_Squirtle = 5;
	$Cost_Charmander = 5;
	
	if(isset($_POST['Buy']) && $_POST['Buy']=="Purchase"){		//validating the purchase
			$Units_ofPikachu = $_POST['Pikachu'];
			$Units_ofSquirtle = $_POST['Squirtle'];
			$Units_ofCharmander = $_POST['Charmander'];
			
			Calculate($Units_ofPikachu,$Units_ofSquirtle,$Units_ofCharmander);
			
			Cost($Cost_Pikachu,$Cost_Squirtle,$Cost_Charmander,$Units_ofPikachu,$Units_ofSquirtle,$Units_ofCharmander);
			
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="application/xhtml+xml;"/>
	<title>::&nbsp;&nbsp;Pokemon&nbsp;&nbsp;::</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet" type="text/css" />
	<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<?php	if(!isset($_POST['Buy'])){	?>
	<form action="" method="POST" >
	<table width="40%" class="table table-bordered">
		<tr>
			<th>Pokemon for sale</th>
			<th>Price</th>
			<th>Units</th>
		</tr>
		<tr>
			<td>Pikachu: </td>
			<td>$6</td>
			<td><input type="number" value="0" class="form-control input_width" id="Pikachu" name="Pikachu" min="0"></td>
		</tr>
		<tr>
			<td>Squirtle: </td>
			<td>$5</td>
			<td><input type="number" value="0" class="form-control input_width" id="Squirtle" name="Squirtle" min="0"></td>
		</tr>
		<tr>
			<td>Charmander: </td>
			<td>$5</td>
			<td><input type="number" value="0" class="form-control input_width" id="Charmander" name="Charmander"  min="0"></td>
		</tr>
		<tr>
			<td colspan="3" style="text-align:center;">	<input type="submit"  class="btn btn-primary" value="Purchase" id="Buy" name="Buy"></td>
		</tr>
	</table>
	</form>
	<?php	}	?>
	<?php	if(isset($_POST['Buy']) && $_POST['Buy']=="Purchase"){	?>
	<form>
	<table width="40%" class="table table-bordered">
		<tr>
			<th>Pokemon</th>
			<th>Number</th>
			<th>Discount %</th>
			<th>Total(Deducting Discount %)</th>
		</tr>
		<tr>
			<td>Groups with 3 different pokemon: </td>
			<td><?php echo $_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units']; ?></td>
			<td>20 %</td>
			<td><?php echo $_SESSION['Order_Types']['With_3kinds_of_Pokemon']['cost']; ?></td>
		</tr>
		<tr>
			<td>Groups with 2 different pokemon: </td>
			<td><?php echo $_SESSION['Order_Types']['With_2kinds_of_Pokemon']['units']-$_SESSION['Order_Types']['With_3kinds_of_Pokemon']['units']; ?></td>
			<td>10 %</td>
			<td><?php echo $_SESSION['Order_Types']['With_2kinds_of_Pokemon']['cost']; ?></td>
		</tr>
		<tr>
			<td>Pokemon of a single group: </td>
			<td><?php echo $_SESSION['Order_Types']['With_1kind_of_Pokemon']['units']-$_SESSION['Order_Types']['With_2kinds_of_Pokemon']['units']; ?></td>
			<td>0 %</td>
			<td><?php echo $_SESSION['Order_Types']['With_1kind_of_Pokemon']['cost']; ?></td>
		</tr>
		
	</table>
	</form>
	<?php	}	?>

</body>
</html>
