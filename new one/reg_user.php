<?php 
include ("database.php");
?>
<link rel="stylesheet" href="style.css">


    <h2>Register your account</h2>
    <form action="reg_user.php" method="get">
        <input type="text" name="username" placeholder="Username"> <br>====================<br>
        <input type="password" name="password" placeholder="Password"> <br>====================<br>
        <input type="text" name="age" placeholder="Your age"><br>====================<br>
        <input type="submit" name="login" value="Register"> <br>
        <a href="login.php">Log in here.</a><br>
    </form>



<?php 
if (isset($_GET["login"])) {
    $username = $_GET["username"];
    $password = $_GET["password"];
    $iParent = 0;
    if ($_GET["age"] >= 18) {
        $iParent = 1;
    }
    $sql = "INSERT INTO uinf (username, paswd, xp_div, xp_mult, isAdmin, isParent,isActive)
    VALUES ('$username', '$password', 0, 0, 0, '$iParent',1)";
    try {
        mysqli_query($conn, $sql);
        echo "Successfully registered! Please go to login page to sign in.";
    }
    catch (mysqli_sql_exception) {
        echo "Failed to register user! This most often occurs if you did not fill out all the forms or if the username is taken. <br>Please try again. If it still doesnt work, contact customer support.";
    }
}
?>
