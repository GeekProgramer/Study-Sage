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
    $full_name= sanitizeInput($_POST['full_name']);
    $contact = sanitizeInput($_POST['phone_number']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    

    
    $query = "INSERT INTO user_info (full_name,phone_number,email, password) VALUES ('$full_name','$contact','$email', '$password')";
    $result = mysqli_query($conn, $query);

    
    if ($result) {
        
        $_SESSION['username'] = $full_name;
        $_SESSION['email'] = $email;

        header('Location: home.php?username=' . urlencode($_SESSION['username']));
        exit();
    } else {
        
        $error = 'Registration failed. Please try again.';
    }
}
?>