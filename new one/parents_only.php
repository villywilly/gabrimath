<?php
session_start();
require "database.php";

if (!isset($_SESSION["isParent"]) || $_SESSION["isParent"] != true) {
    header("Location: disallowed.php?e=must be a parent to view that page");
    exit;
}

/* Get student usernames (non-admins) */
$stmt = $conn->prepare("SELECT username FROM uinf WHERE isAdmin = 0");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<title>Gabrimath Parent Page</title>
</head>
<link rel="stylesheet" href="style.css">
<body>

<h1>Students</h1>

<form method="get">
<select name="student">

<option value="">Choose a student</option>

<?php
while ($row = $result->fetch_assoc()) {
    echo "<option value='".$row["username"]."'>".$row["username"]."</option>";
}
?>

</select>

<input type="submit" name="getstats" value="Get statistics">
</form>

<br>
<a href="home.php">Home</a>

<?php
if (isset($_GET["getstats"])) {

    $selected = $_GET["student"];

    $stmt = $conn->prepare(
        "SELECT xp_div, xp_mult FROM uinf WHERE username = ?"
    );

    $stmt->bind_param("s", $selected);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo "<h3>".$selected."'s statistics:</h3>";
        echo "Division XP: ".$row["xp_div"]."<br>";
        echo "Multiplication XP: ".$row["xp_mult"];
    }
}
?>

</body>
</html>
