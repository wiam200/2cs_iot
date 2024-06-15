
    <?php
// Starting session and checking admin login
session_start();
if (!isset($_SESSION['Admin-name'])) {
   header("location: login.php");
};
$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);
$current_file = basename($_SERVER['PHP_SELF'], ".php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <style>
      .navbar {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 40px 20px 0px 70px;
    height:100%;
    background-color:#FDFBFB;
    font-style: normal;
         font-weight:bold;
            font-size:16px;

    border-right:1px solid rgba(0,0,0,0.07);
}

.navbar-brand {
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    color: #333;
}

.navbar-nav {
    display: flex;
    align-items: center;
    flex-direction: column;
}

.nav-link {
    color: #8C8C8C;
    text-decoration: none;
    padding: 12px 20px ;
    margin-right: 30px;
    margin-bottom:15px;
    font-weight:lighter;
    border-radius: 60px;
    width: 90%;
    text-align:left;
}

.nav-link:hover {
    background-color: rgba(242,242,242,50%);
    text-decoration: none;
    color: #5C5C5C;
}

.nav-link.active {
    background-color:rgba(137,235,175,20%) ;
    color: #41A984;
    opacity: 80%;
}



.user-initial {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background-color: #4CAF50;
    color: #fff;
    border-radius: 50%;
    font-size: 14px;
    font-weight: bold;
}
.logout_container{
    display:flex;
    align-items:left;
    margin-bottom:10px;
    margin-left:-20px;
}

.logout {
    color: #41A984;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom:60px;
}

/* 
.logout:hover {
    background-color: #f2f2f2;
} */
    </style>

    <title>User Data : NodeMCU V3 ESP8266 / ESP12E with MYSQL Database</title>
</head>

<body>
<nav class="navbar">
        <div class="navbar-nav">
         <a class="nav-link <?= $current_file == 'home' ? 'active' : '' ?>" href="home.php">HOME</a>
         <a class="nav-link <?= $current_file == 'user data' ? 'active' : '' ?>" href="user data.php">ALL USERS</a>
         <a class="nav-link <?= $current_file == 'users logs' ? 'active' : '' ?>"href="users logs.php">USERS LOGS</a>
         <a class="nav-link <?= $current_file == 'registration' ? 'active' : '' ?>"  href="registration.php">ENROLLMENT</a>
         <a class="nav-link <?= $current_file == 'read tag' ? 'active' : '' ?>" href="read tag.php">READ TAG</a>
  
       </div>
   
       <div class="logout_container">
       <a class="nav-link logout" href="logout.php">LOGOUT ></a>
       </div>
    </nav>

</body>
</html>