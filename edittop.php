  <?php
  include "connection.php";
	
	$id=$_GET['id'];
	
	$disname=$_POST['disname'];
	$topic=$_POST['topic'];
	
		$sql = "UPDATE topic SET disname = '$disname' , topic = '$topic'  WHERE id = '$id'";
			mysqli_query($conn, $sql);

			if(isset($_COOKIE['page'])) header('location:topics.php?page='.$_COOKIE['page']);
			else  header('location:topics.php');
	
  

  
  ?>
  