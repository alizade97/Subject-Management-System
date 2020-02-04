  <?php
  include "connection.php";
  if(isset($_GET['id'])){
	$id=$_GET['id'];
	$sql = "DELETE FROM `test` WHERE `test`.`id` = ".$id."";
	mysqli_query($conn,$sql);
	if(isset($_COOKIE['page'])) header('location:tests.php?page='.$_COOKIE['page']);
			else  header('location:tests.php');
  }
  
  
  ?>
  