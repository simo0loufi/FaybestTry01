<?php session_start(); ?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="CSS/login.css">
</head>

<body style="height:100vh;">
<?php
include("connection.php");

if(isset($_POST['submit'])) {
	$user = 'admin';
	$pass = mysqli_real_escape_string($mysqli, $_POST['password']);

	if($user == "" || $pass == "") {
		echo "Either username or password field is empty.";
		echo "<br/>";
		echo "<a href='adminlog.php'>Go back</a>";
	} else {
        $result = mysqli_query($mysqli, "SELECT * FROM cust WHERE username= '$user' AND password=md5('$pass')");
		
		$row = mysqli_fetch_assoc($result);
		
		if(is_array($row) && !empty($row)) {
			$validuser = $row['username'];
			$_SESSION['valid'] = $validuser;
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
		} else {
			echo "Invalid password.";
			echo "<br/>";
			echo "<a href='adminlog.php'>Go back</a>";
		}

		if(isset($_SESSION['valid'])) {
			header('Location: adminpage.php');			
		}
	}
} else {
?>
<div class="form-log" style="width: 40%;">
	<p class="login">Hi Admin</p>
	<form name="form1" method="post" action="">
		<table width="75%" border="0">
			
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr> 
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Submit" class="submit"></td>
			</tr>
			<tr>
				<td><a href="index.php" class="back">Back</a> <br /></td>
			</tr>
		</table>
	</form>
</div>
<?php
}
?>
</body>
</html>
