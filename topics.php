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
	if(isset($_GET["topic"])) $topic = $_GET["topic"];
	
	if(isset($_GET['add']) && isset($_GET["disname"]) && isset($_GET["topic"])){
	
	
	$sql = "insert into topic(username, disname, topic ) values('$username',  '$disname', '$topic' ) ";
			
			mysqli_query($conn, $sql);
			unset($_GET["disname"]);
			unset($_GET["topic"]);
			header("Location: topics.php");
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
		<link rel="stylesheet" href="style/index-style.css"/>
		<link rel="icon" type="image" href="img/icon.png" />
	</head>
	
	
	<body>
	
	
		 <nav  class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
		<a class="navbar-brand" href="?action=home">Subject Management System</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
			 
			<li class="nav-item ">
				<a class="nav-link" href="?action=disciplines">Disciplines</a>
			  </li>
			
			<li class="nav-item active">
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
         
			<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"> <a href="#" style="color:white;" >Add Topic</a></button>
		</div>

      </div>
   

      <div class="col-lg-9">
		<h1 style="margin-top:10px;"> Topics </h1>
			
			
					<?php

					$user = $_SESSION["username"];
					$page=1;
					
					if(isset($_POST['disnameselect']) ){$disnameselect = $_POST['disnameselect'];  setcookie('disnameselect',$_POST['disnameselect'],time() + 86400); }
					else{ $disnameselect="All";}
					
					if(isset($_POST['topicselect']) ){$topicselect = $_POST['topicselect'];  setcookie('topicselect',$_POST['topicselect'],time() + 86400); }
					else{ $topicselect="All";}
					
					if(isset($_POST['data']) ){$limit = $_POST['data'];  setcookie('limit',$_POST['data'],time() + 86400);  }
					else {$limit=5;  }
					
					if(isset($_COOKIE['disnameselect']) && isset($_COOKIE['limit']) && isset($_COOKIE['topicselect']) ){
						
						$disnameselect = $_COOKIE['disnameselect'];
						$topicselect = $_COOKIE['topicselect'];
						$limit = $_COOKIE['limit'];
										/*echo $topicselect." ";
										echo $disnameselect." ";
										echo $page." ";
										echo $limit." ";*/
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
						
						if($disnameselect != "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' AND topic = '$topicselect'  ";
						}
						
						if($disnameselect== "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user' AND topic = '$topicselect'  ";
						}
						if($disnameselect != "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect'   LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						
						if($disnameselect == "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'   ";
						}
						
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						
					
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: topics.php?page=".$p);
							
						}
					
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
					}

					else if (isset($_COOKIE['disnameselect']) && !isset($_COOKIE['limit'])  && isset($_COOKIE['topicselect'])  ) {
						
					
						$disnameselect = $_COOKIE['disnameselect'];
						$topicselect = $_COOKIE['topicselect'];
						
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
						if($disnameselect != "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' AND topic = '$topicselect'  ";
						}
						
						if($disnameselect== "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user' AND topic = '$topicselect'  ";
						}
						if($disnameselect != "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect'   LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						
						if($disnameselect == "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'   ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: topics.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
								
					}
					
					else if (!isset($_COOKIE['disnameselect']) && isset($_COOKIE['limit'])  && isset($_COOKIE['topicselect']) ) {
						
					
						$limit = $_COOKIE['limit'];
						$topicselect = $_COOKIE['topicselect'];
						
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
						if($disnameselect != "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' AND topic = '$topicselect'  ";
						}
						
						if($disnameselect== "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user' AND topic = '$topicselect'  ";
						}
						if($disnameselect != "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect'   LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						
						if($disnameselect == "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'   ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: topics.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
								
					}
					
					else if (!isset($_COOKIE['disnameselect']) && !isset($_COOKIE['limit'])  && isset($_COOKIE['topicselect']) ) {
						
						$topicselect = $_COOKIE['topicselect'];
						
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
						if($disnameselect != "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' AND topic = '$topicselect'  ";
						}
						
						if($disnameselect== "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user' AND topic = '$topicselect'  ";
						}
						if($disnameselect != "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect'   LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						
						if($disnameselect == "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'   ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: topics.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
								
					}
	
	
					else if(isset($_COOKIE['disnameselect']) && isset($_COOKIE['limit']) && !isset($_COOKIE['topicselect']) ){
						
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
						
						if($disnameselect != "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' AND topic = '$topicselect'  ";
						}
						
						if($disnameselect== "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user' AND topic = '$topicselect'  ";
						}
						if($disnameselect != "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect'   LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						
						if($disnameselect == "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'   ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: topics.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
					}

					else if (isset($_COOKIE['disnameselect']) && !isset($_COOKIE['limit'])  && !isset($_COOKIE['topicselect'])  ) {
						
					
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
						if($disnameselect != "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' AND topic = '$topicselect'  ";
						}
						
						if($disnameselect== "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user' AND topic = '$topicselect'  ";
						}
						if($disnameselect != "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect'   LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						
						if($disnameselect == "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'   ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: topics.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
								
					}
					
					else if (!isset($_COOKIE['disnameselect']) && isset($_COOKIE['limit'])  && !isset($_COOKIE['topicselect']) ) {
						
					
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
						if($disnameselect != "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' AND topic = '$topicselect'  ";
						}
						
						if($disnameselect== "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user' AND topic = '$topicselect'  ";
						}
						if($disnameselect != "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect'   LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						
						if($disnameselect == "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'   ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: topics.php?page=".$p);
							
						}
						
						if($page>1) $prev = $page-1;
						
						if($page<$p) $next = $page+1;
								
					}
					
					else if (!isset($_COOKIE['disnameselect']) && !isset($_COOKIE['limit'])  && !isset($_COOKIE['topicselect']) ) {
						
						
						
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
						if($disnameselect != "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' AND topic = '$topicselect'  ";
						}
						
						if($disnameselect== "All" && $topicselect != "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND topic = '$topicselect'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user' AND topic = '$topicselect'  ";
						}
						if($disnameselect != "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user' AND disname = '$disnameselect'   LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'  AND disname = '$disnameselect' ";
						}
						
						if($disnameselect == "All" && $topicselect == "All"){
							$sql1="SELECT * FROM topic WHERE username= '$user'  LIMIT $start, $limit  ";
							$sql2="SELECT count(*) AS id FROM topic WHERE username= '$user'   ";
						}
						$result1 = mysqli_query($conn, $sql1);
						$result2 = mysqli_query($conn, $sql2);
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
						$p = ceil($total/$limit);
						
						if($page>$p){
							
							header("Location: topics.php?page=".$p);
							
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
									
										$sql5="SELECT * FROM topic WHERE username= '$user'  ";
										$result5 = mysqli_query($conn, $sql5);
										while($row5=mysqli_fetch_assoc($result5)){
									?>
									<option value="<?php echo $row5['disname']?>"  <?php if($disnameselect == $row5['disname']){echo " selected";} ?>><?php echo $row5['disname']?></option>
									
									<?php } ?>
		
								</select>
								
							</div>
							<div  class="col">
								<select id="topicselect"  class="form-control" >
									<option value="All">All topics</option>
									
									<?php   
										if($disnameselect=="All"){
											$sql5="SELECT * FROM topic WHERE username= '$user'  ";
											$result5 = mysqli_query($conn, $sql5);
										}
										else {
											$sql5="SELECT * FROM topic WHERE username= '$user' AND disname='$disnameselect' ";
											$result5 = mysqli_query($conn, $sql5);
										}
										while($row5=mysqli_fetch_assoc($result5)){
									?>
									<option value="<?php echo $row5['topic']?>"  <?php if($topicselect == $row5['topic']){echo " selected";} ?>><?php echo $row5['topic']?></option>
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
        <th>Topic</th>
        <th>Edit</th>
        <th>Delete</th>
   
      </tr>
    </thead>
    <tbody  id="mytable">
		<?php
		
		while($row=mysqli_fetch_assoc($result1)){
		?>
		
      <tr>
		
        <td><a href="#add<?php echo $row["id"] ?>" data-toggle="modal" style="text-decoration: none; color:black; " ><?php echo $row["disname"] ?></a></td>
        <td><a href="#add<?php echo $row["id"] ?>" data-toggle="modal" style="text-decoration: none; color:black; " ><?php echo $row["topic"] ?></a></td>
		
		
		
			  
<div class="modal fade" id="add<?php echo $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
	  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Test</h5>
        
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	  <div class="modal-body">
	
	
	
	<form id="login"  action="tests.php" method="GET">
			<h6> Select Discipline: </h6>
			
			
			<select   id="disname1" name="disname">
			
				<option  value=""></option>
			
			    <?php  
			  $user = $_SESSION['username'];
			  $sql="SELECT * FROM topic WHERE username='$user'";
			  $result = mysqli_query($conn, $sql);

		      while($row8=mysqli_fetch_array($result)){
			  
			  
			  ?>
			  
			  <option  value="<?php echo $row8['disname']?>"  <?php if($row8['disname'] == $row['disname']) echo " selected"; ?>><?php echo $row8['disname']?></option>
			  
			  
				 <?php }?>
   
		
			</select>
			
		
			
			
		<h6> Select Topic: </h6>
			
			<select   id="disname2" name="topic">
			<?php  
			  $user = $_SESSION['username'];
			  $sql="SELECT * FROM topic WHERE username='$user'";
			  $result = mysqli_query($conn, $sql);

		      while($row8=mysqli_fetch_array($result)){
			  
			  
			  ?>
			  
			  <option  value="<?php echo $row8['topic']?>"  <?php if($row8['topic'] == $row['topic']) echo " selected"; ?>><?php echo $row8['topic']?></option>
			  
			  
				 <?php }?>
			</select>
			
		<h6> Question: </h6>	
		<input name="question" style="width:400px;" />	
		<h6> A) </h6>	
		<input name="vara" style="width:400px;" />	
		<h6> B) </h6>	
		<input name="varb" style="width:400px;" />	
		<h6> C) </h6>	
		<input name="varc" style="width:400px;" />	
		<h6> D) </h6>	
		<input name="vard" style="width:400px;" />	
		<h6> E) </h6>	
		<input name="vare" style="width:400px;" />	
				<script>
				
				$(document ).ready(function() {
				$('#disname1').on('change', function() {
					
				var da= this.value;
				//alert(da);
				$.ajax({
				url: "testet.php",
				type: 'GET',
				   dataType: 'JSON',
				data:{data: da},
				success: function(response) {
				   
				   
				   
				    $('#disname2').empty();
					
					for(var i=0; i<Object.keys(response).length; i++){
					
					
					$('#disname2').append('<option value='+Object.values(response[i])+'>'+Object.values(response[i])+'</option>'); 
					
					}
         
				}
    });
				
				
				
				
				  return false;
				
					});
			});

			
			
			</script>
			
			
      </div>
      
	  <div class="modal-footer">
       

		<button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
		
	   <input value="Add" type="submit" name="add" class="btn btn-primary"/>
            	</form>	
			 	
			 
			 
			 <script>
	
			</script>	
		
			 </div>
	  
    </div>
  </div>
</div>
		
		
		
		
		
		
		
		
		
		<td>
		
		<a  style="color:white;" href="#edittop<?php echo $row["id"] ?>" class="btn btn-primary ed" data-toggle="modal" > Edit</a>
		<?php include('editmodtop.php'); ?>
		
		</td>
		
		<td>
		<a href="#deltop<?php echo $row["id"] ?>" data-toggle="modal" class="btn btn-danger"> Delete</a>
							<?php  include('delmodtop.php'); ?>
		
		<?php } ?>
		
		
		
		</td>
      </tr>
   
     
    </tbody>
  </table>

  
  <nav class="eo-pagination" style="margin-bottom:10px;" aria-label="Page navigation">
					  <ul class="pagination ">
						<li class="page-item"><a class="page-link" href="topics.php?page=<?php echo $prev; ?>">Previous</a></li>
						
						<?php for($i=1; $i<=$p; $i++) { ?>
						<li class="page-item <?php if($page == $i) echo ' active'; ?>"><a class="page-link" href="topics.php?page=<?php echo $i; ?>"><?php echo $i; ?> </a></li>
							 <?php } ?>
						
						<li class="page-item"><a class="page-link" href="topics.php?page=<?php echo $next; ?>">Next</a></li>
					  </ul>
					</nav>
		
      </div>
   

    </div>
	
	
  </div>

  
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
	  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
        
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	  <div class="modal-body">
    <form id="login"  action="topics.php" method="GET">
			<h6> Select Discipline: </h6>
			<select name="disname">
			  <?php  
			  $user = $_SESSION['username'];
			  $sql="SELECT * FROM discipline WHERE username='$user'";
		$result = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_array($result)){
			  
			  
			  ?>
			  <option value="<?php echo $row['disname']?>"><?php echo $row['disname']?></option>
			  
			  
		<?php }?>
			</select>
			<h6> Topic: </h6>
			<input type="text" name="topic"  />
			
			
      </div>
      
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
        <input  value="Add" type="submit" name="add" class="btn btn-primary"/>
        
      </div>
	  </form>
    </div>
  </div>
</div>
  
  
 
 
 

 
 
 
 



  
  <footer style="" class="py-5 bg-dark text-white-50">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; SMS <?php echo date("Y"); ?></p>
    </div>
  </footer>

		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script> 
		
			$(document).ready(function(){
				$("#search").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#mytable tr").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
				
				
				$('#limit').on('change', function() {
					var da3= this.value;
					$.ajax({
						url: "topics.php",
						type: 'POST',
						data:{data: da3},
						success: function(response) {
						location.reload();
						}
					});

					return false;
				});
						
						
				$('#disnameselect').on('change', function() {	
					var da1 = this.value;
					$.ajax({
						url: "topics.php",
						type: 'POST',
						data:{disnameselect: da1},
						success: function(response) {
							location.reload();
			 
						}
					});
					return false;
				});	
				
				$('#topicselect').on('change', function() {	
					var da2= this.value;
					$.ajax({
						url: "topics.php",
						type: 'POST',
						data:{topicselect: da2},
						success: function(response) {
							location.reload();
			 
						}
					});
					return false;
				});	
				
			});
		
		</script>
		
	
	</body>
</html>