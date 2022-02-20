<?php
	$serverName = "localHost";
	$userName = "root";
	$password = "";
	$datanase = "std_data";
	$id = $_POST ['stdid'];
	$name = $_POST ['stdname'];
	$city = $_POST ['stdcity'];

	$conn = mysqli_connect($serverName, $userName, $password, $datanase);

	if (!$conn) {
		die("Connection failed ". mysqli_connect_error());
	}
	else{
		echo "Connected successfully <br>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>DataBase</title>
	</head>

	<style type="text/css">
		.padding{
			padding: 4px;
			margin-left: 10%;
		}
		body {
 			background-image: url('https://wp-mktg.prod.getty1.net/istockcontentredesign/wp-content/uploads/sites/5/2021/03/2021_iStock_LatestBGTrends_Hero.jpg.jpeg');
 			background-repeat: no-repeat;
 			background-size: 100%;
		}
		table{
			background-color: white;
		}
		th{
			background-color: #ee74f2;
			font-size: 30px;
		}
		table,th,td{
			border: solid black;
			border-collapse: collapse;
			padding: 5px;
		}
		#one td{
			border-right: none;
		}
	</style>

	<body>
	<form method="post">
		<center><table width="50%">
			<tr>
				<th colspan="3">Student Data</th>
			</tr>

			<tr>
				<td>Std ID:</td>
				<td><input type="text" name="stdid" /></td>
				<td rowspan="3" colspan="2">
					<?php 
						echo "$id <br> $name <br> $city";
					?>
				</td>
			</tr> 

			<tr>
				<td>Name:</td>
				<td><input type="text" name="stdname" /></td>
			</tr>

			<tr>
				<td>City:</td>
				<td><input type="text" name="stdcity" /></td>
			</tr>
		 
			<tr id="one">
				<td colspan=2>
					<input class="padding" type="submit" name="add" value="Add" />
					<input class="padding" type="submit" name="delete" value="Delete" />
					<input class="padding" type="submit" name="update" value="Update" />
					<input class="padding" type="submit" name="show" value="Show all data" />
				</td>
				<td colspan=2><input class="padding" type="submit" name="select" value="Select" /></td>
			</tr>
		</table></center>
	</form>
	</body>
</html>

<?php

	if (isset($_POST['add'])){
		$sql = "INSERT INTO `std_data` (`id`,`name`, `city`) VALUES ('$id','$name', '$city');";
		$result = mysqli_query($conn, $sql);

		if($result){
			echo '<script>alert(Data inserted successfuly)</script>';
		}
		else{
			echo "error";
		}
	}

	if(isset($_POST['delete'])){
		$sql = "DELETE FROM `std_data` WHERE `id` = '$id' ";
		$result = mysqli_query($conn, $sql);

		if($result){
			echo '<script>alert("Data deleted successfuly")</script>';
		}
		else{
			echo "Error";
		}
	}

	if(isset($_POST['update'])){
		$sql = "UPDATE `std_data` SET `id`='$id',`name`='$name',`city`='$city' WHERE `id` = '$id' ";
		$result = mysqli_query($conn, $sql);

		if($result){
			echo "Data updated successfuly <br>";
		}
		else{
			echo "Error";
		}
	}

	if(isset($_POST['show'])){
		$sql = "SELECT `id`, `name`, `city` FROM `std_data`";
		$result = mysqli_query($conn, $sql);

		if($result){
			echo "Database table successfully generated as below  <br>";
		}
		else{
			echo "Error";
		}

		if ($result->num_rows > 0){
    		echo "<center><table><tr><th>ID</th><th>Name</th><th>City</th></tr>";
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["city"]. "</td></tr>";
    		}
    		echo "</table></center>";
		}
		else{
    		echo "0 results";
    	}
	}
?>