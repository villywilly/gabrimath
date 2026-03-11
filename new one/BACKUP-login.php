<?php
    $is_online = 0;
    session_start()
?>





<!---->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to GabriMath!</title>
</head>
<body>
    <h1>Welcome to GabriMath!</h1>
    <h2 id="err"></h2>
    <h2>Please login </h2>
    <form action="login.php" method="post">
        <h3>Username</h3>
        <input type="text" name="username"> <br>
        <h3>Password</h3>
        <input type="password" name="password"> <br>
        <input type="submit" name="login" value="Login"> <br>
    </form>
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
</script>
</html>
<?php
    $_SESSION["maintnence"] = false; // Toggle true to set maintnence mode
    $user1 = "admin"; //idc that thats not how u spell mautnacnes but who cares bc nobody can see ts unless u hacker my computer
    $password1 = "8772";
    $parent_account_user = "Jamye124";
    $password2 = "1709";
    $gabriel = "Gabriel159";
    $gpass = "gb61";
    $_SESSION["isParent"] = false;
    $_SESSION["isAdmin"] = false;
    if (isset($_POST["login"])) {
        if((!empty($_POST["username"])) && (!empty($_POST["password"]))) {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];
            if (($_SESSION["username"] == $user1) && $_SESSION["password"] == $password1) {
                echo "Successful login!";
                $_SESSION["logged_in"] = true;
                $_SESSION["isParent"] = true;
                $_SESSION["isAdmin"] = true;
                header("Location: home.php");
            }
            else if (($_SESSION["username"] == $gabriel) && $_SESSION["password"] == $gpass) {
                $_SESSION["logged_in"] = true;
                header("Location: home.php");
            }
            else if (($_SESSION["username"] == $parent_account_user) && $_SESSION["password"] == $password2) {
                $_SESSION["logged_in"] = true;
                $_SESSION["isParent"] = true;
                header("Location: parents_only.php");
            }
            else {
                echo "Invalid username or password!";
                header("Refresh: 1");
            }
        }
        else {
            echo "please fill in all boxes";
            header("Refresh: 1");
        }
    }
?>