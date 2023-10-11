<?php
error_reporting(0);
$conn = oci_connect("username", "password", "connectionString");
$btn = $_POST["button2"];

$isOpen = "0";

if (!$conn) {
$m = oci_error();
echo $m['message'], "\n";
exit;
}
?>