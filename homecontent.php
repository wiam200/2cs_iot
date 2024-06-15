<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['Admin-name'])) {
    header("location: login.php");
    exit();
}

// If logged in, greet the user
$admin_name = $_SESSION['Admin-name'];
?>
<?php
require 'database.php';

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get the total number of registered users
$sql = "SELECT COUNT(*) FROM table_the_iot_projects";
$q = $pdo->prepare($sql);
$q->execute();
$totalUsers = $q->fetchColumn();

// Get the number of unique users present today
$today = date('d-m-y');
$sql = "SELECT COUNT(DISTINCT id) FROM user_logs WHERE DATE_FORMAT(time_in, '%d-%m-%y') = ?";
$q = $pdo->prepare($sql);
$q->execute(array($today));
$presentUsers = $q->fetchColumn();

$todayy = date('Y-m-d');
$sql = "SELECT time_in, time_out FROM user_logs WHERE DATE(time_in) = ?";
$q = $pdo->prepare($sql);
$q->execute(array($todayy));
$logs = $q->fetchAll(PDO::FETCH_ASSOC);

$totalHours = 0;
$count = 0;
foreach ($logs as $log) {
    $time_in = new DateTime($log['time_in']);
    $time_out = new DateTime($log['time_out']);
    $interval = $time_out->diff($time_in);
    $hours = $interval->h + ($interval->i / 60);
    $totalHours += $hours;
    $count++;
}

$averageHours = $count > 0 ? $totalHours / $count : 0;
$todayFormatted = strftime('%A %d-%m-%Y');

// // Calculate the number of absent users
$absentUsers = $totalUsers - $presentUsers;

// Get the number of departments
$sql = "SELECT COUNT(DISTINCT dep) FROM table_the_iot_projects";
$q = $pdo->prepare($sql);
$q->execute();
$numDepartments = $q->fetchColumn();

// Get the number of female users
$sql = "SELECT COUNT(*) FROM table_the_iot_projects WHERE gender = 'Female'";
$q = $pdo->prepare($sql);
$q->execute();
$numFemales = $q->fetchColumn();

// Get the number of male users
$sql = "SELECT COUNT(*) FROM table_the_iot_projects WHERE gender = 'Male'";
$q = $pdo->prepare($sql);
$q->execute();
$numMales = $q->fetchColumn();

Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<script src="js/bootstrap.min.js"></script>
		<style>
		.container .r1 {
			display:grid;
			grid-template-columns:50% 25% 25%;
			gap:10px;
			justify-content:center;
			align-items:center;
		}
		.container .r1 .f2 ,.f1 {
			
			border-radius:10px;
			display:flex;
			align-items:center;
			justify-content:space-around;
			flex-direction:column;
			text-align:center;
			padding:30px;
			height:70%;
		}
		.f2{
			background-color:#218E67;
			color: #f1eded;
		}
		.f2:hover{
			background-color:#218067;
			cursor:pointer;
		}
		.f1 {
			background-color:#F7F7F7;
			border:1px solid #218E67;
			
			color:#218E67;
		}
		.f1:hover{
			background-color:#F9E9F9;
			cursor:pointer;
		}
		.r2{
		}
		.r3{
			display:grid;
			grid-template-columns:1fr 1fr 1fr 1fr 1fr;
			gap:10px;
			justify-content:space-between;
			align-items:center;
        		}
		.r3 div {
			width:85%;
			font-size:20px;
            display:flex;
			align-items:center;
			justify-content:space-evenly;
			flex-direction:column;
			text-align:center;
			gap:15px;
		}
		.r3 div h4{
			color: #838383;
		}
        .stat-box {
			background-color:#F7F7F7;
			color:#218E67;
            padding:  15px;
            border-radius: 10px;
			border: 1px solid rgba(131,131,131,0.3);
            /* width: 180px; */
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }
        .stat-box h3 {
            margin: 0;
            font-size: 1.5rem;
        }
        .stat-box p {
            margin: 0.5rem 0 0;
            font-size: 1.2rem;
			color:rgba(131,131,131,0.8);
        }
        .header {
            background-color: #34a76c;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-size: 2rem;
        }
        .image-container {
            text-align: center;
            margin: 1rem 0;
        }
        .image-container img {
            max-width: 800px;
            height: 280px;
        }
		
		@media screen and (max-width: 600px) {
			ul.topnav li.right, 
			ul.topnav li {float: none;}
		}
		
		</style>
		
		<title>Home Page</title>
	</head>
	
	<body>

	   <div class="container">

		<div class="r1">
			<div class="image-container">
				<img src="img/home.png" alt="Dashboard Image">
			</div>
        <div class="f1">
            <p style="font-size:20px;line-height:32px">All REGISTERED USERS </p>
            <h1 style="font-size:48px;"><?php echo $totalUsers; ?>73</h1>
        </div>
        <div class="f2">
		<!-- <p style="font-size:20px;line-height:32px">CURRENT DATE </p> -->
		<p style="font-size:20px;line-height:32px">
			<?php 
				setlocale(LC_TIME, 'fr_FR.UTF-8');
				$date = strftime('%A %d-%m-%Y'); 
				echo mb_strtoupper($date, 'UTF-8');
			?>
		</p>
		<i class="fa-solid fa-calendar-days" style="color: #f1eded;font-size: 52px;margin-top:-10px;"></i>
        </div>
		</div>


        <div class="r2">
			<div class="r3">
        <div class="stat-box">
		<p style="font-size:16px;line-height:28px">ATTENDANCE RATIO(%) </p>
            <h3><?php echo round(($presentUsers / $totalUsers) * 100, 2); ?>%</h3>
        </div>
        <div class="stat-box">
		<p style="font-size:16px;line-height:28px"> NUMBER OF ABSENCES </p>
            <h3><?php echo $absentUsers; ?></h3>
        </div>
        <div class="stat-box">
		<p style="font-size:16px;line-height:28px">NUMBER OF PRESENCEs  </p>
            <h3><?php echo $presentUsers; ?></h3>
        </div>
		<div class="stat-box">
		<p style="font-size:16px;line-height:28px">DEPARTEMENT NUMBER</p>
			<h3><?php echo $numDepartments; ?></h3>
		</div>
		<div class="stat-box">
		<p style="font-size:16px;line-height:28px"> AVERAGE WORKING HOURS</p>
	   <h3>  
	   <?php 
            echo number_format($averageHours, 2); 
        ?> H
		</h3>
		</div>
		
	</div>
	 
	
	</div>
    <!-- </div> -->
</div>
	</body>
</html>
