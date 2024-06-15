<?php
require 'database.php';

// Get filter values from the query parameters
$filter_name = isset($_GET['name']) ? $_GET['name'] : '';
$filter_login = isset($_GET['login']) ? $_GET['login'] : '';
$filter_logout = isset($_GET['logout']) ? $_GET['logout'] : '';
$filter_method = isset($_GET['method']) ? $_GET['method'] : '';

// Construct the base SQL query
$sql = "SELECT * FROM user_logs WHERE 1";

// Add conditions for each filter if they are provided
if (!empty($filter_name)) {
    $sql .= " AND name LIKE :name";
}
if (!empty($filter_login)) {
    // Format the date properly for comparison
    $filter_login = date('Y-m-d', strtotime($filter_login));
    $sql .= " AND DATE(time_in) = :login_date";
}
if (!empty($filter_logout)) {
    // Format the date properly for comparison
    $filter_logout = date('Y-m-d', strtotime($filter_logout));
    $sql .= " AND DATE(time_out) = :logout_date";
}
if (!empty($filter_method)) {
    $sql .= " AND methode LIKE :method";
}

// Add order by clause
$sql .= " ORDER BY time_in DESC";

// Prepare and execute the SQL query with bound parameters
$pdo = Database::connect();
$stmt = $pdo->prepare($sql);

if (!empty($filter_name)) {
    $stmt->bindValue(':name', '%' . $filter_name . '%');
}
if (!empty($filter_login)) {
    $stmt->bindValue(':login_date', $filter_login);
}
if (!empty($filter_logout)) {
    $stmt->bindValue(':logout_date', $filter_logout);
}
if (!empty($filter_method)) {
    $stmt->bindValue(':method', '%' . $filter_method . '%');
}

$stmt->execute();
$user_logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Output the filtered logs in an HTML table format
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered User Logs</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
 <style>
        .container{
           text-align:center;
        }
        h2{
          color:rgba(0,0,0,0.5);
          margin: 30px 0;
        }
        
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
    
 </style>
</head>
<body>

    <div class="container">
        <h2 >FILTERED USERS LOGS</h2>
        <table class="table table-striped">
        <thead>
                    <tr >
                      <th>NAME</th>
                      <th>C.UID</th>
					  <th>PINN</th>
					  <th>MOBILE</th>
                      <th>DEPART</th>
					  <th>METHOD</th>
                      <th>LOGIN </th> 
					  <th>LOGOUT </th>   
                    </tr>
                  </thead>
            <tbody>
                <?php foreach ($user_logs as $log): ?>
                    <tr>
                        <td><?php echo $log['name']; ?></td>
                        <td><?php echo $log['id']; ?></td>
                        <td><?php echo $log['pin']; ?></td>
                        <td><?php echo $log['mobile']; ?></td>
                        <td><?php echo $log['dep']; ?></td>
                        <td><?php echo $log['methode']; ?></td>
                        <td><?php echo $log['time_in']; ?></td>
                        <td><?php echo $log['time_out']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close database connection
Database::disconnect();
?>
