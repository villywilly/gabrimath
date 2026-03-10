<?php
session_start();
require "../database.php";
$active = 1;
if (isset($_POST["del-acc"])){
$stmt = $conn->prepare(
"UPDATE uinf SET isActive = ? WHERE username = ?"
);
$active = 0;
$user = $_SESSION["username"];
$stmt->bind_param("is", $active, $user);
$stmt->execute();
$_SESSION["logged_in"] = false;
$_SESSION["isParent"] = false; $_SESSION["isAdmin"] = false;
header("Location: ../login.php");
}
?>
<style>
button.scarybtn,
input.scarybtn[type="submit"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: red !important;
    color: white !important;
    border: none !important;
    padding: 12px 18px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
}
button.scarybtn:hover,
input.scarybtn[type="submit"]:hover {
    background-color: #c9302c !important;
}
button.scarybtn:active,
input.scarybtn[type="submit"]:active {
    transform: scale(0.97) !important;
}
</style>

<!doctype html>
<html>
<link rel="stylesheet" href="../style.css">
<head>
<title>Gabrimath Settings</title>
</head>
<body>
<h1>Gabrimath Settings:</h1>
<form action="" method="post">
<button type="submit" name="del-acc" class="scarybtn">Disable account</button> Warning! This will render your account unusable unless you get the admin to re-activate it.
</form>
<a href="../home.php" class="buttonBlack">Go back</a>
<form action="" method="post">
<h2>Change your password:</h2>
<input type="password" name="pass">
<h3>Confirm:</h3>
<input type="password" name="pass2">
<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    if ($_POST["pass"] === $_POST["pass2"])
    { $stmt = $conn->prepare( "UPDATE uinf SET paswd = ? WHERE username = ?" );
        $pass = $_POST["pass2"];
        $user = $_SESSION["username"];
        $stmt->bind_param("is", $pass, $user);
        $stmt->execute();
        echo "Your password has been changed successfully!";

    }else {echo "Passwords do not match!";} } //btw this is part of settings page
