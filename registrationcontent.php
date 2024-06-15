<?php
     // Starting session and checking admin login
  session_start();
  if (!isset($_SESSION['Admin-name'])) {
     header("location: login.php");
   };
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<script src="jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
		</script>
		
		<style>
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
		}
		
		textarea {
			resize: none;
		}
		div h2 {
		color: #218E67;

		}
		form {
			display:flex;
			gap:1px;
			flex-direction:column;
			align-items:center;
			justify-content:center;
			margin-top:20px;
		}
		.ligne {
		 display: flex;
		 gap:5px;
		 width:90%;
		 align-items:center;
		 padding:0px;
		/* justify-content:center; */
		}
		 .ligne input{
			width:100%;
			margin:0px;
		 }
		button {
			width:100%;
			padding:10px 30px ;
			background-color: #218E67;
            color:white ;
			border:none;
			border-radius:10px;
			margin-top:10px;
		}
		button:hover{
            background-color: #218E57;
            cursor:pointer;
        }
		</style>
		
		<title>ENROLLEMENT PAGE</title>
	</head>
	
	<body>

	

		<div class="container" style="margin-top:10px; ">
			<br>
			<div class="center" style="box-shadow: 0px 5px 10px rgba(0,0,0,0.1);margin: 0 auto; width:60%; border-style: solid;border-width:2px;border-radius:10px; border-color: #f2f2f2;padding:30px 50px;
">
				<div class="row">
					<h2 align="center">ENROLLMENT</h2>
					
					<?php
                      if (!empty($_GET['message'])) {
                         $message = htmlspecialchars($_GET['message']);
                         echo "<p style='color:#FD5D5D;font-size:18px;text-align:center;'>$message</p>";
                     }
                    ?>
				</div>
				<br>
				<form class="" action="insertDB.php" method="post" >
					<div class="ligne">
							<textarea  style="height:25px;padding:5px 20px;border-radius:10px;width:600px" name="id" id="getUID" placeholder="SCAN THE CARD-UID"  required ></textarea>
							<input name="pinn" id="pinn" type="text"  maxlength="4" placeholder="----"  required autofocus style="height:25px;padding:5px 20px;border-radius:10px;"></input>
					</div>

					
					<div class=" ligne">
							<input id="div_refresh" name="name" type="text"  placeholder="FULL NAME.." required style="height:25px;padding:5px 20px;border-radius:10px;">
							<select name="gender" style="height:37px;padding:5px 20px;border-radius:10px;width:50%;">
								<option>GENDER</option>
							    <option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
					</div>
						
								<input name="email" type="text" placeholder="EMAIL ADRESS : JONE.DOE@GMAIL.COM" required style="height:25px;padding:5px 20px;border-radius:10px;width:84%">
						
						<div class="ligne">
								<input name="mobile" type="text"  placeholder="MOBILE NUMBER" required style="height:25px;padding:5px 20px;border-radius:10px;"> 
								<select name="dep" style="height:37px;padding:5px 20px;border-radius:10px;width:50%;">
								<option value="DEPARTEMENT">DEPARTEMENT</option>
								    <option value="CS-ISI">CS-ISI</option>
									<option value="CS-SIW">CS-SIW</option>
									<option value="CS-IASD">CS-IASD</option>
									<option value="CP-FIRST">CP-FIRST</option>
									<option value="CS-SECOND">CS-SECOND</option>

								</select>
					</div>
					<div style="width:90%">
						<button type="submit" >REGISTER</button>
	                </div>
				</form>
				
			</div>               
		</div> <!-- /container -->
	</body>
</html>
