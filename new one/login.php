<?php
    $is_online = 0;
    session_start();
    include("database.php");
?>





<!---->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GabriMath!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to GabriMath!</h1>
    <h2 id="err"></h2>
    <h2>Please login </h2>
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username"> <br>====================<br>
        <input type="password" name="password" placeholder="Password"> <br><br>
        <input type="submit" name="login" value="Login"> | 
	<input type="submit" name="guest" value="Sign in as guest"> <br>
    </form>
    <a href="reg_user.php">Register your account here.</a>
</body>
<script>
    let isonline = "<?=  $is_online ?>";
    //window.alert(null);
    console.log(isonline);
    if (isonline === 0) {
        console.log(null);
    }
    else if (isonline != 0) {
        document.getElementById("err").textContent = "Warning! Failed to connect to server.";
        console.log("failed to connect to server.");
    }
    for (let i = 0; i <= 10; i++) {
        console.log(i); 
    }
</script>
</html>
<?php
    $_SESSION["maintnence"] = false; // Toggle true to set maintnance mode
    $_SESSION["isParent"] = false;
    $_SESSION["isAdmin"] = false;
    if (isset($_POST["login"])) {
        if((!empty($_POST["username"])) && (!empty($_POST["password"]))) {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            $user = $_SESSION["username"];
            $pass = $_SESSION["password"];
        $sql = "SELECT * FROM uinf WHERE username='$user' AND paswd='$pass'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        //echo ($result);
        if ($result->num_rows>0) {
            if ($row["isActive"] == 1) {
                $_SESSION["logged_in"] = true;
                if ($row["isAdmin"] ==1 ) {
                    $_SESSION["isAdmin"] = true;
                    $_SESSION["isParent"] = true;
                }
                if ($row["isParent"] == 1) {
                    $_SESSION["isParent"] = true;
                }
                echo ("<br>successfully logged in!");
                $_SESSION["xp"] = $row["xp_mult"];
                header("Location: home.php");
            }
            else {
                echo ("<br>This account is disabled. Contact customer support for help.");
            }
        }
        else {
            echo ("<br>Invalid username or password.");
        }  
        }
        else {
            echo ("<br>Please fill out all fields");
        }
    
    }
if (isset($_POST["guest"])) {
	$_SESSION["username"] = "guest";
	$_SESSION["password"] = "guest";
	$_SESSION["logged_in"] = true;
	header("Location: home.php");
	$_SESSION["xp"] = 0;
	
}
?>
