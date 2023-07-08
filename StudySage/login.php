<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_sage";
$conn = mysqli_connect($servername, $username, $password, $dbname);


function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    $query = "SELECT * FROM user_info WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

   
    if (mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_assoc($result);
       
        
        if ($password === $res['password']) {
            
            $_SESSION['username'] = $res['full_name'];
            $_SESSION['email'] = $email;
           
            header('Location: home.php?username=' . urlencode($_SESSION['username']));
            exit();
        } else {
            
            $error = 'Incorrect password';
            header('Location: index.php?error=' . urlencode($error));
            exit();
        }
    } else {
       
        $error = 'User does not exist';
        header('Location: index.php?error=' . urlencode($error));
        exit();
    }
}
?>