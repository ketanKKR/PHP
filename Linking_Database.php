<?php
	include 'connect.php';
	$id = $_GET['id'];

	if($id ?? false){
		
	}
	else{
		$id = 1;
		echo '<a href="Linking_database.php?id='.$row['id'].'"></a>';
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
		.padding2{
			padding: 4px;
			margin-left: 16%;
		}
		a{
			padding: 5px;
			border-spacing: 6px;
			margin-left: 16%;
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
						$result = mysqli_query($conn, "SELECT * FROM std_data WHERE `id`='$id'");

						$row = $result->fetch_assoc();

        				echo "<br>ID: " . $row["id"]. "<br> Name:" . $row["name"]. "<br>City:" . $row["city"];
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
		 
			<tr>
				<td colspan=2>
					<input class="padding" type="submit" name="add" value="Add" />
					<input class="padding" type="submit" name="delete" value="Delete" />
					<input class="padding" type="submit" name="update" value="Update" />
					<input class="padding" type="submit" name="show" value="Show all data" />
				</td>
				<td colspan=2>
					<!--<input class="padding2" type="submit" name="Previous" value="Previous" />-->
						<?php 
							$result = mysqli_query($conn, "SELECT * FROM std_data WHERE `id`='$id'");

							// Next button
							$next = mysqli_query($conn, "SELECT * FROM std_data WHERE id>$id order by id ASC");
							if($row = mysqli_fetch_array($next)){
							  echo '<a href="Linking_database.php?id='.$row['id'].'"><button type="button">Next</button></a>';
							}

							$previous= mysqli_query($conn, "SELECT * FROM std_data WHERE id<$id order by id DESC");
							if($row = mysqli_fetch_array($previous)){
							  echo '<a href="Linking_database.php?id='.$row['id'].'"><button type="button">Previous</button></a>';
							}
						?>
					<!--<input class="padding2" type="submit" name="next" value="Next" />-->
				</td>
			</tr>
		</table></center>
	</form>
	</body>
</html>

<?php

	if (isset($_POST['add'])){
		$id = $_POST ['stdid'];
		$name = $_POST ['stdname'];
		$city = $_POST ['stdcity'];
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
		$id = $_POST ['stdid'];
		$name = $_POST ['stdname'];
		$city = $_POST ['stdcity'];

		if (empty($id)){
			echo '<script>alert("Plese enter ID to Delete data")</script>';
		}
		else{
			$sql = "DELETE FROM `std_data` WHERE `id` = '$id' ";
			$result = mysqli_query($conn, $sql);

			if($result){
				echo '<script>alert("Data deleted successfuly")</script>';
			}
			else{
				echo "Error";
			}
		}
	}

	if(isset($_POST['update'])){
		$id = $_POST ['stdid'];
		$name = $_POST ['stdname'];
		$city = $_POST ['stdcity'];

		if (empty($id)){
			echo '<script>alert("Plese enter ID to Upadate data")</script>';
		}
		if (empty($name)){
			echo '<script>alert("Plese enter Name to Update data")</script>';
		}
		if (empty($city)){
			echo '<script>alert("Plese enter City to Update data")</script>';
		}
		else{
			$sql = "UPDATE `std_data` SET `id`='$id',`name`='$name',`city`='$city' WHERE `id` = '$id' ";
			$result = mysqli_query($conn, $sql);

			if($result){
				echo "Data updated successfuly <br>";
			}
			else{
				echo "Error";
			}
		}
	}

	if(isset($_POST['show'])){ 
		$id = $_POST ['stdid'];
		$name = $_POST ['stdname'];
		$city = $_POST ['stdcity'];
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
    		while($row = $result->fetch_assoc()){
    			echo "<br>";
        		echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["city"]. "</td></tr>";
    		}
    		echo "</table></center>";
		}
		else{
    		echo "0 results";
    	}
	}
?>