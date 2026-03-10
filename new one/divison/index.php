<?php 
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Division practice!</title>
</head>
<body>
    <link rel="stylesheet" href="/style.css">
    <h1>Welcome to GabriMath Division practice!</h1>
    <h2>Directions:</h2>
    <h3>When you are ready to solve some math problems, press the "Start!" button. You will be given a long division problem to solve. If you get it right, you gain XP! If you get it wrong, you lose XP.</h3>
    <h3>Whenever you are ready, just press start to begin!</h3>
    <br><br>
    <button id="start" class="btn">Start!</button>
    <h2>Your XP:</h2>
    <h2 id="pointsVal">0</h2>
    <a href="http://192.168.12.160/gabrimath/home.php" class="buttonBlack">Exit</a>
    <script>
        let isCorrect;
        let num1;
        let num2;
        let ans;
        let uAns;
        let xp = 0;
        const formData = new FormData();
        function randint(min,max) {
            var randomInt = Math.floor(Math.random() * (max - min + 1)) + 1;
            return randomInt;
        }
        function post() {
            formdata.append("ansRight", "isCorrect");
            formdata.append("xp","xp");
            fetch("http://192.168.12.160/gabrimath/divison", {
                method: "POST",
                body: formData
            });
        }
        const button = document.getElementById('start');
        button.addEventListener('click',function() {
            num1 = randint(100,999);
            num2 = randint(10,99);
            ans = Math.floor(num1 / num2);
            uAns = Math.floor(Number(window.prompt(`Que es ${num1} divided by ${num2}. ROUND TO THE NEAREST WHOLE NUMBER DOWN!!!!!!`)));
            if (ans === uAns) {
                xp += 999-ans
                window.alert(`Correct! You got ${999-ans} XP!`);
            }
            else {
                xp -= ans*20;
                window.alert(`Sorry! The answer was ${ans}, you lost ${ans*20} XP.`);
            }
            document.getElementById('pointsVal').textContent = xp;
        })
    </script>
</body>
</html>