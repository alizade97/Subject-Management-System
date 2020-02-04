<?php  
session_start();
	if(!isset($_SESSION["username"])){
		header("Location: sign.php");
	}
	
	$user = $_SESSION["username"];

	include "connection.php";
		 $arr= array();
	if(isset($_GET['data']) ){$data = $_GET['data']; 

	
			    
			  $user = $_SESSION['username'];
			 
			  $sql="SELECT * FROM topic WHERE username='$user' AND disname='$data'";
			  $result = mysqli_query($conn, $sql);

		      while($row=mysqli_fetch_array($result)){
					 
					 $topic = $row['topic'];
				
					 
					$arr[] =  array("topic" => $topic);
			  
			  }
			  
			  
			  echo json_encode($arr);
	}

?>