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
    
         td {
            height:30px;
        }
    
     
        thead {
            color: #FFFFFF;
            background-color: #41A984;
        }
		tbody {
			color:#5C5C5C;
		}
        .search-container{
            height:50px;
            margin-top:20px;
        }
        .search-container input {
            height:50px;
            width:100%;
            padding:20px;
        }
        .succes ,.edit {
            background-color:rgba(137,235,175,30%) ;
            color: #41A984;
            padding:8px 15px ;
            border-radius:100px;
        }
        .succes:hover,.edit:hover{
            text-decoration:none;
            background-color:rgba(137,235,175,50%) ;
            color: #41A984;
        }

        .delete,.deny {
            background-color:rgba(255,0,0,20%) ;
            color: #AB2E2E;
            opacity:60%;
            padding:8px 15px ;
            border-radius:100px;
        }
        .delete:hover,.deny:hover{
            text-decoration:none;
            opacity:60%;
            background-color:rgba(255,0,0,30%) ;
            color: #AB2E2E;
        }
        .row{
            margin:40px 10px;
        }
        input{
            width:98%;
        }
        
        
    </style>
    <title>User Data : NodeMCU V3 ESP8266 / ESP12E with MYSQL Database</title>
</head>
<body>
   
        <div >
            <div class="row">
                <input type="search" placeholder="Search users by name..." />
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>CUID</th>
                            <th>PINN</th>
                            <th>GENDER</th>
                            <th>EMAIL</th>
                            <th>MOBILE</th>
                            <th>DEPAR</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'database.php';
                        $pdo = Database::connect();
                        $sql = 'SELECT * FROM table_the_iot_projects ORDER BY name ASC';
                        foreach ($pdo->query($sql) as $row) {
                            echo '<tr class="user-row">';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['pin'] . '</td>';
                            echo '<td>'. $row['gender'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td>'. $row['mobile'] . '</td>';
                            echo '<td>'. $row['dep'] . '</td>';
                            echo '<td >';
                            if ($row['status'] == 1) {
                                echo 'Active';
                                echo '</td>';
                                echo '<td class="actions"><a class="deny" href="user data status page.php?id='.$row['id'].'">Deny</a>';
                                echo ' ';
                                echo '<a class="edit" href="user data edit page.php?id='.$row['id'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="delete" href="user data delete page.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                            } else {
                                echo 'Inactive';
                                echo '</td>';
                                echo '<td class="actions"><a class="succes" href="user data status page.php?id='.$row['id'].'">Grant</a>';
                                echo ' ';
                                echo '<a class="edit" href="user data edit page.php?id='.$row['id'].'">Edit</a>';
                                echo ' ';
                                echo '<a class="delete" href="user data delete page.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                            }
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