
  
  <div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
	  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	  <div class="modal-body">
	 
	
		
	<?php
					$del=mysqli_query($conn,"select * from discipline where id='".$row['id']."'");
					$drow=mysqli_fetch_array($del);
					echo  '<p style="font-weight:600">Do you really want to delete this?</p>';
					echo ' <p > Discipline name: '. $drow['disname'] .'</p>';
					echo '<p> Hour: '. $drow['hour'].'</p>';
				?>
	
			
			
      </div>
      
	  <div class="modal-footer">
        <a type="button" class="btn btn-primary" style="background-color:red; color:white; border:1px solid red;" data-dismiss="modal" /> No </a>
         <a href="delete.php?id=<?php echo $row['id']; ?>"   type="button" class="btn btn-primary" style="background-color:blue; color:white; border:1px solid red;"  /> Yes </a>
        
      </div>
	 
    </div>
  </div>
</div>