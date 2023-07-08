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

    $email = sanitizeInput($_POST['email']);
    $newPassword = sanitizeInput($_POST['newPassword']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

    if ($_SESSION['email'] === $email) {

      if ($newPassword !== $confirmPassword) {
          function_alert("New password and confirm password do not match.");
          exit;
      }
      else{
      $query = "SELECT * FROM user_info WHERE email = '$email'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
          $updateQuery = "UPDATE user_info SET password = '$newPassword' WHERE email = '$email'";
          if (mysqli_query($conn, $updateQuery)) {
              header('Location: home.php?username=' . urlencode($_SESSION['username']));
              exit();
          } else {
              function_alert("Error updating password: " . mysqli_error($conn));
          }
      }
    }
  } else {
        function_alert("Invalid email!");
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="static/Password.css" />
</head>

<body>
    <section>
        <div class="form">
            <div class="subtitle">User Profile</div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="input-container ic1">
                    <input id="email" class="input" type="text" name="email" placeholder="" />
                    <div class="cut"></div>
                    <label for="email" class="placeholder">EMAIL</label>
                </div>
                <div class="input-container ic2">
                    <input id="newPassword" class="input" type="password" name="newPassword" placeholder="" />
                    <div class="cut cut-short"></div>
                    <label for="newPassword" class="placeholder">NEW PASSWORD</label>
                </div>
                <div class="input-container ic3">
                    <input id="confirmPassword" class="input" type="password" name="confirmPassword" placeholder="" />
                    <div class="cut cut-short"></div>
                    <label for="confirmPassword" class="placeholder">RE-ENTER PASSWORD</label>
                </div>
                <button type="submit" class="submit">SUBMIT</button>
            </form>
        </div>
    </section>
</body>

</html>