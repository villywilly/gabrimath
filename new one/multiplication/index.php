<?php
session_start();
require "../database.php";

$xp = $_SESSION["xp"] ?? 0;
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != true) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION["username"];
$xp = $_SESSION["xp"];

if (!isset($_SESSION["num1"])) {
    $_SESSION["num1"] = random_int(1,12);
    $_SESSION["num2"] = random_int(1,12);
}

$num1 = $_SESSION["num1"];
$num2 = $_SESSION["num2"];
$real_ans = $num1 * $num2;

if (isset($_GET["submit"])) {

    $ans = $_GET["answer"];

    if ($ans == $real_ans) {
        $xp += $real_ans;
    } else {
        $xp -= $real_ans / 2;
    }

    $_SESSION["xp"] = $xp;

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
    <title>Multiplication practice!</title>
</head>
<body>
    <link rel="stylesheet" href="../style.css">
    <h1>Welcome to GabriMath Multiplication practice!</h1>
    <h2>Directions:</h2>
    <h3>You are given 2 numbers, you must solve the equation and press submit. If you get it right, good job! more xp for you. If you get it wrong, you lose some XP</h3>
    <br><br>
    <h3>What is <?php echo $num1; ?> times <?php echo $num2; ?>?</h3>
    <form action="index.php" method="GET">
        <input name="answer">
        <input type="submit" value="Submit" name ="submit"> 
    </form>
<h2>Your XP: <?= $xp ?></h2>
    <a href="../home.php" class="buttonBlack">Exit</a>
    <script>
        //let isCorrect;
        //let num1;
        //let num2;
        //let ans;
        //let uAns;
//        let xp = Number("<?= $xp ?>");
//        document.getElementById('pointsVal').textContent = xp;
        //const formData = new FormData();
        function randint(min,max) {
            var randomInt = Math.floor(Math.random() * (max - min + 1)) + min;
            return randomInt;
        }
        //const button = document.getElementById('start');
        //button.addEventListener('click',function() {
        //    num1 = randint(1,12);
        //    num2 = randint(1,12);
        //    ans = num1 * num2;
        //    uAns = Number(window.prompt(`Solve ${num1} times ${num2}`));
        //    if (ans === uAns) {
        //        xp += Number(ans)
        //        window.alert(`Correct! You got ${ans} XP!`);
        //    }
        //    else {
        //        xp -= Number(ans)/2;
        //        window.alert(`Sorry! The answer was ${ans}, you lost ${ans/2} XP.`);
        //    }
        //    document.getElementById('pointsVal').textContent = xp;
        //    console.log(xp);
        //    post();
        //})
    </script>
</body>
</html>
<?php 

?>
