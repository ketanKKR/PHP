<?php
	$id_found = 0;
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
			margin-left: 5%;
		}
		button{
			padding: 5px;
			margin-left: 5%;
		}
		table{
			background-color: white;
			margin-left: auto;
			margin-right: auto;
		}
		th{
			font-size: 30px;
			background-color: #4285F4;
			color: white;
			text-shadow: 0 0 3px #000000, 0 0 5px #000000;
		}
		table,th,td{
			border: solid black;
			border-collapse: collapse;
			padding: 7px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
		}
		body{
            background-color: #E2FFFF;
        }
        input[type=submit],button{
		  background: #5E5DF0;
		  border-radius: 900px;
		  box-sizing: border-box;
		  color: #FFFFFF;
		  cursor: pointer;
		  font-size: 16px;
		  font-weight: 700;
		  line-height: 24px;
		  opacity: 1;
		  outline: 0 solid transparent;
		  padding: 8px 18px;
		  user-select: none;
		  -webkit-user-select: none;
		  touch-action: manipulation;
		  width: fit-content;
		  word-break: break-word;
		  border: 0;
		}
		h3{
			text-align: center;
		}
	</style>

	<body>

<?php
	$serverName = "localHost";
	$userName = "root";
	$password = "";
	$database = "std_data";

	$conn = mysqli_connect($serverName, $userName, $password);
	if (!$conn) {
		die("Connection failed ". mysqli_connect_error());
	}

	$sql = "CREATE DATABASE IF NOT EXISTS std_data";
	$result = mysqli_query($conn, $sql);
	if($result){
		
	}
	else{
		echo "Error creating database: " . mysqli_error($conn);
	}

	$conn->close();

	$conn = mysqli_connect($serverName, $userName, $password,$database);
	if (!$conn) {
		die("Connection failed ". mysqli_connect_error());
	}

	$sql = "CREATE TABLE IF NOT EXISTS std_data (
	id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	city VARCHAR(30) NOT NULL)";
	$result = mysqli_query($conn, $sql);

	if($result){
		
	}
	else{
		echo "Error creating Table: " . mysqli_error($conn);
	}
	$sql = "SELECT `id` FROM `std_data`";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0){

	}
	else{

	$sql = array();

	$sql[0] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '1', 'Ketan', 'Mahuva') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '1')";
	$sql[1] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '2', 'Vijay', 'Surat') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '2')";
	$sql[2] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '3', 'Bhavesh', 'Bhavnagar') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '3')";
	$sql[3] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '4', 'Nilesh', 'Ahemdabad') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '4')";
	$sql[4] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '5', 'Ramesh', 'Mumbai') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '5')";
	$sql[5] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '6', 'Parth', 'Rajkot') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '6')";
	$sql[6] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '7', 'Harsh', 'Amreli') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '7')";
	$sql[7] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '8', 'Parag', 'Talaja') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '8')";
	$sql[8] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '9', 'Viraj', 'Junagath') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '9')";
	$sql[9] = "INSERT INTO std_data (id, name, city) SELECT * FROM (SELECT '10', 'Hiren', 'Mahuva') AS tmp WHERE NOT EXISTS (SELECT id FROM std_data WHERE id = '10')";

	for ($i=0; $i<10; $i++){ 
			$result = mysqli_query($conn, $sql[$i]);
		}

		if($result){
			echo "<br>Records inserted successfully!";
		}
		else{
			echo "Error inserting Records: " . mysqli_error($conn);
		}
	}
	
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}

	if($id ?? false){
		
	}
	else{
		$id = 1;
		if(isset($row)){
			echo '<a href="Linking_database.php?id='.$row['id'].'"></a>';
		}
	}
?>
		<form method="post">
			<br><table width="60%">
				<tr>
					<th colspan="3">Student Data</th>
				</tr>

				<tr>
					<td>Std ID:</td>
					<td><input type="text" name="stdid" /></td>
					<td rowspan="3" colspan="2" style="font-size: 20px;">
						<?php
							$result = mysqli_query($conn, "SELECT * FROM std_data WHERE `id`='$id'");
							$row = $result->fetch_assoc();
							if($row!=''){
								echo "<br>ID: " . $row["id"]. "<br> Name:" . $row["name"]. "<br>City:" . $row["city"];
							}
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
						<input class="padding" type="submit" name="show" value="Show All Data" />
					</td>
					<td colspan=2>
						<?php 
							$result = mysqli_query($conn, "SELECT * FROM std_data WHERE `id`='$id'");
							// Previous button
							$previous= mysqli_query($conn, "SELECT * FROM std_data WHERE id<$id order by id DESC");
							if($row = mysqli_fetch_array($previous)){
								echo '<a href="Linking_Database.php?id='.$row['id'].'"><button type="button"><<</button></a>';
							}
							else{
								echo '<button type="button"><<</button></a>';
							}

							// Next button
							$next = mysqli_query($conn, "SELECT * FROM std_data WHERE id>$id order by id ASC");
							if($row = mysqli_fetch_array($next)){
								echo '<a href="Linking_Database.php?id='.$row['id'].'"><button type="button">>></button></a>';
							}
							else{
								echo '<button type="button">>></button></a>';
							}

							// First button
							$first = mysqli_query($conn, "SELECT * FROM std_data ORDER BY id ASC");
							if($row = mysqli_fetch_array($first)){
								echo '<a href="Linking_Database.php?id='.$row['id'].'"><button type="button">First</button></a>';
							}
							else{
								echo '<button type="button">First</button></a>';
							}

							// Last button
							$last = mysqli_query($conn, "SELECT * FROM std_data ORDER BY id DESC LIMIT 1");
							if($row = mysqli_fetch_array($last)){
								echo '<a href="Linking_Database.php?id='.$row['id'].'"><button type="button">Last</button></a';
							}
							else{
								echo '<button type="button">Last</button></a>';
							}
						?>
					</td>
				</tr>
			</table>
		</form>

		<?php
			//Add Code
			if (isset($_POST['add'])){
				$name = $_POST ['stdname'];
				$city = $_POST ['stdcity'];
				if (empty($name)){
					echo '<script>alert("Plese Enter Name to Add Data")</script>';
				}
				if (empty($city)){
					echo '<script>alert("Plese Enter City to Add Data")</script>';
				}
				else{
					$sql = "INSERT INTO `std_data` (`name`, `city`) VALUES ('$name', '$city')";
					$result = mysqli_query($conn, $sql);

					if($result){
						echo '<h3>Data Added successfully</h3>';
					}
					else{
						echo "error";
					}
				}
			}

			//Delete Code
			if(isset($_POST['delete'])){
				$id = $_POST ['stdid'];
				$name = $_POST ['stdname'];
				$city = $_POST ['stdcity'];

				if (empty($id)){
					echo '<script>alert("Plese Enter ID to Delete Data")</script>';
				}
				else{
					$sql = "SELECT id FROM std_data WHERE id=$id;";
					$result = mysqli_query($conn, $sql);
					if($result->num_rows > 0){
						$sql = "DELETE FROM `std_data` WHERE `id` = '$id' ";
						$result = mysqli_query($conn, $sql);

						if($result){
							echo '<h3>Data Deleted successfully</h3>';
						}
						else{
							echo "Error";
						}
					}
					else{
						echo "<script>alert('ID Number $id Doesn\'t Exist in Database')</script>";
					}
				}
			}

			//Update Code
			if(isset($_POST['update'])){
				$id = $_POST ['stdid'];
				$name = $_POST ['stdname'];
				$city = $_POST ['stdcity'];

				if (empty($id)){
					echo '<script>alert("Plese Enter ID to Upadate Data")</script>';
				}
				else{
					$sql = "SELECT id FROM std_data WHERE id=$id;";
					$result = mysqli_query($conn, $sql);
					if($result->num_rows > 0){
						$id_found = 1;
					}
					else{
						$id_found = 0;
						echo "<script>alert('ID Number $id Doesn\'t Exist in Database')</script>";
					}
				}

				if($id_found==1){
					if (empty($name)){
						echo '<script>alert("Plese Enter Name to Update Data")</script>';
					}
					if (empty($city)){
						echo '<script>alert("Plese Enter City to Update Data")</script>';
					}
					else{
						$sql = "UPDATE `std_data` SET `id`='$id',`name`='$name',`city`='$city' WHERE `id` = '$id' ";
						$result = mysqli_query($conn, $sql);

						if($result){
							echo '<h3>Data Updated successfully</h3>';
						}
						else{
							echo "Error";
						}
					}
				}
			}

			//Display All Database Code
			if(isset($_POST['show'])){ 
				$id = $_POST ['stdid'];
				$name = $_POST ['stdname'];
				$city = $_POST ['stdcity'];
				$sql = "SELECT `id`, `name`, `city` FROM `std_data`";
				$result = mysqli_query($conn, $sql);

				if($result){
					echo '<h3>Database table successfully generated as below</h3>';
				}
				else{
					echo "Error";
				}

				if ($result->num_rows > 0){
		    		echo "<div><table><tr><th>ID</th><th>Name</th><th>City</th></tr>";
		    		// output data of each row
		    		while($row = $result->fetch_assoc()){
		        		echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["city"]. "</td></tr>";
		    		}
		    		echo "</table></div>";
				}
				else{
		    		echo "0 results";
		    	}
			}
		?>
	</body>
</html>
