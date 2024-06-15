<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM table_the_iot_projects where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		
		<style>
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
		}
		
		
		div h3 {
		color: #218E67;

		}
		form {
			display:flex;
			gap:8px;
			flex-direction:column;
			align-items:center;
			justify-content:center;
			margin-top:30px;
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
			padding:8px 30px ;
			background-color: #218E67;
            color:white ;
			font-size:14px;
			border:none;
			border-radius:10px;
		}
		button:hover{
            background-color: #218E57;
            cursor:pointer;
        }
		.actions{
			width:90%;
            margin-top:10px;
		}
		.btns{
          width:100%;
		}
		.btnb{
			background-color:#D7D7D8;
			margin-top:5px;
		}
		.btnb:hover{
			background-color:#D7D7C9;
            cursor:pointer;
		}
		.btnb a {
			color:#218E67;
		}
		
		</style>
		
		<title>Edit Page</title>
		
	</head>
	
	<body>
	
		<div class="container" style=" ">
			<br>
			<div class="center" style="box-shadow: 0px 5px 10px rgba(0,0,0,0.1);margin: 0 auto; width:60%; border-style: solid;border-width:2px;border-radius:10px; border-color: #f2f2f2;padding:40px 50px;
">
				<div class="row">
					<h3 align="center">EDIT USER DATA</h3>
					<p id="defaultGender" hidden><?php echo $data['gender'];?></p>
				</div>
		 
				<form class="form-horizontal" action="user data edit tb.php?id=<?php echo $id?>" method="post">
				<div class="ligne">
					<input name="id" type="text"  placeholder="" value="<?php echo $data['id'];?>" style="height:25px;padding:5px 20px;border-radius:10px;width:600px" readonly>
					<input name="pinn" type="text" maxlength="4"  placeholder="----" value="<?php echo $data['pin'];?>" style="height:25px;padding:5px 20px;border-radius:10px;" required>
				</div>
			
				<div class=" ligne">
							<input id="div_refresh" name="name" type="text" value="<?php echo $data['name'];?>" required style="height:25px;padding:5px 20px;border-radius:10px;">
							<select name="gender" id="mySelect" style="height:37px;padding:5px 20px;border-radius:10px;width:50%;">
								<option>GENDER</option>
							    <option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
					</div>
					<input name="email" type="text" value="<?php echo $data['email'];?>"  required style="height:25px;padding:5px 20px;border-radius:10px;width:84%">


					
					<div class="ligne">
						<input name="mobile" type="tel"  value="<?php echo $data['mobile'];?>"  required style="height:25px;padding:5px 20px;border-radius:10px;"> 
				
								<select name="dep" style="height:37px;padding:5px 20px;border-radius:10px;width:50%;" >
								<option value="<?php echo $data['dep']?>"><?php echo $data['dep']?></option>
								    <option value="CS-ISI">CS-ISI</option>
									<option value="CS-ISI">CS-ISI</option>
									<option value="CS-IASD">CS-IASD</option>
									<option value="CP-FIRST">CP-FIRST</option>
									<option value="CS-SECOND">CS-SECOND</option>

								</select>
								
					</div>
				
					<div class="actions">
						<button type="submit" class="btns">UPDATE</button>
						<button class="btnb"><a  href="user data.php">BACK</a></button>
					</div>
				</form>
			</div>               
		</div> <!-- /container -->	
		
		<script>
			var g = document.getElementById("defaultGender").innerHTML;
			if(g=="Male") {
				document.getElementById("mySelect").selectedIndex = "0";
			} else {
				document.getElementById("mySelect").selectedIndex = "1";
			}
		</script>
	</body>
</html>
