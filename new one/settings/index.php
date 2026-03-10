<?php
session_start();
require "../database.php";

/* Disable account */
if (isset($_POST["del-acc"])) {

    $active = 0;
    $user = $_SESSION["username"];

    $stmt = $conn->prepare(
        "UPDATE uinf SET isActive = ? WHERE username = ?"
    );

    $stmt->bind_param("is", $active, $user);
    $stmt->execute();

    $_SESSION["logged_in"] = false;
    $_SESSION["isParent"] = false;
    $_SESSION["isAdmin"] = false;

    header("Location: ../login.php");
    exit;
}

/* Change password */
if (isset($_POST["submit"])) {

    if ($_POST["pass"] === $_POST["pass2"]) {

        $pass = $_POST["pass"];
        $user = $_SESSION["username"];

        $stmt = $conn->prepare(
            "UPDATE uinf SET paswd = ? WHERE username = ?"
        );

        $stmt->bind_param("ss", $pass, $user);
        $stmt->execute();

        $message = "Password changed successfully!";
    } else {
        $message = "Passwords do not match!";
    }
}
?>

<!doctype html>
<html>
<head>
<title>Gabrimath Settings</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<h1>Gabrimath Settings</h1>

<?php
if (isset($message)) {
    echo "<p>$message</p>";
}
?>

<h2>Change your password</h2>

<form method="post">

<input type="password" name="pass" placeholder="New password">
<br><br>

<input type="password" name="pass2" placeholder="Confirm password">
<br><br>

<input type="submit" name="submit" value="Submit">

</form>

<br><br>

<form method="post">

<button type="submit" name="del-acc" class="scarybtn">
Disable account
</button>

Warning! This will render your account unusable unless an admin re-activates it.

</form>

<br><br>

<a href="../home.php" class="buttonBlack">Go back</a>

</body>
</html>