  <?php
  include "connection.php";
  if(isset($_GET['id'])){
	$id=$_GET['id'];
	$sql = "DELETE FROM `topic` WHERE `topic`.`id` = ".$id."";
	mysqli_query($conn,$sql);
	if(isset($_COOKIE['page'])) header('location:topics.php?page='.$_COOKIE['page']);
			else  header('location:topics.php');
  }
  
  
  ?>
  