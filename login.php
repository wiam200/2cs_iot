<?php
session_start();

// Redirect to home page if user is already logged in
if (isset($_SESSION['Admin-name'])) {
    header("location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Login Page</title>
    <style>
        body{
            padding:0px;
            margin:0;
        }
	    .container{
            font-family: "Jura", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            width:40%; 
            border: 2px solid  rgba(33,142,103,0.3);
            border-radius:10px;
            padding:60px 20px;
            box-shadow: 0px 5px 30px rgba(0,0,0,0.1);
        }
		form {
			display:flex;
			gap:3px;
			flex-direction:column;
			align-items:center;
			justify-content:center;
		}
        form div,input {
            margin-bottom:6px;
            text-align:center;
        }
		.holder {
            display:flex;
            justify-content:center;
            align-items:center;
            width:100%;
            height:100vh;
        }
		button {
			width:70%;
			padding:12px 30px ;
			background-color: #218E67;
            color:white ;
			border:none;
			border-radius:10px;
		}
        button:hover{
            background-color: #218E57;
            cursor:pointer;
        }
        .logo {
            width:100%;
            display:flex;
            justify-content:center;
            align-items:center;
        }
    </style>
</head>
<body>
<div class="holder">
 <div class="container" style="
">
				<div class="logo">
					<img src="img/iot.png" height="200" width="200"/>
				</div>
				<br>
                <form action="login_process.php" method="post" enctype="multipart/form-data">
                    <div>
                      <input name="email" type="text" placeholder="ADMIN @EMAIL"  required style="height:25px;padding:8px 20px;border-radius:10px;width:80%;border:1px solid #218E67;background-color:white">
                      <input type="password" id="password" name="password" placeholder="PASSWORD " required style="height:25px;padding:8px 20px;border-radius:10px;width:80%;border:1px solid #218E67;background-color:white">
                    </div>
						
						<button type="submit" name="login" >SIGN IN</button>
				</form>
				
			</div>        
    </div>

</body>
</html>
