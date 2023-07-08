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
function function_alert($message) {
      
  echo "<script>alert('$message');</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $existingUsername = sanitizeInput($_POST['username']);
    $sessionUsername = $_SESSION['username'];
    $newUsername = sanitizeInput($_POST['new_username']);
    if ($existingUsername === $sessionUsername) {
      $_SESSION['username'] = $newUsername;
  
      $updateQuery = "UPDATE user_info SET full_name = '$newUsername' WHERE full_name = '$existingUsername'";
      mysqli_query($conn, $updateQuery);
     
      header('Location: home.php?username=' . urlencode($_SESSION['username']));
      exit();
    }else{
      function_alert("Enter correct username");
    } 
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="static/Username.css" />

</head>

<body>
    <section>
        <div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="subtitle">User Profile</div>
                <div class="input-container ic1">
                    <input name="username" id="username" class="input" type="text" placeholder="" />
                    <div class="cut"></div>
                    <label for="username" class="placeholder">USERNAME</label>
                </div>
                <div class="input-container ic2">
                    <input name="new_username" id="new_username" class="input" type="text" placeholder="" />
                    <div class="cut"></div>
                    <label for="new_username" class="placeholder">NEW USERNAME</label>
                </div>
                <button type="submit" class="submit" onclick="function_alert()">UPDATE</button>
            </form>
        </div>
    </section>

</body>

</html>