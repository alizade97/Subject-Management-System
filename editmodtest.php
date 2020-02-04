 <div class="modal fade" id="edittest<?php echo $row5['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
	  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Test</h5>
        
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
	<div class="modal-body">
	<?php
					$edit=mysqli_query($conn,"select * from test where id='".$row5['id']."'");
					$row6=mysqli_fetch_array($edit);
				?>
		
		<form method="POST" action="edittest.php?id=<?php echo $row5['id']; ?>">
		
		
		
		<h6> Select Discipline: </h6>
		
		<select id="disname3<?php echo $row5['id']; ?>" name="disname">
			 
			 <?php  
			  $user = $_SESSION['username'];
			  $sql="SELECT * FROM discipline WHERE username='$user'";
		$result = mysqli_query($conn, $sql);
		while($row6=mysqli_fetch_array($result)){
			  
			  
			  ?>
			  <option value="<?php echo $row6['disname']?>"  <?php if($row6['disname']==$row5['disname']) echo ' selected';?> ><?php echo $row6['disname']?></option>
			  
			  
		<?php }?>
			</select>
		
		
		
		
		<h6> Topic: </h6>
		<select id="disname4<?php echo $row5['id']; ?>" name="topic">
			  <option value="<?php echo $row5['topic']?>"   ><?php echo $row5['topic']?></option>
			</select>
	
		<h6> Question: </h6>	
		<input name="question" value="<?php echo $row5['question']; ?>" style="width:400px;" value="" />	
		<h6> A) </h6>	
		<input name="vara" value="<?php echo $row5['vara']; ?>" style="width:400px;" />	
		<h6> B) </h6>	
		<input name="varb" value="<?php echo $row5['varb']; ?>" style="width:400px;" />	
		<h6> C) </h6>	
		<input name="varc" value="<?php echo $row5['varc']; ?>" style="width:400px;" />	
		<h6> D) </h6>	
		<input name="vard" value="<?php echo $row5['vard']; ?>" style="width:400px;" />	
		<h6> E) </h6>	
		<input name="vare" value="<?php echo $row5['vare']; ?>" style="width:400px;" />	


	<script>
				
				$(document ).ready(function() {
				$('#disname3<?php echo $row5['id']; ?>').on('click', function() {
					
				var da= this.value;
				
				$.ajax({
				url: "testet.php",
				type: 'GET',
				   dataType: 'JSON',
				data:{data: da},
				success: function(response) {
				   
				   
				   
				    $('#disname4<?php echo $row5['id']; ?>').empty();
					
					for(var i=0; i<Object.keys(response).length; i++){
					
					var a = Object.values(response[i]);
					$('#disname4<?php echo $row5['id']; ?>').append('<option value='+a+/*if(a == "<?php echo $row5['topic']; ?>" ){document.write(" selected ")}+*/'>'+a+'</option>'); 
					
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
      
        <button type="submit" style="color:white"   class="btn btn-primary"> Save </button> 
        
		</form>
      </div>
	 
    </div>
  </div>
</div>