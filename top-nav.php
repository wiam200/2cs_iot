
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
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/bootstrap.min.js"></script>
    <style>
      .top-container{
         display:flex;
         background-color:#FDFBFB;

         justify-content:space-between;
         padding:0px 70px 0px 70px;
         margin:0%;
         border-bottom:1px solid rgba(0,0,0,0.08);
         font-style: normal;
         font-weight:bold;
            font-size:16px;

      }
      .top-container h3 {
        color: #41A984;
        padding : 10px 0px 0px 0px;
      }
      .top-container p {
        color: #5C5C5C;
        opacity:80%;
        display:inline-block;
      }
      .admin-data {
        display:flex;
        gap:15px;
        color: #5C5C5C;
        opacity:80%;
        justify-content:center;
        align-items:center;
      }
      .admin-name{
      }
      .admin-first {
        height:40px;
        width: 40px;
        border-radius:60px;
        background-color: #218E67;
        color:white;
        display:flex;
        justify-content:Center;
        align-items:center;
    }
    </style>

</head>

<body>
<!-- <img src="img/iot.png" height="50" width="50"/> -->
<div class="top-container">
    <h3><p> <i class="fa-brands fa-squarespace fa-rotate-by fa-xl" style="--fa-rotate-angle: 40deg;"></i></p>-TRACK</h3>
    <div class="admin-data">
        <span class="admin-name">MEHAL WIAM</span>
        <span class="admin-first">W</span>
    </div>
</div>
</body>
</html>