<?php
session_start();
if ($_SESSION["logged_in"] != true ) {
    header("Location: login.php");
}
if($_SESSION["maintnence"] == true && $_SESSION["isAdmin"] == false) {
    header("Location: busy.html");
}
include("database.php");
//echo $_SESSION["username"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabrimath home</title>
</head>
<body>
    <link rel="stylesheet" href="style.css">
    <h1 id="welcome">Welcome back!</h1>
    <h2>Welcome to GabriMath! Get ready to practice math!</h2>
    <h3>Recent updates:</h3>
    <h4>Version 2.0.0</h4>
    <h3>Multiplication Practice XP now saves! Check it out!</h3>
    

    <h1></h1>
    <a href="divison/" class="btn">Division practice</a>
    <a href="multiplication/" class="btn">Multiplication practice!</a> <br><br>
    <a href="settings/" class="buttonBlack">Account settings</a><br><br>
    <a href="parents_only.php" class="buttonBlack">Parents only</a><br><br>
    <form action="home.php" method="get"><input type="submit" value="Log off" name="logout" class="buttonBlack"></form>
</body>
<script>
	const username ="<?php echo $_SESSION['username'] ?>";
	console.log(username);
	document.getElementById("welcome").textContent = `welcome, ${username}!`;
</script>
</html>

<?php 
if(isset($_GET["logout"])) {
    $_SESSION["logged_in"] = false;
    $_SESSION["isParent"] = false; $_SESSION["isAdmin"] = false;
    header("Location: login.php");
}
?>
