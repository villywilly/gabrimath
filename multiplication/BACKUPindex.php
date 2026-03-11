<?php
session_start();
require "../database.php";
if ($_SESSION['logged_in'] != true) {
    header("Location: login.php");
}


$xp = $_SESSION["xp"];


    //$user = $_SESSION["username"];
    //$xp = filter_input(INPUT_POST, 'xp', FILTER_VALIDATE_INT);
    //if ($xp === false) {
    //    exit("Invalid XP value.");
    //}
    //echo ($xp);
    //$sql = "UPDATE `uinf` SET `xp_mult` = '$xp' WHERE `uinf`.`username` = '$user'";
    //mysqli_query($conn, $sql);


$raw = file_get_contents("php://input");
$input = json_decode($raw, true);
$xp = $input["xp"] ?? 0;
$user = $_SESSION["username"];
$xp = (int)$xp;
$stmt = $conn->prepare("UPDATE uinf SET xp_mult = ? WHERE username = ?");
$stmt->bind_param("is", $xp, $user);

if (!$stmt->execute()) {
    die("Database error: " . $stmt->error);
    echo("Database error.");
}




header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication practice!</title>
</head>
<body>
    <link rel="stylesheet" href="style.css">
    <h1>Welcome to GabriMath Multiplication practice!</h1>
    <h2>Directions:</h2>
    <h3>When you are ready to solve some math problems, press the "Start!" button. You will be given a multiplication to solve. If you get it right, you gain XP! If you get it wrong, you lose XP.</h3>
    <h3>Whenever you are ready, just press start to begin!</h3>
    <br><br>
    <button id="start" class="btn">Start!</button>
    <h2>Your XP:</h2>
    <h2 id="pointsVal">0</h2>
    <a href="../home.php" class="buttonBlack">Exit</a>
    <script>
        let isCorrect;
        let num1;
        let num2;
        let ans;
        let uAns;
        let xp = Number("<?= $xp ?>");
        document.getElementById('pointsVal').textContent = xp;
        const formData = new FormData();
        function randint(min,max) {
            var randomInt = Math.floor(Math.random() * (max - min + 1)) + min;
            return randomInt;
        }
        function post() {
            fetch("http://192.168.12.160/gabrimath/multiplication/index.php", {
            method: "POST",
            credentials: "include",
            headers: {
                    "Content-Type": "application/json"
                },
            body: JSON.stringify({ xp })
            })
            .then(res => res.text())
            .then(data => console.log(data))
            .catch(err => console.error(err));
        }
        const button = document.getElementById('start');
        button.addEventListener('click',function() {
            num1 = randint(1,12);
            num2 = randint(1,12);
            ans = num1 * num2;
            uAns = Number(window.prompt(`Solve ${num1} times ${num2}`));
            if (ans === uAns) {
                xp += Number(ans)
                window.alert(`Correct! You got ${ans} XP!`);
            }
            else {
                xp -= Number(ans)/2;
                window.alert(`Sorry! The answer was ${ans}, you lost ${ans/2} XP.`);
            }
            document.getElementById('pointsVal').textContent = xp;
            console.log(xp);
            post();
        })
    </script>
</body>
</html>
<?php 

?>