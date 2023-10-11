<!doctype html>
<html>
<head>
    <title>PHP PROJECT</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body style="background-color: #3E7D94C4;">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


<?php

require_once 'connectDB.php';

$login = $_POST['login'];
$password = $_POST['password'];
$lp = $login." ".$password;

$query = "select login,password from users where login like'".$login."' and password like '".$password."'";
$stid = oci_parse($GLOBALS['conn'], $query);
oci_execute($stid);

while (($row = oci_fetch_row($stid)) != false) {
foreach($row as $field => $value){

        header("Location: main.php");
    }
}
require_once "home.php";
echo "<br><center><p style='color:#be0808;'>Błędny login lub hasło</p><center>";

oci_free_statement($stid);

?>


</body>
</html>


