<?php
session_start();
$username=$row["username"];

?>
<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <title>Access Denied</title>
  </head>
  <body>
    <header>
      <h1>Access Denied</h1>
    </header>
    <main></main>
    <footer></footer>
  </body>
</html>

<?php
echo "<h2>You have been blocked from accessing this page because: ";
$e = $_GET["e"];
echo "$e<br>";
echo "You are logged in as:   "; echo "$username</h2>";
echo "<a href='/home.php'>Go home</a>"

?>
