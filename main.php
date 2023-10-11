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

<div id="all">
<div id="navbar">

            <a href='main.php?fun1=true' class="ahr" ><div class="options"><br><img src="svg/listaprac.svg" width="35%"><br><p class="par">LISTA PRACOWNIKÓW</p></div></a>
            <a href='main.php?fun3=true' class="ahr" ><div class="options"><br><img src="svg/edytujdaneprac.svg" width="35%"><br><p class="par">EDYTUJ PRACOWNIKA</p></div></a>
            <a href='main.php?fun2=true' class="ahr" ><div class="options"><br><img src="svg/dodajprac.svg" width="35%"><br><p class="par">DODAJ PRACOWNIKA</p></div></a>
            <a href='main.php?fun4=true' class="ahr" ><div class="options"><br><img src="svg/usunprac.svg" width="35%"><br><p class="par">USUŃ PRACOWNIKA</p></div></a>
            <a href='main.php?fun5=true' class="ahr" ><div class="options"><br><img src="svg/dodajadmina.svg" width="35%"><br><p class="par">ZAREJESTRUJ UŻYTKOWNIKA STRONY</p></div></a>

</div>
<div id="content">



    <?php

    require_once 'connectDB.php';



    function listaPracownikow() {

        $tabID = tablicaId();
        echo "<h3>Lista pracowników</h3><form  method='POST'>";
        $sql = 'SELECT first_name,last_name,phone_number FROM employees';
        $stid = oci_parse($GLOBALS['conn'], $sql);
        oci_execute($stid);
        $i = 0;
        echo '<div id="phpField" class="Fields"><table>';
        echo '<tr><td class="nameCell">SELECT</td><td class="nameCell">NAME</td><td class="nameCell">LAST NAME</td><td class="nameCell">PHONE NUMBER</td></tr>';
        while (($row = oci_fetch_row($stid)) != false) {

            echo "<tr><td><input type='radio' option='$tabID[$i]' value='$tabID[$i]' name='wyborWiersza'></td>";
            $i++;
            foreach($row as $field => $value){
                echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }

        echo "</table></div><br><br><input type='submit' name='tableSend' id='wyslij' value='Wyświetl' class='btn btn-primary'>";
        echo "</form>";
        oci_free_statement($stid);

        if(isset($_POST['tableSend']) && $_POST['wyborWiersza']){


            echo "
        <script>
        document.getElementById('content').innerHTML = '';
        </script>";
            $tab = array('FIRST NAME','LAST NAME','EMAIL','PHONE NUMBER','HIRE DATE','SALARY');
            $iterator=0;
            $id = $_POST['wyborWiersza'];
            $sql = "SELECT first_name,last_name,email,phone_number,hire_date,salary FROM employees where employee_id = '$id'";
            $stid = oci_parse($GLOBALS['conn'], $sql);
            oci_execute($stid);
            echo "<img src='svg/avatar.svg' width='40%' height='40%' id='avatar'>";
            echo "<table class='employeesTable'>";
            while (($row = oci_fetch_row($stid)) != false) {

                foreach($row as $field => $value){

                    echo "<tr></tr><td class='employeeTab'><br>".$tab[$iterator]."</td>";
                    $iterator++;
                    echo "<td><br>".$value."</td></tr>";
                }

            }
            echo "</table>";

            oci_free_statement($stid);
        }


    }
    function dodajPracownika() {
   //
       $tabID = tablicaId();
        //echo "::::".$x[1];
     //
    echo "
    <form method='POST'>
    <table id='tab1'>
    <tr>
    <td class='tabtd'><br>First name :</td><td style='padding:0px' class='tabtd'><br><input type='text' name='first_name'></td>
    </tr>
    <tr>
    <td class='tabtd'><br>Last name :</td><td style='padding:0px' class='tabtd'><br><input type='text' name='last_name'></td>
    </tr>
    <tr>
    <td class='tabtd'><br>Email :</td><td style='padding:0px' class='tabtd'><br><input type='text' name='mail'></td>
    </tr>
    <tr>
    <td class='tabtd'><br>Phone number :</td><td style='padding:0px' class='tabtd'><br><input type='tel' name='phone_number'></td>
    </tr>
    <tr>
    <td class='tabtd'><br>Salary :</td><td style='padding:0px' class='tabtd'><br><input type='text' name='salary'></td>
    </tr>
    <tr>
    <td class='tabtd'><br>Hire date :</td><td style='padding:0px' class='tabtd'><br><input type='date' id='data' name='hire_date'></td>
    </tr>
    </table>
    
    <br><input type='submit' name='addpracc' value='Dodaj' class='btn btn-primary' id='wyslij'></form>
    
    
    ";

        if(isset($_POST['addpracc']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['mail']) && !empty($_POST['phone_number']) && !empty($_POST['salary']) && !empty($_POST['hire_date'])){

            $id = zwrocId();
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $mail = $_POST['mail'];
            $phoneNumber = $_POST['phone_number'];
            $salary =  $_POST['salary'];
            $hireDate = $_POST['hire_date'];
                



            $sql = "insert into employees (EMPLOYEE_ID,FIRST_NAME,LAST_NAME,EMAIL,PHONE_NUMBER,HIRE_DATE,JOB_ID,SALARY,COMMISSION_PCT,DEPARTMENT_ID) values ('$id','$fname','$lname','$mail','$phoneNumber',to_date('$hireDate','YYYY-MM-DD'),'AD_PRES','$salary',null,'90')";

            $stid = oci_parse($GLOBALS['conn'], $sql);
            if(oci_execute($stid)){

                echo "<p style='text-align:center;margin-top:14px;'>Dodano :)</p>";
            }
            else{
                echo "<p style='text-align:center;margin-top:14px;'>Nie udało się :(</p>";
            }


            oci_free_statement($stid);
        }
    }


    function zwrocId()
    {

        $sql = 'select max(employee_id) from employees';
        $stid = oci_parse($GLOBALS['conn'], $sql);
        oci_execute($stid);

        while (($row = oci_fetch_row($stid)) != false) {
            foreach ($row as $field => $value) {
                $x = $value;
            }

            $x++;
            return $x;
            oci_free_statement($stid);

        }
    }
    function tablicaId(){

        $sql = 'select employee_id from employees';
        $stid = oci_parse($GLOBALS['conn'], $sql);
        oci_execute($stid);
        $i=0;
        $array = [];
        while (($row = oci_fetch_row($stid)) != false) {
            foreach ($row as $field => $value) {
                $array[$i] = $value;
                $i++;

            }
        }
            oci_free_statement($stid);
            return $array;

    }

    function edytujPracownika() {
        $tabID = tablicaId();
        echo "<h3>Edytuj pracownika</h3><form  method='POST'>";
        $sql = 'SELECT first_name,last_name,phone_number FROM employees';
        $stid = oci_parse($GLOBALS['conn'], $sql);
        oci_execute($stid);
        $i = 0;
        echo '<div id="phpField" class="Fields"><table>';
        echo '<tr><td class="nameCell">SELECT</td><td class="nameCell">NAME</td><td class="nameCell">LAST NAME</td><td class="nameCell">PHONE NUMBER</td></tr>';
        while (($row = oci_fetch_row($stid)) != false) {

            echo "<tr><td><input type='radio' option='$tabID[$i]' value='$tabID[$i]' name='wyborWiersza'></td>";
            $i++;
            foreach($row as $field => $value){
                echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }

        echo "</table></div><br><br><input type='submit' name='tableSend2' id='wyslij' value='Edytuj' class='btn btn-primary'>";
        echo "</form>";
        oci_free_statement($stid);
//////////////////////////////////////////////////////////////////////////////////////////////////////// pierwsza ^

        if(isset($_POST['tableSend2'])){
            echo "
        <script>
        document.getElementById('content').innerHTML = '';
        </script>
        ";


        $tab = array('EMPLOYEE ID','FIRST NAME','LAST NAME','EMAIL','PHONE NUMBER','HIRE DATE','SALARY');
        $tab2 = array('employee_id','first_name','last_name','email','phone_number','hire_date','salary');
        $iterator=0;



            $id = $_POST['wyborWiersza'];
            $GLOBALS['a']=$id;
        $sql = "SELECT employee_id,first_name,last_name,email,phone_number,hire_date,salary FROM employees where employee_id = '$id'";
        $stid = oci_parse($GLOBALS['conn'], $sql);
        oci_execute($stid);

/// /////////////////////////////////////////////////////////////////////////////////////////////////////druga v
///
        echo "<form method='POST'><table class='tab2'>";
        while (($row = oci_fetch_row($stid)) != false) {

            foreach($row as $field => $value){

                echo "<tr class='bcd'><td class='abc'><br>$tab[$iterator]</td><td class='employeeTab'><br><input type='text' value='$value' id='$tab2[$iterator]' name='$tab2[$iterator]'></td>";
                echo "<td><br>".$value."</td></tr>";
                $iterator++;


            }

        }//$tab2 = array('first_name','last_name','email','phone_number','hire_date','salary');

        oci_free_statement($stid);
        echo "</table><br><input type='submit' name='csa' id='wyslij' class='btn btn-primary'></form>";


        }
        if(isset($_POST['csa'])){



            $id2=$_POST['employee_id'];

            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $hire_date = $_POST['hire_date'];
            $salary = $_POST['salary'];
            $sql="update employees set first_name='$fname',last_name='$lname',email='$email',phone_number='$phone_number',salary=$salary where employee_id='$id2'";
            $stid = oci_parse($GLOBALS['conn'], $sql);
            oci_execute($stid);
            oci_commit($GLOBALS['conn']);

        }

    }
    function  usunPracownika() {
        $tabID = tablicaId();
        echo "<h3>Usuń pracownika</h3><form  method='POST'>";
        $sql = 'SELECT first_name,last_name,phone_number FROM employees';
        $stid = oci_parse($GLOBALS['conn'], $sql);
        oci_execute($stid);
        $i = 0;
        echo '<div id="phpField" class="Fields"><table>';
        echo '<tr><td class="nameCell">SELECT</td><td class="nameCell">NAME</td><td class="nameCell">LAST NAME</td><td class="nameCell">PHONE NUMBER</td></tr>';
        while (($row = oci_fetch_row($stid)) != false) {

            echo "<tr><td><input type='radio' option='$tabID[$i]' value='$tabID[$i]' name='wyborWiersza'></td>";
            $i++;
            foreach($row as $field => $value){
                echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }

        echo "</table></div><br><br><input type='submit' name='tableSend' id='wyslij' value='Usuń' class='btn btn-primary'>";
        echo "</form>";
        oci_free_statement($stid);



        $id = $_POST['wyborWiersza'];
        $sql = "delete from employees where employee_id = '$id'";
        $stid = oci_parse($GLOBALS['conn'], $sql);



        if(oci_execute($stid) && isset($_POST['tableSend'])){

            echo "<p style='text-align:center;margin-top:15px;'>Usunięto pracownika :)<br>Odśwież stronę</p>";
        }
        else{
            if(isset($_POST['tableSend']))
            echo "<p style='text-align:center;margin-top:14px;'>Nie udało się, lub pracownik już nie istnieje :(</p>";
        }


        oci_free_statement($stid);

    }
    function zarejestrujUzytkownikaKontent() {

        echo "<h3>Zarejestruj użytkownika</h3>
        <form method='post'>
        <div id='formularz' class='rejestracja'>
        <p style='margin-bottom: 0px;'>LOGIN :</p>
        <input type='text' class='rejestracja' name='login2'>
        <p style='margin-bottom: 0px;'>PASSWORD :</p>
        <input type='password' class='rejestracja' name='password2'>
        </div>
        <br>
        <input type='submit' id='wyslij' class='btn btn-primary' name='confirm' value='Zarejestruj'>
        </form>
        ";

        if(isset($_POST['confirm']) && $_POST['login2']!='' && $_POST['password2']!=''){

            $login = $_POST['login2'];
            $password = $_POST['password2'];

            $query = "insert into users (login, password) values ('$login','$password')";



            $stid = oci_parse($GLOBALS['conn'], $query);
            if(oci_execute($stid)){
                echo "<p style='text-align:center;margin-top:20px;'>Zatwierdzono nowego użytkownika ;) </p>";
            }
            else{
                echo "<p style='text-align:center;color:red;margin-top:20px;'>Błąd, spróbuj ponownie !!!</p>";
            }
            oci_free_statement($stid);
        }
    }

    //------------------------------------------------------

    if (isset($_GET['fun1'])) {
        listaPracownikow();
    }
    if (isset($_GET['fun2'])) {
       dodajPracownika();
    }
    if (isset($_GET['fun3'])) {
        edytujPracownika();
    }
    if (isset($_GET['fun4'])) {
        usunPracownika();
    }
    if (isset($_GET['fun5'])) {
        zarejestrujUzytkownikaKontent();
    }

    oci_close($GLOBALS['conn']);
    ?>



</div>
</div>





</body>
</html>


