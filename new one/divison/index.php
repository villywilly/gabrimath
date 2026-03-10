<?php
session_start();
require "../database.php";

$xp = $_SESSION["xpd"] ?? 0;
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION["username"];
$xp = $_SESSION["xpd"];

if (!isset($_SESSION["num1"])) {
    $_SESSION["num1"] = random_int(100,500);
    $_SESSION["num2"] = random_int(50,100);
}

$num1 = $_SESSION["num1"];
$num2 = $_SESSION["num2"];
$real_ans = $num1 / $num2;
$real_ans = round($real_ans);
if (isset($_GET["submit"])) {

    $ans = $_GET["answer"];

    if ($ans == $real_ans) {
        $xp += 500-$real_ans;
    } else {
        $xp -= $real_ans*100;
    }

    $_SESSION["xpd"] = $xp;

    $stmt = $conn->prepare(
        "UPDATE uinf SET xp_mult = ? WHERE username = ?"
    );

    $stmt->bind_param("is", $xp, $user);
    $stmt->execute();

    unset($_SESSION["num1"]);
    unset($_SESSION["num2"]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Division practice!</title>
</head>
<body>
<link rel="stylesheet" href="../style.css">
<h1>Welcome to GabriMath Division practice!</h1>
<h2>Directions:</h2>
<h3>You are given 2 numbers, you must solve the equation and press submit. If you get it right, good job! more xp for you. If you get it wrong, you lose some XP<br>Note: Round all answers to the nearest whole number.</h3>
<br><br>
<h3>What is <?php echo $num1; ?> divided by <?php echo $num2; ?>?</h3>
<form action="index.php" method="GET">
<input name="answer">
<input type="submit" value="Submit" name ="submit">
</form>
<h2>Your XP: <?= $xp ?></h2>
<a href="../home.php" class="buttonBlack">Exit</a>
<script>
function randint(min,max) {
    var randomInt = Math.floor(Math.random() * (max - min + 1)) + min;
    return randomInt;
}

</script>
</body>
</html>
<?php

?>
