
  
  <div class="modal fade" id="deltest<?php echo $row5['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					$del=mysqli_query($conn,"select * from test where id='".$row5['id']."'");
					$drow=mysqli_fetch_array($del);
					echo  '<p style="font-weight:600">Do you really want to delete this?</p>';
					echo ' <p > Discipline name: '. $drow['disname'] .'</p>';
					echo '<p> Topic: '. $drow['topic'].'</p>';
					echo '<p> Question: '. $drow['question'].'</p>';
					echo '<p> A) '. $drow['vara'].'</p>';
					echo '<p> B) '. $drow['varb'].'</p>';
					echo '<p> C) '. $drow['varc'].'</p>';
					echo '<p> D) '. $drow['vard'].'</p>';
					echo '<p> E) '. $drow['vare'].'</p>';
				?>
	
			
			
      </div>
      
	  <div class="modal-footer">
        <a type="button" class="btn btn-primary" style="background-color:red; color:white; border:1px solid red;" data-dismiss="modal" /> No </a>
         <a href="deletetest.php?id=<?php echo $row5['id']; ?>"   type="button" class="btn btn-primary" style="background-color:blue; color:white; border:1px solid red;"  /> Yes </a>
        
      </div>
	 
    </div>
  </div>
</div>