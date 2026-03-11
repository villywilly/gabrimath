<?php
session_start();
if ($_SESSION["logged_in"] != true ) {
    header("Location: /login.php");
}
if($_SESSION["maintnence"] == true && $_SESSION["isAdmin"] == false) {
    header("Location: /disallowed.php?e=maintnance%20period%20prevents%20non-admins%20from%20visiting%20that%20page");
}
?>
