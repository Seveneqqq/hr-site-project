<!doctype html>
<html>
<head>
<title>PHP PROJECT</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body style="background-color: rgba(106, 252, 3, 0.773);">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<div id="buttons">
<form method="post">
<input type="submit" value="SELECT" name="button2" class="btn btn-primary" style="display:block"> 
<input type="submit" value="SELECT" name="button3" class="btn btn-primary" style="display:block">
<input type="submit" value="INSERT" name="button4" class="btn btn-primary" style="display:block">
<input type="submit" value="UPDATE" name="button5" class="btn btn-primary" style="display:block">
</form>
</div>

<div id="leftSection">
<?php



error_reporting(0);
$conn = oci_connect("msbd2", "pawcio2001", "155.158.112.45:1521/oltpstud");
$btn = $_POST["button2"];

$isOpen = "0";



if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
    }

   
if(isset($btn)){
 
    
    $sql = 'SELECT ,first_name,last_name FROM employees';
    $stid = oci_parse($GLOBALS['conn'], $sql);
    oci_execute($stid);
    
    echo '<div id="phpField" class="Fields"';

    while (($row = oci_fetch_row($stid)) != false) {
    foreach($row as $field => $value){
        echo $value." ";
    }
    echo "<br>";
    }

    echo "</div>";

    oci_free_statement($stid);
    oci_close($GLOBALS['conn']);
    
    

}  
  



?>
</div>

</body>
</html>