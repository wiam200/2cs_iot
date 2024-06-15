<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM table_the_iot_projects  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: user data.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<title>Delete : NodeMCU V3 ESP8266 / ESP12E with MYSQL Database</title>
    <style>
		 .holder {
            display:grid;
            grid-template-columns:20% auto;
        }
        .container {
            display:flex;
            justify-content:center;
            margin-top:60px;
            /* align-items:center; */
        }
        form {
            width:50%;
            height: 40%;
            padding : 35px 50px;
            border: 2px solid rgba(255,0,0,15%);
            background-color:rgba(255,0,0,10%);
            border-radius:20px;
            display:flex;
            flex-direction:column;
            gap:20px;
            justify-content:center;
            align-items:center;
        }
        form p {
            width:80%;
            text-align:center;
            font-size:18px;
            color: #5C5C5C;
        }
        h3{
            color:green;
        }
		</style>
				
	</head>
	
	<body>
	<?php include 'top-nav.php'; ?>
     <div class="holder">
        <?php include 'navbar.php'; ?>

    <div class="container">
     
                
            <form class="" action="user data delete page.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                    <h3 style="color:red ;opacity:70%" >Please confirm deletion:</h3>
				<p > This action will permanently remove the user from our system. Admin confirmation
                     is required to proceed. Are you sure you want to delete this user?</p>
				<div class="">
					<button type="submit" class="btn btn-danger">Yes</button>
					<a class="btn" href="user data.php">No</a>
				</div>
			</form>                 
    </div> <!-- /container -->
    </div>
  </body>
</html>