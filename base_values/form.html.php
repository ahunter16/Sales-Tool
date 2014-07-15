<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Modify Model</title>
		<link rel="stylesheet" type="text/css" href="modify.css">


	</head>
	<img src="http://www.converged.co.uk/images/page/converged-logo.gif" alt="Image not found">	<br>
	<hr>
	<body>
	<div id = "bases">
		<br><label id = "title">Active Base Values:</label><br>
<!-- 		<div id = "basehist">View/Update Base Values for:
			<form action = "basehistory" method = "get">
			<select id = "bwidth" name = "bwidth">
					<option value = "10">10</option>
					<option value = "20">20</option>
					<option value = "30">30</option>
					<option value = "40">40</option>
					<option value = "50">50</option>
					<option value = "100">100</option>
				</select> Mb/s 
				<input type = "submit" Value = "Go">
			</form> -->

		</div>
		<div id = "bvform">
				<form action = "" method = "post">
					<br>
				<input type = "submit" value = "Submit">
				<br>
				<br>
				<?php $tablerows = "";
		 		include 'baserow.php';?>
		 		</table>
		 	</form>
		 	<p><a href = "..">Back to Calculator</a></p>
		</div>


			<p> </p>
	</div>


	</body>
	
</html>