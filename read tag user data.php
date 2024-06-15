<?php
require 'database.php';

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Retrieve user data
    $sql = "SELECT * FROM table_the_iot_projects WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    
    if (null == $data['id']) {
        $msg = "The ID of your Card / KeyChain is not registered !!!";
        $data['id'] = $id;
		$data['pin'] = "--------";
        $data['name'] = "--------";
        $data['status'] = "--------";
        $data['email'] = "--------";
        $data['mobile'] = "--------";
        $msg .= "<br><a href='registration.php' style='color:#218E67';>Register here</a>";
    } else {
        $msg = null;
        
        // Insert data into user_logs table
		// $sqlInsert = "INSERT INTO user_logs (name, id, pin, mobile, dep, time_in, methode) VALUES (?, ?, ?, ?, ?, ?, ?)";
		// $qInsert = $pdo->prepare($sqlInsert);
		// $qInsert->execute(array($data['name'], $data['id'], $data['pin'], $data['mobile'], $data['dep'], date("Y-m-d H:i:s"), "pin"));
		
    }
    
    Database::disconnect(); // Disconnect from the database
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<style>
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
		}

		
		td.lf {
	
			padding:15px 40px;
		}
	
		.holder {
			display:grid;
			grid-template-columns:auto auto;
		}
		form {
			display:flex;
			gap:3px;
			flex-direction:column;
			align-items:center;
			justify-content:center;
		}
		.table2{
			width:550px;
			
		}
	</style>
</head>
 
	<body>	
	<div class="container" style="margin-top:50px">
						
			<form  >
				<table  width="560px" border="1" bordercolor="#218E67" align="center"  cellpadding="0" cellspacing="1" style="border-radius:10px;">
					<tr>
						<td  height="40" align="center"  bgcolor="#218E67"><font  color="#FFFFFF">
							<b>User Data</b>
							</font>
						</td>
					</tr>
					<tr style="">
						<td  bgcolor="#f9f9f9">
							<table class="table2"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr >
									<td width="113" align="left" class="lf">ID</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['id'];?></td>
								</tr>
								<tr>
									<td width="113" align="left" class="lf">PINN</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['pin'];?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">NAME</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['name'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">STATUS</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['status'];?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">EMAIL</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['email'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">MOBILE </td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['mobile'];?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
      

		<p style="color:red;"><?php echo $msg;?></p>
	</body>
</html>
