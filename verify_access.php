<?php
    require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["method"]) && isset($_POST["code"])) {
    $method = $_POST['method'];
    $code = $_POST['code'];


    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM table_the_iot_projects WHERE (id =:code or pin=:code) AND status = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $code);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $sql = "SELECT * FROM user_logs WHERE id = :id AND DATE(time_in) = CURDATE() ORDER BY time_in DESC LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $user['id']);
        $stmt->execute();
        $latest_log = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($latest_log && $latest_log['time_out'] === NULL) {
            $sql = "UPDATE user_logs SET time_out = NOW() WHERE id = :id AND DATE(time_in) = CURDATE() AND time_out IS NULL";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $user['id']);
            $stmt->execute();

            $message = "GOODBYE " . $user['name'];
        } else {
            $sql = "INSERT INTO user_logs (name, id, pin, mobile, dep, time_in, methode) VALUES (:name, :id, :pin, :mobile, :dep, NOW(), :method)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $user['name']);
            $stmt->bindParam(':id', $user['id']);
            $stmt->bindParam(':pin', $user['pin']);
            $stmt->bindParam(':mobile', $user['mobile']);
            $stmt->bindParam(':dep', $user['dep']);
            $stmt->bindParam(':method', $method);
            $stmt->execute();

            $message = "WELCOME " . $user['name'];
        }

        $response = array(
            "httpCode" => 200,
            "message" => $message
        );
        echo json_encode($response);
     } else {
        $response = array(
            "httpCode" => 401,
            "message" => "INVALID CODE"
        );
        echo json_encode($response);
    }

    Database::disconnect();
} else {
    $response = array(
        "status" => "error",
        "message" => "Invalid request"
    );
    echo json_encode($response);
}
//         echo $user['name']; // Send only the username
//     } else {
//         echo "No user found with the provided code.";
//     }

//     Database::disconnect();
// } else {
//     echo "Invalid request";
// }
?>

