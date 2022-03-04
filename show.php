<?php
	require_once("connect.php"); 
	$id = $_GET['id']; 
?>

<style type="text/css">
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
<!DOCTYPE html>
<html>
	<head>
		<title>Previous and Next page buttons in PHP website with MYSQL database</title>
	</head>
	<body>
		<?php 
			$result = mysqli_query($conn, "SELECT * FROM std_data WHERE `id`='$id'");

			if($row = mysqli_fetch_array($result))
			{
				$title = $row['id'];
			}
		?>

		<h1> <?php echo $title;?></h1>
				
		<div>
			<?php
				// Next button 
				$next = mysqli_query($conn, "SELECT * FROM std_data WHERE id>$id order by id ASC");
				if($row = mysqli_fetch_array($next)){
				  echo '<a href="show.php?id='.$row['id'].'"><button type="button">Next</button></a>';  
				} 

				// Previous button 
				$previous= mysqli_query($conn, "SELECT * FROM std_data WHERE id<$id order by id DESC");

				if($row = mysqli_fetch_array($previous)){
				  echo '<a href="show.php?id='.$row['id'].'"><button type="button">Previous</button></a>';  
				} 
			?>
		</div>
	</body>
</html>

<?php
	$sql = "SELECT * FROM std_data WHERE `id`='$id'";
	$result = mysqli_query($conn, $sql);
	echo "<center><table><tr><th>ID</th><th>Name</th><th>City</th></tr>";
	$row = $result->fetch_assoc();
  echo "<br>";
  echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["city"]. "</td></tr></table></center>";
?>