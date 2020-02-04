<?php
	session_start();
	include "connection.php";
	
	
	
	if(isset($_POST["username"]) && isset($_POST["password"])){
		
		$sql="SELECT * FROM user";
		$result = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_assoc($result)){
		
		
		if($_POST["username"]==$row["username"] && $_POST["password"]==$row["password"] ){
		
		$_SESSION["username"]=$_POST["username"];
		
		header("Location: index.php");
		}
	}
	}

	
	
	if(isset($_POST["reginput"])){

		$username = $_POST["usernamereg"];
		$name = $_POST["name"];
		$surname = $_POST["surname"];
		$pass1 = $_POST["password1"];
		$pass2= $_POST["password2"];
		$email = $_POST["email"];
		
		$_SESSION["usernamer"] = $username;
		$_SESSION["name"] = $name;
		$_SESSION["surname"] = $surname;
		$_SESSION["email"] = $email;
		
		
		
		if($pass1 == $pass2 && strlen($username)>4 && strlen($pass1)>4 && strlen($name)>1 && strlen($surname)>1 && strlen($email)>1){
			$sql = "insert into user(username, password, name, surname, email) values('$username',  '$pass1', '$name', '$surname', '$email' ) ";
			mysqli_query($conn, $sql);
		
		$_SESSION["usernamer"] = "";
		$_SESSION["name"] = "";
		$_SESSION["surname"] = "";
		$_SESSION["email"] = "";
			
			echo '<script>
			
			$(document).ready(function(){
				
				$("#login").show();
				$("#registration").hide();
				
				
				
				
			
			});
		
		</script>';
			
		}
		
		
		
	}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>System Entrance</title>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style/sign-style.css"/>
			<link rel="icon" type="image" href="img/login.png" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	


		
		<form id="login"  action="sign.php" method="POST">
			<h1 style="color:red">LOGIN</h1>
			<input type="text" name="username" placeholder="username" required />
			<input type="password" name="password" placeholder="password" required />
			<input type="submit" value="Log in" name="loginput"/>
			<button id="reg">Registration Page</button>
			
		</form>
		
		<form  id="registration"  action="sign.php" method="POST">
			<h1 style="color:red">REGISTRATION</h1>
			
			<input type="text" name="name" placeholder="name" value="<?php if(isset($_SESSION["name"])) echo $_SESSION["name"]   ?>" required />
			<?php if(isset($_POST["reginput"]) && ($_SESSION["name"]!=null)){ if(strlen($name)<5) echo '<br> Increase length of name';}  ?>	
			<input type="text" name="surname" placeholder="surname" value="<?php if(isset($_SESSION["surname"])) echo $_SESSION["surname"] ?>" required />
			<?php if(isset($_POST["reginput"]) && ($_SESSION["name"]!=null)){ if(strlen($surname)<5) echo '<br> Increase length of surname';}  ?>	
			<input type="text" name="email" placeholder="email" value="<?php if(isset($_SESSION["email"]))  echo $_SESSION["email"] ?>" required />
			<?php if(isset($_POST["reginput"]) && ($_SESSION["name"]!=null)){ if(strlen($email)<5) echo '<br> Increase length of email';}  ?>	
			<input type="text" name="usernamereg" placeholder="username" value="<?php if(isset($_SESSION["usernamer"]))  echo $_SESSION["usernamer"] ?>" required />
			<?php if(isset($_POST["reginput"]) && ($_SESSION["name"]!=null)){ if(strlen($username)<5) echo '<br> Increase length of username';}  ?>	
			<input type="password" name="password1" placeholder="password" required />
			<input type="password" name="password2" placeholder="password" required />
			<?php if(isset($_POST["reginput"])){ if($pass1!=$pass2) echo '<br> Password does not match';}  ?>	
			
			<input id="r" type="submit" value="Register" name="reginput"/>
			
			<button  id="log">Login Page</button>
			
		</form>
		
		
		<script>
			
			$(document).ready(function(){
				
				$("#login").show();
				$("#registration").hide();
				
				
				
				$("#log").click(function(){
					$("#login").show();
					$("#registration").hide();
					return false;
				});
				
				
				$("#reg").click(function(){
					$("#login").hide();
					$("#registration").show();
					return false;
				});
				
				
				
				
				
			});
		
		</script>
		
		<?php
	
	if(isset($_POST["reginput"])){
	
	if($pass1 == $pass2 && strlen($username)>5 && strlen($pass1)>5 && strlen($name)>1 && strlen($surname)>1 && strlen($email)>1){
		echo '
		<script>
			$(document).ready(function(){
				
				$("#login").show();
				$("#registration").hide();
				
			
			});
		
		</script>
		
		';
	}
	
	else{
		
		echo '
		<script>
			$(document).ready(function(){
				
				$("#login").hide();
				$("#registration").show();
				
			
			});
		
		</script>
		
		';
		
		
	}
	
	}
	
	?>
		
	</body>
</html>