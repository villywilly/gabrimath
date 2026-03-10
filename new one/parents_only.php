<?php
session_start();
if ($_SESSION["isParent"] != true ) {
    header("Location: home.php");
}
include("database.php");
// Get all usernames of students
$stmt = $conn->prepare("SELECT username FROM uinf WHERE isAdmin = 0 AND isActive = 1");
$stmt->execute();
$result = $stmt->get_result();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabrimath Parent page</title>
</head>
<body>
    The parent page of GabriMath is under construction!
   <h1>Students:</h1>
    <form action="" method="get">
    <select name="student" id="students">
	<option value="choose">Choose a student</option>
        <?php
        while ($row = $result->fetch_assoc()) {
            // htmlspecialchars prevents HTML injection
            echo '<option value="' . htmlspecialchars($row["username"]) . '">' . htmlspecialchars($row["username"]) . '</option>';
        }
        ?>
	</select>
   <input type="submit" name="getstats" value="Get statistics">
    </form>
    <a href="home.php">Home</a>
</body>
</html>

<?php
if (isset($_GET["getstats"])) {
echo "<br><h3>Loading.</h3>";
$selected = $_GET["student"];
try{
$sql = "SELECT * FROM uinf WHERE username='$selected'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
echo "<h4>";
echo $selected;
echo "'s statistics:";
echo "<br> Division: "; echo $row["xp_div"];
echo "<br> Multiplication: "; echo $row["xp_mult"];
echo "</h4>";
if (!$row) {
    echo "No stats found for $selected.";
    exit;
}
}
catch(mysqli_sql_exception) {
echo "Database error: ";
echo $e->getMessage();;
die("Database error.");
}
}
?>
