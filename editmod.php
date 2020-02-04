 <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
	  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Discipline</h5>
        
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	<div class="modal-body">
	<?php
					$edit=mysqli_query($conn,"select * from discipline where id='".$row['id']."'");
					$row=mysqli_fetch_array($edit);
				?>
		
		<form method="POST" action="edit.php?id=<?php echo $row['id']; ?>">
		<h6> Discipline Name: </h6>
		<input type="text" name="disname" value="<?php echo $row['disname'] ?>" />
		<h6> Hours: </h6>
		<input type="text" name="dishour" value="<?php echo $row['hour'] ?>" />
		
			
      </div>
      
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
      
        <button type="submit" style="color:white"   class="btn btn-primary"> Save </button> 
        
		</form>
      </div>
	 
    </div>
  </div>
</div>