 <div class="modal fade" id="edittop<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
	  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Topic</h5>
        
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	<div class="modal-body">
	<?php
					$edit=mysqli_query($conn,"select * from topic where id='".$row['id']."'");
					$row=mysqli_fetch_array($edit);
				?>
		
		<form method="POST" action="edittop.php?id=<?php echo $row['id']; ?>">
		<h6> Select Discipline: </h6>
			<select name="disname">
			  <?php  
			  $user = $_SESSION['username'];
			  $sql="SELECT * FROM discipline WHERE username='$user'";
		$result = mysqli_query($conn, $sql);
		while($row1=mysqli_fetch_array($result)){
			  
			  
			  ?>
			  <option value="<?php echo $row1['disname']?>"  <?php if($row['disname']==$row1['disname']) echo ' selected';?> ><?php echo $row1['disname']?></option>
			  
			  
		<?php }?>
			</select>
		
		<h6> Topic: </h6>
		<input type="text" name="topic" value="<?php echo $row['topic'] ?>" />
		
			
      </div>
      
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
      
        <button type="submit" style="color:white"   class="btn btn-primary"> Save </button> 
        
		</form>
      </div>
	 
    </div>
  </div>
</div>