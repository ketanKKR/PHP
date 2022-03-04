<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
	</head>

	<style type="text/css">
		body {
 			background-image: url('https://wp-mktg.prod.getty1.net/istockcontentredesign/wp-content/uploads/sites/5/2021/03/2021_iStock_LatestBGTrends_Hero.jpg.jpeg');
 			background-repeat: no-repeat;
 			background-size: 100%;
		}
		input{
			border-radius: 25px;
			border: hidden;
			margin-left: auto;
			margin-right: auto;
			display: block;

		}
		label{
			display: block;
    		text-align: center;
    		font-style: bold;
		}
		.font{
			font-size: 20px;
			padding: 7px;
		}
		div{
			width: 30%;
			align-self: center;
			margin: auto;
			border: solid black;
			padding: 5px;
			box-shadow: 10px 10px 8px  #000000;
		}
	</style>

	<body>
	<form method="post">
		<div>
			<h1 align="center">Login</h1>
			<label>User Name</label>
			<input type="text" name="username"><br>
			<label>Password</label>
			<input type="password" name="password"><br>
			<input type="submit" name="login" value="Login" class="font">
		</div>
	</form>
	</body>
</html>

<?php 
	if (isset($_POST['login'])){

		if (isset($_SERVER['HTTP_COOKIE'])) {
    		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);

    		foreach($cookies as $cookie){
	        	$parts = explode('=', $cookie);
	        	$name = trim($parts[0]);
	        	setcookie($name, '', time()-1000);
	        	setcookie($name, '', time()-1000, '/');
	        }
    	}


		$user = $_POST['username'];
		$password = $_POST['password'];
		setcookie("USER_NAME", $user, time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie("PASSWORD", $password, time() + (86400 * 30), "/"); // 86400 = 1 day

		$serverName = "localHost";
		$userName = $user;
		$password2 = $password;
		$database = "std_data";
		$flag = 0;

		$conn = mysqli_connect($serverName, $userName, $password2, $database);
		if (!$conn){
			echo "Connection failed lol <br> ". mysqli_connect_error();
		}
		else{
			header("Location: Linking_Database.php");
			exit();	
		}
	}
?>