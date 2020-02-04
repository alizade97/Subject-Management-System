  <?php
  include "connection.php";
  if(isset($_GET['id'])){
	$id=$_GET['id'];
	$sql = "DELETE FROM `discipline` WHERE `discipline`.`id` = ".$id."";
	mysqli_query($conn,$sql);
	if(isset($_COOKIE['page'])) header('location:disciplines.php?page='.$_COOKIE['page']);
			else  header('location:disciplines.php');
  }
  
  
  ?>
  