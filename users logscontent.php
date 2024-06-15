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
		<style>

        .table {
           width:100%;
        }
        td {
            height:30px;
        }
        .row2 {
            width:100%;
            height:400px;
            overflow:auto;

            /* height:70%; */
            overflow-y:scroll;
            position: absolute;
            top:100px;
            left:0px;
        }
        .row1 {
            width:70%;
            padding : 50px 0px 0px 0px;
            position: fixed;
            top:81px;
            background-color:white;
            z-index:10;
        }
        thead {
            color: #FFFFFF;
            background-color: #41A984;
        }
		tbody {
			color:#5C5C5C;
		}
		
        .main-form{
            display:grid;
            grid-template-columns:auto auto auto  auto auto ;
            gap:5px;
            background-color:white;
        }
        button{
            width:65px;
            height:30px;
            color: #FFFFFF;
            background-color: #41A984;
            outline:none;
            border:none;
            border-radius:7px;
        }
        form input {
            width:180px;
        }
        
		</style>
		
		<title>User Data </title>
	</head>
	
	<body>
	
		<div class="container" style="position:relative">
            <div class="row1">
			   <form class="main-form" method="GET" action="users logs filter.php" >

                         <input type="text" name="name" id="name" class="" placeholder="Name">
                          <input type="date" name="login" id="login" class="" placeholder="Login Date">
                         <input type="date" name="logout" id="logout" class="" placeholder="Logout Date">
                        <select name="method" id="method" class="">
                            <option value="">METHODE</option>
                            <option value="pin">PIN</option>
                            <option value="rfid">RFID</option>
                        </select>
         
                      <div class="action">
                         <button type="submit" >Filter</button>
                      </div>
               </form>


            </div>
            <div class="row2">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr >
                      <th>Name</th>
                      <th>C.UID</th>
					  <th>PINN</th>
					  <th>Mobil</th>
                      <th>Departement</th>
					  <th>Method</th>
                      <th>LOGIN </th> 
					  <th>LOGOUT </th>   
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM user_logs ORDER BY time_in DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['id'] . '</td>';
							echo '<td>'. $row['pin'] . '</td>';
							echo '<td>'. $row['mobile'] . '</td>';
                            echo '<td>'. $row['dep'] . '</td>';
							echo '<td>'. $row['methode'] . '</td>';
							echo '<td>'. $row['time_in'] . '</td>';
							echo '<td>'. $row['time_out'] . '</td>';
							echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
				</table>
			</div>
		</div> <!-- /container -->
	</body>
</html>
