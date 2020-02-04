  <?php
  include "connection.php";
	
	$id=$_GET['id'];
	
	$disname=$_POST['disname'];
	$topic=$_POST['topic'];
	$question=$_POST['question'];
	$vara=$_POST['vara'];
	$varb=$_POST['varb'];
	$varc=$_POST['varc'];
	$vard=$_POST['vard'];
	$vare=$_POST['vare'];
	
		$sql = "UPDATE test SET disname = '$disname' , topic = '$topic', question = '$question', vara='$vara', varb='$varb', varc='$varc' , vard='$vard', vare='$vare'  WHERE id = '$id'";
			mysqli_query($conn, $sql);

	if(isset($_COOKIE['page'])) header('location:tests.php?page='.$_COOKIE['page']);
			else  header('location:tests.php');
  

  
  ?>
  