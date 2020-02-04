<?php 
	session_start();
	if(!isset($_SESSION["username"])){
		header("Location: sign.php");
	}

	include "connection.php";
	
	if(isset($_GET["action"])) $action = $_GET["action"];
	else $action="";

	
	
	
	
	
	
	
	
	
	switch($action){
		case "logout":
			
			session_unset();
			session_destroy();
			header("Location: sign.php");
		break;
		
		case "disciplines":
			header("Location: disciplines.php");
		break;
		
		case "topics":
			header("Location: topics.php");
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
			 
			<li class="nav-item">
				<a class="nav-link" href="?action=disciplines">Disciplines</a>
			  </li>
			
			<li class="nav-item">
				<a class="nav-link"href="?action=topics">Topics</a>
			  </li>
			 
			 <li class="nav-item">
				<a class="nav-link" href="?action=tests">Tests</a>
			  </li>
			  
			  <li class="nav-item active">
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
	<h1 style="text-align:center; width:80%; margin:30px auto;"> Test Maker </h1>
	<form style="width:80%; margin:auto;" action="testmaker.php" method="GET">
 
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Discipline</label>
    
	<select id="disname3" name="disname" class="form-control" required>
      <option value=""  ></option>

	 <?php  
			  $user = $_SESSION['username'];
			  $sql="SELECT * FROM discipline WHERE username='$user'";
		$result = mysqli_query($conn, $sql);
		while($row6=mysqli_fetch_array($result)){
			  
			  
			  ?>
			  <option value="<?php echo $row6['disname']?>"  ><?php echo $row6['disname']?></option>
			  
			  
		<?php }?>
    </select>
  </div>
  
  
  
  <div class="form-group">
    <label for="exampleFormControlSelect2">Select Topic</label>
    <select id="disname4" name="topic[]" multiple="multiple" class="form-control" required>
      
    </select>
	
	<script>
				
				$(document).ready(function() {
				$('#disname3').on('change', function() {
					
				var da= this.value;
				
				$.ajax({
				url: "testet.php",
				type: 'GET',
				   dataType: 'JSON',
				data:{data: da},
				success: function(response) {
				   
				   
				   
				    $('#disname4').empty();
					
					for(var i=0; i<Object.keys(response).length; i++){
					
					var a = Object.values(response[i]);
					$('#disname4').append('<option value='+a+/*if(a == "<?php echo $row5['topic']; ?>" ){document.write(" selected ")}+*/'>'+a+'</option>'); 
					
					}
         
				}
    });
				
				
				
				
				  return false;
				
					});
			});

			
			
			</script>
  </div>
 <div class="form-row">
    <div class="col-md-3 mb-4">
      <label for="validationTooltip01">Variant Count</label>
      <input type="text" name="variant" class="form-control" id="validationTooltip01"   required>
     
    </div>
    <div class="col-md-3 mb-4">
      <label for="validationTooltip02">Question Count</label>
      <input type="text" name="qstn" class="form-control" id="validationTooltip02" required>
      
    </div>
     <div class="col-md-3 mb-4">
      <label for="validationTooltip02">Pick Date</label>
    <input class="form-control" name="date" type="date" name="bday" max="2100-12-31" required>
      
    </div>
	  <div class="col-md-3 mb-4">
      <label for="validationTooltip02">Class Name</label>
    <input type="text" name="clsnm" class="form-control" id="validationTooltip02" required>
      
    </div>
  </div>
  
  
  <div class="col-md-12 text-center"> 
   <button class="btn btn-primary" name="make" type="submit">Make Test</button>
   </div>

	
	<?php 
	
	$myarray = array();
	$i=0;
	
	function array_push_assoc($array, $key, $value){
   $array[$key] = $value;
   return $array;
}
	$myarray = array();
	if(isset($_GET["disname"])) $disname = $_GET["disname"];
	if(isset($_GET["topic"])) {
			if(isset($_GET["variant"])) $variant = $_GET["variant"];
	if(isset($_GET["qstn"])) $qstn = $_GET["qstn"];
	if(isset($_GET["date"])) $date = $_GET["date"];
	if(isset($_GET["clsnm"])) $clsnm = $_GET["clsnm"];
		
		
		
		foreach($_GET["topic"] as $topic){
			
		$sql="SELECT * FROM test WHERE disname='$disname' AND topic='$topic'";
		$result = mysqli_query($conn, $sql);
		while($row=mysqli_fetch_array($result) ){
			
			
			$myarray = array_push_assoc($myarray, $i, $row['id']);
		
			if($i < $qstn*$variant-1) $i++;
			
		}
			
			
		}
			//print_r( $myarray);
	}
	
	

	
	
	
	if(isset($_GET["make"])) {
	if($i<$qstn*$variant-2){
		
		//echo '<script> alert("There is no enough questions to create a test")</script>';
		
		echo '
		<div id="errormodal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>There is no enough questions to create a test</p>
      </div>
      <div class="modal-footer">
   
        <button id="close" style="background-color:red;" type="button" class="btn btn-secondary" data-dismiss="modal" " >Close</button>
      </div>
    </div>
  </div>
</div>
		
		
		<script>
    $(document).ready(function(){
        
            $("#errormodal").modal("show");
			
			$("#close").click(function(){
			window.location.href="testmaker.php";
})
        
    });
</script>
		
		
		
		';
		
	}
	else{
		
		$numbers = range(1, $qstn*$variant);
		shuffle($numbers);
	//	print_r( $numbers);
		
		$arr3 = array_combine($numbers, $myarray);
		//print_r($arr3);
		
		ksort($arr3);
		
		//print_r($arr3);
		require("../../mpdf/vendor/autoload.php");
		
		
		$mpdf = new \Mpdf\Mpdf();
		
		$vrnt =1;
		$p="";
		$d="";
			echo '<div style="margin:auto; width:80%;">';
			echo '<table style="margin-top:30px; margin-bottom:50px;" class="table table-striped table-hover table-responsive-sm">
						<thead class="thead-dark">
							<tr>
								<th>Variant</th>
								<th>Download link</th>
							</tr>
						</thead>
						<tbody>';
			foreach ($arr3 as $key => $value) {
				
					
					
					$sql="SELECT * FROM test WHERE id='$value'";
					$result = mysqli_query($conn, $sql);
					
					while($row10=mysqli_fetch_array($result) ){
			
					
					
					$p= $p.'<h3>' .$key.' '.$row10['question'].'</h3>';
					$p= $p.'<p> A) '.$row10['vara'].'</p>';
					$p= $p.'<p> B) '.$row10['varb'].'</p>';
					$p= $p.'<p> C) '.$row10['varc'].'</p>';
					$p= $p.'<p> D) '.$row10['vard'].'</p>';
					$p= $p.'<p> E) '.$row10['vare'].'</p>';
					
					
					
					
					
					
					
					
					
					
			
					}
				
				if($key%$qstn ==0){
				
					$d = $d.'<h1 style="text-align:center;">'.$disname.'</h1>';
					$d = $d.'<h3 style="text-align:center">'.$date.'</h3>';
					$d = $d.'<h3 style="text-align:center"> Variant '.$vrnt.'</h3>';
				
				$mpdf->writeHTML($d);
				$mpdf->writeHTML($p);
				$mpdf->Output('pdf/variant'.$vrnt.'.pdf', 'F' );	
				echo '
				<tr> <td style="width:50%"> Variant '.$vrnt.'</td>
				<td><a style="  margin-right:10px;"  class="btn btn-success" href="pdf/variant'.$vrnt.'.pdf">Download Variant '.$vrnt.'</a></td></tr>';
				$vrnt++;
				$d="";
				$p="";
				}
				
				
				
			}
			
			echo '</tbody></table>';
					
			echo '</div>';
		
		
		
		
	
			
	}
	
	
	
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	?>
	
	</form>
  </div>

  
  
  
  
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; SMS <?php echo date("Y"); ?></p>
    </div>
  </footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		
	</body>
</html>