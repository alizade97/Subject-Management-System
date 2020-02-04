 <div class="modal fade" id="add<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
	  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
        
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	  <div class="modal-body">
   
			<h6> Select Topic: </h6>
			<select   name="disname">
			  <?php  
			 $disc = $row['disname'];
			 $user = $_SESSION['username'];
			  $sql1="SELECT * FROM topic WHERE username='$user' AND disname='$disc'";
		    $result1 = mysqli_query($conn, $sql1);
		
		
		while($row1=mysqli_fetch_array($result1)){
			  
			  
			  ?>
			  <option value="<?php echo $row1['topic']?>"><?php echo $row1['topic']?></option>
			  
			    <?php }?>
		
			</select>
		
		 
			
			
      </div>
      
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
         <input value="Add" type="submit" name="add" class="btn btn-primary"/>
       

  
		 
		 
		
		 
		 
		 </div>
	  
 </div>
  
    </div>
  
</div>