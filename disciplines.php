<?php 
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: sign.php");
	}

	include "connection.php";
	
	if(isset($_GET["action"])) $action = $_GET["action"];
	else $action="";

	
	$username = $_SESSION["username"];
	if(isset($_GET["disname"])) $disname = $_GET["disname"];
	if(isset($_GET["dishour"])) $dishour = $_GET["dishour"];
	
	if(isset($_GET['add']) && isset($_GET["disname"]) && isset($_GET["dishour"])){
	
	
	$sql = "insert into discipline(username, disname, hour ) values('$username',  '$disname', '$dishour' ) ";
			
			mysqli_query($conn, $sql);
			unset($_GET["disname"]);
			unset($_GET["dishour"]);
			header("Location: disciplines.php");
			exit();
	}
	
	
	
	switch($action){
		case "logout":
			
		session_unset();
		session_destroy();
		header("Location: sign.php");
		break;
		
		case "disciplines":
			header("Location: disciplines.php?page=1");
		break;
		
		case "topics":
			header("Location: topics.php?page=1");
		break;
		
		case "tests":
			header("Location: tests.php");
		break;
		
		case "testmaker":
			header("Location: testmaker.php");
		break;
		
		case "profile":
			header("Location: profile.php");
		break;
		
		case "home":
			header("Location: index.php");
		break;
		
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Subject Management System</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://kit.fontawesome.com/4f86a7f734.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="style/index-style.css"/>
		<link rel="icon" type="image" href="img/icon.png" />
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light" >
			<div class="container">
				<a class="navbar-brand" href="?action=home">Subject Management System</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="?action=disciplines">Disciplines</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"href="?action=topics">Topics</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?action=tests">Tests</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?action=testmaker">Test Maker</a>
						</li>
				  
						<li class="nav-item">
							<a class="nav-link" href="?action=profile">Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?action=logout">Log Out</a>
						</li>
					</ul>
				</div>
		    </div>
		</nav>

		
		

		<div style="min-height:800px;" class="container1">
			<div class="row">
				<div class="col-lg-3">
					<div style="margin-top:20px;" class="list-group">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"> <a href="#" style="color:white;" >Add Discipline</a></button>
					</div>
				</div>
				<div id="mn" class="col-lg-9">
					<h1 style="margin-top:10px;"> Disciplines </h1>
				<?php

					$user = $_SESSION["username"];
					$page=1;
					
					
					if(isset($_POST['disnameselect']) ){$disnameselect = $_POST['disnameselect'];  setcookie('disnameselect',$_POST['disnameselect'],time() + 86400); }
					else{ $disnameselect="All";}
					
					if(isset($_POST['data']) ){$limit = $_POST['data'];  setcookie('limit',$_POST['data'],time() + 86400);  }
					else {$limit=5;  }
					
					if(isset($_COOKIE['disnameselect']) && isset($_COOKIE['limit'])){
						
						$disnameselect = $_COOKIE['disnameselect'];
						$limit = $_COOKIE['limit'];
										
						if(isset($_GET['page'])){ $page = $_GET['page'];   setcookie('page',$_GET['page'],time() + 86400);}
						else {
							
							if(isset($_COOKIE['page'])){
								$page = $_COOKIE['page'];
							}
							
							else{
								$page = 1;
							}
						
						}
						
						$start = ($page-1)*$limit;
						if($start<0){
							$start=0;
						}
						if($disnameselect != "All"){
							$sql1="SELECT * FROM discipline WHERE username= '$user' AND disname = '$disnameselect' LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						if($disnameselect == "All"){
							$sql1="SELECT * FROM discipline WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'  ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: disciplines.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
					}

					else if (isset($_COOKIE['disnameselect']) && !isset($_COOKIE['limit'])) {
						
					
						$disnameselect = $_COOKIE['disnameselect'];
		
						if(isset($_GET['page'])){ $page = $_GET['page'];   setcookie('page',$_GET['page'],time() + 86400);}
						else {
							
							if(isset($_COOKIE['page'])){
								$page = $_COOKIE['page'];
							}
							
							else{
								$page = 1;
							}
						
						}
						
						$start = ($page-1)*$limit;
						if($start<0){
							$start=0;
						}
						if($disnameselect != "All"){
							$sql1="SELECT * FROM discipline WHERE username= '$user' AND disname = '$disnameselect' LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						if($disnameselect == "All"){
							$sql1="SELECT * FROM discipline WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'  ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: disciplines.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
								
					}
					
					else if (!isset($_COOKIE['disnameselect']) && isset($_COOKIE['limit'])) {
						
					
						$limit = $_COOKIE['limit'];
		
						if(isset($_GET['page'])){ $page = $_GET['page'];   setcookie('page',$_GET['page'],time() + 86400);}
						else {
							
							if(isset($_COOKIE['page'])){
								$page = $_COOKIE['page'];
							}
							
							else{
								$page = 1;
							}
						
						}
						
						$start = ($page-1)*$limit;
						if($start<0){
							$start=0;
						}
						if($disnameselect != "All"){
							$sql1="SELECT * FROM discipline WHERE username= '$user' AND disname = '$disnameselect' LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						if($disnameselect == "All"){
							$sql1="SELECT * FROM discipline WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'  ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: disciplines.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
								
					}
					
					else if (!isset($_COOKIE['disnameselect']) && !isset($_COOKIE['limit'])) {
						
					
						if(isset($_GET['page'])){ $page = $_GET['page'];   setcookie('page',$_GET['page'],time() + 86400);}
						else {
							
							if(isset($_COOKIE['page'])){
								$page = $_COOKIE['page'];
							}
							
							else{
								$page = 1;
							}
						
						}
						
						$start = ($page-1)*$limit;
						if($start<0){
							$start=0;
						}
						if($disnameselect != "All"){
							$sql1="SELECT * FROM discipline WHERE username= '$user' AND disname = '$disnameselect' LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						if($disnameselect == "All"){
							$sql1="SELECT * FROM discipline WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'  ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: disciplines.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
								
					}
	
					?>			
 
 
					<form>
						<div class="form-row">
							<div class="col"> 
							<select id="limit"  class="form-control" >
								<option <?php if($limit==5) echo ' selected' ?>>5</option>
							    <option <?php if($limit==10) echo ' selected' ?>>10</option>
							    <option <?php if($limit==25) echo ' selected' ?>>25</option>
							    <option <?php if($limit==50) echo ' selected' ?>>50</option>
							    <option <?php if($limit==100) echo ' selected' ?>>100</option>
							</select>
							</div>
							<div  class="col">
								<select id="disnameselect"  class="form-control" >
									<option value="All">All disciplines</option>
									
									<?php   
										$sql5="SELECT * FROM discipline WHERE username= '$user'  ";
										$result5 = mysqli_query($conn, $sql5);
										while($row5=mysqli_fetch_assoc($result5)){
									?>
									<option value="<?php echo $row5['disname']?>"  <?php if($disnameselect == $row5['disname']){echo " selected";} ?>><?php echo $row5['disname']?></option>
										<?php } ?>
		
								</select>
							</div>
	
							<div class="col">
								<input id="search" type="text" class="form-control" placeholder="Search">
							</div>
						</div>
					</form>
 
 
					<table style="margin-top:30px; margin-bottom:50px;" class="table table-striped table-hover table-responsive-sm">
						<thead class="thead-dark">
							<tr>
								<th>Discipline name</th>
								<th>Hours</th>
								<th>Edit</th>
								<th>Delete</th>
   
							</tr>
						</thead>
						<tbody id="mytable">
						<?php
							while($row=mysqli_fetch_assoc($result1)){
						?>
							<tr>
								<td><a href="#add<?php echo $row["id"] ?>" data-toggle="modal" style="text-decoration: none; color:black; " ><?php echo $row["disname"] ?></a></td>
		
									<div class="modal fade" id="add<?php echo $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													  <span aria-hidden="true">&times;</span>
													</button>
												</div>
      
												<form id="login"  action="topics.php" method="GET">
													<div class="modal-body">
													
														<h6> Select Discipline: </h6>
														<select name="disname">
														<?php  
															$user = $_SESSION['username'];
															$sql="SELECT * FROM discipline WHERE username='$user'";
															$result2 = mysqli_query($conn, $sql);
															while($row1=mysqli_fetch_array($result2)){
														?>
															<option value="<?php echo $row1['disname']?>"<?php if($row1['disname'] == $row['disname']) echo " selected";?> ><?php echo $row1['disname']?></option>
																<?php } ?>
														</select>
														<h6> Topic: </h6>
														<input type="text" name="topic"  />
													</div>
      
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
														<input id="addtpc" value="Add" type="submit" name="add" class="btn btn-primary"/>
													</div>
												</form>
											</div>
										</div>
									</div>
								<td><?php echo $row["hour"] ?></td>
								<td>
									<a  style="color:white;" href="#edit<?php echo $row["id"] ?>" class="btn btn-primary ed" data-toggle="modal" > Edit</a>
										<?php include('editmod.php'); ?>
		
								</td>
								<td>
									<a href="#del<?php echo $row["id"] ?>" data-toggle="modal" class="btn btn-danger"> Delete</a>
										<?php include('delmod.php'); ?>
										<?php } ?>
								</td>
							</tr>
						</tbody>
					</table>
	  
					<nav  aria-label="Page navigation">
						<ul class="pagination">
							<li class="page-item"><a class="page-link" href="disciplines.php?page=<?php echo $prev; ?>">Previous</a></li>
								<?php for($i=1; $i<=$p; $i++) { ?>
							<li class="page-item <?php if($page == $i) echo ' active'; ?>"><a class="page-link" href="disciplines.php?page=<?php echo $i; ?>"><?php echo $i; ?> </a></li>
								<?php } ?>
							<li class="page-item"><a class="page-link" href="disciplines.php?page=<?php echo $next; ?>">Next</a></li>
						</ul>
					</nav>
		<script>
			$(document).ready(function() {
				$("#search").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#mytable tr").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
					
				$('#limit').on('change', function() {
					var da= this.value;
					$.ajax({
						url: "disciplines.php",
						type: 'POST',
						data:{data: da},
						success: function(response) {
						location.reload();
						}
					});

					return false;
				});
						
						
				$('#disnameselect').on('change', function() {	
					var da= this.value;
					$.ajax({
						url: "disciplines.php",
						type: 'POST',
						data:{disnameselect: da},
						success: function(response) {
							location.reload();
			 
						}
					});
					return false;
				});	
			});
		</script>
				</div>
			</div>
		</div>
		<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Discipline</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="login"  action="disciplines.php" method="GET">
						<div class="modal-body">
								<h6> Discipline Name: </h6>
								<input type="text" name="disname"  />
								<h6> Hours: </h6>
								<input type="text" name="dishour"  />
							</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
							<input value="Add" type="submit" name="add" class="btn btn-primary"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	    <footer class="py-5 bg-dark">
			<div class="container">
			  <p class="m-0 text-center text-white">Copyright &copy; SMS <?php echo date("Y"); ?></p>
			</div>
	    </footer>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</body>
</html>