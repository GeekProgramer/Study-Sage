<?php session_start(); 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
$name=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <title>DropDown</title>
    <link rel="stylesheet" href="static/dropdown.css">
</head>

<body>
    <div class="hero">

        <nav>
            <img src="static/sagelogo3.png" class="logo">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="calender.html">CALENDER</a></li>

            </ul>
            <img src="static/reading.png" class="user-pic" onclick="toggleMenu()">

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="uer-info">
                        <img src="static/reading.png">
                        <h2><span> <?php echo $name;?></span></h2>
                    </div>
                    <hr>

                    <a href="profile.html" class="sub-menu-link">
                        <img src="static/profile.png">
                        <p>Edit Profile</p>
                        <span>></span>
                    </a>
                    <a href="faq.html" class="sub-menu-link">
                        <img src="static/help.png">
                        <p>Help</p>
                        <span>></span>
                    </a>
                    <a href="logout.php" class="sub-menu-link">
                        <img src="static/logout.png">
                        <p>Logout</p>
                        <span>></span>
                    </a>
                </div>
            </div>
        </nav>
        <div class="post-it">
            <p class="sticky taped">
                <strong>TO-DO List</strong><br>
                Here you can write<br>
                tasks to be done <br>
                in future<br>

            </p>
            <div class="button-borders">
                <button class="primary-button"><a href="toDo.html"> PROCEED
                    </a></button>
            </div>
        </div>
        <div class="post-it-1">
            <p class="note">
                <strong>UPCOMING TESTS</strong><br>
                So that u can prepare,<br>
                accordingly and study <br>
                Comfortably<br>

            </p>
            <div class="button-borders">
                <button class="primary-button-1"><a href="do.html"> PROCEED
                    </a></button>
            </div>
        </div>

    </div>
    <script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
        subMenu.classList.toggle("open-menu");
    }
    </script>



</body>

</html>