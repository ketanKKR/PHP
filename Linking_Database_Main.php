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