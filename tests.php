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
	if(isset($_GET["question"])) $question = $_GET["question"];
	if(isset($_GET["vara"])) $vara = $_GET["vara"];
	if(isset($_GET["varb"])) $varb = $_GET["varb"];
	if(isset($_GET["varc"])) $varc= $_GET["varc"];
	if(isset($_GET["vard"])) $vard = $_GET["vard"];
	if(isset($_GET["vare"])) $vare = $_GET["vare"];
	
	if(isset($_GET['add']) && isset($_GET["disname"]) && isset($_GET["topic"]) && isset($_GET["question"]) && isset($_GET["vara"]) && isset($_GET["varb"]) && isset($_GET["varc"]) && isset($_GET["vard"]) && isset($_GET["vare"]) ){
	
	
	$sql = "insert into test(username, disname, topic, question, vara, varb, varc, vard, vare ) values('$username',  '$disname', '$topic', '$question', '$vara', '$varb', '$varc', '$vard', '$vare'  ) ";
			
			mysqli_query($conn, $sql);
			unset($_GET["disname"]);
			unset($_GET["topic"]);
			unset($_GET["question"]);
			unset($_GET["vara"]);
			unset($_GET["varb"]);
			unset($_GET["varc"]);
			unset($_GET["vard"]);
			unset($_GET["vare"]);
			

			
			header("Location: tests.php");
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
	
	
		 <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
			
			<li class="nav-item">
				<a class="nav-link"href="?action=topics">Topics</a>
			  </li>
			 
			 <li class="nav-item active">
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
         
			<button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"> <a href="#" style="color:white;" >Add Test</a></button>
		</div>

      </div>
   

      <div class="col-lg-9">
		<h1 style="margin-top:10px;"> Tests </h1>
			
			
					<?php    $limit=10;
							$user = $_SESSION["username"];
							 if(isset($_GET['page'])){ $page = $_GET['page'];   setcookie('page',$_GET['page'],time() + 86400);}
								 else {$page =1;  setcookie('page',1,time() + 86400);}
							 
							 $start = ($page-1)*$limit;
							 $sql1="SELECT * FROM test WHERE username= '$user'  LIMIT $start, $limit  ";
							 $sql2="SELECT count(*) AS id FROM test WHERE username= '$user'";
							$result1 = mysqli_query($conn, $sql1);
							$result2 = mysqli_query($conn, $sql2);
						
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
					
						$p = ceil($total/$limit);
					if($page>1) $prev = $page-1;
					if($page<$p) $next = $page+1;
						
							

					?>
			
					
			
			<?php	
		?>
	  <table style="margin-top:30px; margin-bottom:50px;" class="table table-striped table-hover table-responsive-sm">
    <thead class="thead-dark">
      <tr>
	   <th>Test Number</th>
        <th>Test Discipline</th>
        <th>Test Topic</th>
       
         <th>View</th> 
        <th>Edit</th>
        <th>Delete</th>
   
      </tr>
    </thead>
    <tbody>
		<?php
		$f=1;
		while($row5=mysqli_fetch_assoc($result1)){
		?>
		
      <tr>
		 <td><?php  echo $f; $f++; ?></td>
        <td><?php echo $row5["disname"] ?></td>
        <td><?php echo $row5["topic"] ?></td>
       
		
		<td>
		
		<a style="background-color:green; color:white;" href="#showtest<?php echo $row5["id"] ?>" class="btn btn-primary ed" data-toggle="modal" > Show</a>
		<?php include('showtest.php'); ?>
		
		</td>
		
		
		
		<td>
		
		<a  style="color:white;" href="#edittest<?php echo $row5["id"] ?>" class="btn btn-primary ed" data-toggle="modal" > Edit</a>
		<?php include('editmodtest.php'); ?>
		
		</td>
		
		<td>
		<a href="#deltest<?php echo $row5["id"] ?>" data-toggle="modal" class="btn btn-danger"> Delete</a>
							<?php  include('delmodtest.php'); ?>
		
		<?php } ?>
		
		
		
		</td>
      </tr>
   
     
    </tbody>
  </table>

  
  <nav style="margin-bottom:10px;" aria-label="Page navigation">
					  <ul class="pagination">
						<li class="page-item"><a class="page-link" href="tests.php?page=<?php echo $prev; ?>">Previous</a></li>
						
						<?php for($i=1; $i<=$p; $i++) { ?>
						<li class="page-item <?php if($page == $i) echo ' active'; ?>"><a class="page-link" href="tests.php?page=<?php echo $i; ?>"><?php echo $i; ?> </a></li>
							 <?php } ?>
						
						<li class="page-item"><a class="page-link" href="tests.php?page=<?php echo $next; ?>">Next</a></li>
					  </ul>
					</nav>
		
      </div>
   

    </div>
	
	
  </div>


			  
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
			  $sql="SELECT * FROM discipline WHERE username='$user'";
			  $result = mysqli_query($conn, $sql);

		      while($row=mysqli_fetch_array($result)){
			  
			  
			  ?>
			  
			  <option  value="<?php echo $row['disname']?>"><?php echo $row['disname']?></option>
			  
			  
				 <?php }?>
   
		
			</select>
			
		
			
			
		<h6> Select Topic: </h6>
			
			<select   id="disname2" name="topic">
			
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
		 
		 
		 
    
	
 
  
  
 
 
 
   

 
 
 
 



  
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; SMS <?php echo date("Y"); ?></p>
    </div>
  </footer>

		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script> 
		
			$(document).ready(function(){
				$(".pagination").rPage();
				$("#a").click(function(){
					
					
					
					
					return false;
				});
				
				
				
				$(".del").click( function(){
					 var id = $(this).attr("id");  
					$.ajax({
					type: "GET",
					url: 'disciplines.php',
					 data: {id: id},
					 
    success: function(data){
     
	  $('#exampleModal3').modal('show');
	    $('.modal-body').text(data);

    }
				});
					
					
				
					
					
				});
				
				
				
				
			});
		
		</script>
		
	
	</body>
</html>