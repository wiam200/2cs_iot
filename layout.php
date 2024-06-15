<!-- layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jura:wght@300..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>My Website</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body{
            display:flex;
            flex-direction:column ;
            position: fixed;
            width:100vw;
            height:100vh;     
          }
          .jura {
            font-family: "Jura", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-size:14px;
         }
        .holder{
            display:grid;
            grid-template-columns: 22% 78% ;
            height:86vh;
        }
        .main{
            padding:20px;
            overflow:auto;
        }
    </style>
</head>
<body class="jura">
    <header>
        <!-- Navbar content -->
        <?php include 'top-nav.php'; ?>  
    </header>
    <div class="holder">
        <div><?php include 'navbar.php'; ?></div>
      <main class="main">
          <?php include($content); ?>
       </main>
    </div>
</body>
</html>
