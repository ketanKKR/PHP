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
		button{
			padding: 5px;
			margin-left: 5%;
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
			padding: 7px;
		}
		div{
			background-image: linear-gradient(to top, #ee74f2, blue);
			height: 97vh;
		}
		body{
			background-color: #ee74f2;
		}
	</style>

	<body>
		<div>
		<form method="post">
			<center><table width="60%">
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
						<?php 
							$result = mysqli_query($conn, "SELECT * FROM std_data WHERE `id`='$id'");
							// Next button
							$next = mysqli_query($conn, "SELECT * FROM std_data WHERE id>$id order by id ASC");
							if($row = mysqli_fetch_array($next)){
								echo '<a href="Linking_database.php?id='.$row['id'].'"><button type="button">Next</button></a';
							}

							// Previous button
							$previous= mysqli_query($conn, "SELECT * FROM std_data WHERE id<$id order by id DESC");
							if($row = mysqli_fetch_array($previous)){
								echo '<a href="Linking_database.php?id='.$row['id'].'"><button type="button">Previous</button></a>';
							}

							// First button
							$first = mysqli_query($conn, "SELECT * FROM std_data ORDER BY id ASC");
							if($row = mysqli_fetch_array($first)){
								echo '<a href="Linking_database.php?id='.$row['id'].'"><button type="button">First</button></a>';
							}

							// Last button
							$last = mysqli_query($conn, "SELECT * FROM std_data ORDER BY id DESC LIMIT 1");
							if($row = mysqli_fetch_array($last)){
								echo '<a href="Linking_database.php?id='.$row['id'].'"><button type="button">Last</button></a';
							}
						?>
					</td>
				</tr>
			</table></center>
		</form>
		<?php include 'Linking_database_Main.php'; ?>
		</div>
	</body>
</html>