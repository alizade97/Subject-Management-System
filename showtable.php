 	<?php   
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: sign.php");
	}
	
	$user = $_SESSION["username"];

	include "connection.php";
	
					if(isset($_POST['data']) ){$limit = $_POST['data'];  setcookie('limit',$_POST['data'],time() + 86400);  }
					else {$limit=5;  setcookie('limit',5,time() + 86400);  }
						$limit = $_COOKIE['limit'];
							 if(isset($_GET['page'])){ $page = $_GET['page'];   setcookie('page',$_GET['page'],time() + 86400);}
							 else {$page =1;  setcookie('page',1,time() + 86400);}
							 $start = ($page-1)*$limit;
							 $sql1="SELECT * FROM discipline WHERE username= '$user'  LIMIT $start, $limit  ";
							 $sql2="SELECT count(*) AS id FROM discipline WHERE username= '$user'";
							$result1 = mysqli_query($conn, $sql1);
							$result2 = mysqli_query($conn, $sql2);
						
						$row2=mysqli_fetch_assoc($result2);
						$total = $row2['id'];
					
						$p = ceil($total/$limit);
					if($page>1) $prev = $page-1;
					if($page<$p) $next = $page+1;
						
							
echo "";
				
					
		?>			
 
 

 
 
 
	  <table style="margin-top:30px; margin-bottom:50px;" class="table table-striped table-hover table-responsive-sm">
    <thead class="thead-dark">
      <tr>
        <th>Discipline name</th>
        <th>Hours</th>
        <th>Edit</th>
        <th>Delete</th>
   
      </tr>
    </thead>
 <tbody>
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
      
	  <div class="modal-body">
    <form id="login"  action="topics.php" method="GET">
			<h6> Select Discipline: </h6>
			<select name="disname">
			  <?php  
			  $user = $_SESSION['username'];
			  $sql="SELECT * FROM discipline WHERE username='$user'";
		$result2 = mysqli_query($conn, $sql);
		while($row1=mysqli_fetch_array($result2)){
			  
			  
			  ?>
			  <option value="<?php echo $row1['disname']?>"<?php if($row1['disname'] == $row['disname']) echo " selected";?> ><?php echo $row1['disname']?></option>
			  
			  
		<?php }?>
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
					


	