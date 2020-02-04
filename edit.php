  <?php
  include "connection.php";
	
	$id=$_GET['id'];
	$page=$_GET['page'];
	$disname=$_POST['disname'];
	$dishour=$_POST['dishour'];
	
		$sql = "UPDATE discipline SET disname = '$disname' , hour = '$dishour'  WHERE id = '$id'";
			mysqli_query($conn, $sql);

	if(isset($_COOKIE['page'])) header('location:disciplines.php?page='.$_COOKIE['page']);
			else  header('location:disciplines.php');
  

  
  ?>
  