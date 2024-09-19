<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <link rel="stylesheet" href="styl.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szpital</title>
</head>
<body>
<div id="main">
        <?php
            session_start();
            if(isset($_SESSION['logged'])){
                if($_SESSION['logged']=='niezalogowany'){
                    header("Location: login.php");
                }else{
                    echo "<h1>Witaj na stronie: ".$_SESSION['nazwa']."</h1>";
                }
            }else{
                header("Location: login.php");
            }
        ?>
    </div>
    <div id="menu_nav">
        <a href="index.php" id='toleft'>Sprzęt szpitalu</a>
        <a href="alert.php" id='toleft'>Zgłoś awarię</a>
        <a href="edit.php" id='toleft'>Edycja sprzętu</a>
        <a href="add2.php" id='toleft'>Zarządzanie zdarzeniami</a>
        <a href="manage.php" id='toleft'>Zarządzanie słownikami</a>
        <a href="login.php" id='toright'>Logowanie</a>
    </div>
    <div id="rest">
        <?php
        $polacz=mysqli_connect("localhost","root","","sprzęt medyczny");
        mysqli_set_charset($polacz, "utf8");
        ?>
        <div id="leftsmall">
            <div id='karta'>
            <h2>Dodawanie</h2><h3>
            <form action="" method="post">
            <h3>Nazwa urządzenia: <br>
            <input type="text" name="urzadzenie"><br>
            <input type="submit" name="dodU" value="Dodaj urządzenie"></p>
            <?php
            if(isset($_POST["dodU"])){
                $a=$_POST["urzadzenie"];
                if($a!=""){
                    $q="SELECT nazwa FROM `urządzenie` WHERE nazwa='$a'";
                    $r=mysqli_query($polacz,$q);
                    $z="";
                    while($wyn=mysqli_fetch_row($r)){
                        $z=$wyn[0];
                    }
                    if($z!=$a){
                        if(strlen($a)>30){
                            echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                        }else{
                        $q="INSERT INTO urządzenie VALUES ('$a')";
                        $r=mysqli_query($polacz,$q);
                        }
                    }else{
                        echo "<h3 id='blad'>Już istnieje takie urządzenie</h3>";
                    }


                }else{
                    echo "<h3 id='blad'>Pole urządzenia nie może być puste</h3>";
                }
            }
            ?>
            <p>Nazwa producenta: <br>
            <input type="text" name="producent"><br>
            <input type="submit" name="dodP" value="Dodaj producenta"></p>
            <?php
            if(isset($_POST["dodP"])){
                $a=$_POST["producent"];
                if($a!=""){
                    $q="SELECT nazwa FROM `producent` WHERE nazwa='$a'";
                    $r=mysqli_query($polacz,$q);
                    $z="";
                    while($wyn=mysqli_fetch_row($r)){
                        $z=$wyn[0];
                    }
                    if($z!=$a){
                    if(strlen($a)>30){
                        echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                    }else{
                    $q="INSERT INTO producent VALUES ('$a')";
                    $r=mysqli_query($polacz,$q);
                    }
                    }else{
                        echo "<h3 id='blad'>Już istnieje taki producent</h3>";
                    }
                    
                }else{
                    echo "<h3 id='blad'>Pole producenta nie może być puste</h3>";
                }
            }
            ?>
            <p>Nazwa dostawcy: <br>
            <input type="text" name="dostawcaN"></p>
            <p>Adres dostawcy: <br>
            <input type="text" name="dostawcaA"></p>
            <p>Telefon dostawcy: <br>
            <input type="number" maxlenght="9" name="dostawcaT"></p>
            <p>Email dostawcy: <br>
            <input type="text" name="dostawcaE"><br>
            <input type="submit" name="dodD" value="Dodaj dostawce"></p>
            <?php
            if(isset($_POST["dodD"])){
                $a=$_POST["dostawcaN"];
                $b=$_POST["dostawcaA"];
                $c=$_POST["dostawcaT"];
                $d=$_POST["dostawcaE"];
                if($a=="" || $b=="" || $c=="" || $d==""){
                    echo "<h3 id='blad'>Pole dostawcy nie może być puste</h3>";
                }else{
                    if(strlen($c)>9 || strlen($c)<9){
                        echo "<h3 id='blad'>Numer telefonu jest nie odpowiedni</h3>";
                    }else{
                    $e=$a."*".$b."*".$c."*".$d;
                    $q="SELECT `nazwa, adres, telefon, email` FROM `dostawca` WHERE `nazwa, adres, telefon, email`='$e'";
                    $r=mysqli_query($polacz,$q);
                    $z="";
                    while($wyn=mysqli_fetch_row($r)){
                        $z=$wyn[0];
                    }
                    if($z!=$e){
                    if(strlen($a)>30 || strlen($b)>30 || strlen($d)>30){
                        echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                    }else{
                    $q="INSERT INTO dostawca VALUES ('$e')";
                    $r=mysqli_query($polacz,$q);
                    }
                    }else{
                        echo "<h3 id='blad'>Już istnieje taki dostawca</h3>";
                    }
                    }
                }
            }
            ?>
            <p>Nazwa lokalizacji: <br>
            <input type="text" name="lokalizacja"><br>
            <input type="submit" name="dodL" value="Dodaj lokalizacje"></p>
            <?php
            if(isset($_POST["dodL"])){
                $a=$_POST["lokalizacja"];
                if($a!=""){
                    $q="SELECT nazwa FROM `lokalizacja` WHERE nazwa='$a'";
                    $r=mysqli_query($polacz,$q);
                    $z="";
                    while($wyn=mysqli_fetch_row($r)){
                        $z=$wyn[0];
                    }
                    if($z!=$a){
                    if(strlen($a)>30){
                        echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                    }else{
                    $q="INSERT INTO lokalizacja VALUES ('$a')";
                    $r=mysqli_query($polacz,$q);
                    }
                    }else{
                        echo "<h3 id='blad'>Już istnieje taka lokalizacja</h3>";
                    }
                    
                }else{
                    echo "<h3 id='blad'>Pole lokalizacji nie może być puste</h3>";
                }
            }
            ?>
            <p>Nazwa statusu: <br>
            <input type="text" name="status"><br>
            <input type="submit" name="dodS" value="Dodaj status"></p>
            <?php
            if(isset($_POST["dodS"])){
                $a=$_POST["status"];
                if($a!=""){
                    $q="SELECT nazwa FROM `status` WHERE nazwa='$a'";
                    $r=mysqli_query($polacz,$q);
                    $z="";
                    while($wyn=mysqli_fetch_row($r)){
                        $z=$wyn[0];
                    }
                    if($z!=$a){
                        if(strlen($a)>30){
                            echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                        }else{
                    $q="INSERT INTO status VALUES ('$a')";
                    $r=mysqli_query($polacz,$q);
                        }
                    }else{
                        echo "<h3 id='blad'>Już istnieje taki status</h3>";
                    }
                    
                }else{
                    echo "<h3 id='blad'>Pole statusu nie może być puste</h3>";
                }
            }
            ?>
            <p>Login użytkownika: <br>
            <input type="text" name="uzytkownikL"></p>
            <p>Hasło użytkownika: <br>
            <input type="text" name="uzytkownikH"></p>
            <p>Grupa użytkowników: <br>
            <input type="text" name="uzytkownikG"></p>
            <p>Email użytkownika: <br>
            <input type="text" name="uzytkownikE"></p>
            <p>Lokalizacja użytkownika: <br>
            <input type="text" name="uzytkownikL"><br>
            <input type="submit" name="dodU2" value="Dodaj użytkownika"></p>
            <?php
            if(isset($_POST["dodU2"])){
                $a=$_POST["uzytkownikL"];
                $b=$_POST["uzytkownikH"];
                $c=$_POST["uzytkownikG"];
                $d=$_POST["uzytkownikE"];
                $e=$_POST["uzytkownikL"];
                if($a=="" || $b=="" || $c=="" || $d=="" || $e==""){
                    echo "<h3 id='blad'>Pole użytkownika nie może być puste</h3>";
                }else{
                    $q="SELECT * FROM `użytkownik` WHERE `login`='$a' AND `hasło`='$b'";
                    $r=mysqli_query($polacz,$q);
                    $z="";
                    while($wyn=mysqli_fetch_row($r)){
                        $z=$wyn[0];
                    }
                    if($z!=$f){
                        if(strlen($a)>30 || strlen($b)>30 || strlen($c)>30 || strlen($d)>30 || strlen($e)>30 ){
                            echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                        }else{
                    $q="INSERT INTO użytkownik(`login`, `hasło`, `grupa użytkowników`, `email`, `lokalizacja`, `czyAdmin`) VALUES ('$A','$b','$c','$d','$e',0)";
                    $r=mysqli_query($polacz,$q);
                        }
                    }else{
                        echo "<h3 id='blad'>Już istnieje taki użytkowniki</h3>";
                    }
                }
            }
            ?>
            <p>Nazwa zdarzenia: <br>
            <input type="text" name="zdarzenie"><br>
            <input type="submit" name="dodZ" value="Dodaj zdarzenie"></p>
            <?php
            if(isset($_POST["dodZ"])){
                $a=$_POST["zdarzenie"];
                if($a!=""){
                    $q="SELECT nazwa FROM `zdarzenie` WHERE nazwa='$a'";
                    $r=mysqli_query($polacz,$q);
                    $z="";
                    while($wyn=mysqli_fetch_row($r)){
                        $z=$wyn[0];
                    }
                    if($z!=$a){
                        if(strlen($a)>30){
                            echo "<h3 id='blad'>Nazwa jest za dług</h3>";
                        }else{
                    $q="INSERT INTO zdarzenie VALUES ('$a')";
                    $r=mysqli_query($polacz,$q);
                        }
                    }else{
                        echo "<h3 id='blad'>Już istnieje takie zdarzenie</h3>";
                    }
                    
                }else{
                    echo "<h3 id='blad'>Pole zdarzenie nie może być puste</h3>";
                }
            }
            ?>
            
            </h3>  
            
            </form>

            </div>
        </div>
        <div id="rightsmall">
            <div id='karta'>
            <form action="" method="post">
            <h2>Edytowanie i usuwanie</h2>
            <?php
            echo "<table id='tab'><tr><th>Urządzenia</th><th id='trzecie'>Edytuj</th><th id='trzecie'>Usuń</th></tr>";
            $q="SELECT * FROM urządzenie";
            $r=mysqli_query($polacz,$q);
            while($wyn=mysqli_fetch_row($r)){
                echo"<tr><td>$wyn[0]</td><td><label id='kontener'><input type='radio' name='edytujU2[]' value='$wyn[0]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='checkbox' name='usunU2[]' value='$wyn[0]'><span id='znaczek'></span></label></td></tr>";
            }
            echo "<tr><td id='invis'></td><td id='invis'><input type='submit' name='edytujU' value='Edytuj'></td><td id='invis'><input type='submit' name='usunU' value='Usuń'></td></tr></table>";
            if(isset($_POST['edytujU'])){
                if(!empty($_POST['edytujU2'])) {
                    foreach($_POST['edytujU2'] as $urzadzenie) {
                    $q="SELECT `urządzenie` FROM `sprzęt` WHERE `urządzenie`='$urzadzenie' LIMIT 1";
                    $r=mysqli_query($polacz,$q);
                    while($wyn=mysqli_fetch_row($r)){
                    echo "<h3>Nazwa urządzenia: $wyn[0]<br>
                    <input type='text' name='urzadzenie' placeholder='Podaj nową nazwe urządzenia'><br>
                    <input type='hidden' name='edytujU2[]' value='$urzadzenie'>
                    <input type='submit' name='edytujU3' value='Edytuj urządzenie' id='nie'></h3>";
                    }    
                    }
                }
            }
            
            if(isset($_POST['edytujU3'])){
                if(!empty($_POST['urzadzenie'])) {
                    foreach($_POST['edytujU2'] as $urzadzenie) {
                        $value=$_POST['urzadzenie'];
                        $q="SELECT * FROM urządzenie WHERE nazwa='$value'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$value) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Już istnieje takie urządzenie</h3>";
                        }else{
                            if(strlen($value)>30){
                                echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                            }else{
                                $q="UPDATE `sprzęt` SET `Urządzenie`='$value' WHERE `Urządzenie`='$urzadzenie'";
                                $r=mysqli_query($polacz,$q);
                                $q="UPDATE `urządzenie` SET `nazwa`='$value' WHERE `nazwa`='$urzadzenie'";
                                $r=mysqli_query($polacz,$q);
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }
                    }
                }else{
                    echo "<h3 id='blad'>Pole nie może być puste</h3>";
                }
            }
            if(isset($_POST['usunU'])){
                if(!empty($_POST['usunU2'])) {
                    $ii=0;
                    foreach($_POST['usunU2'] as $urzadzenie) {
                        $q="SELECT `urządzenie` FROM `sprzęt` WHERE `urządzenie`='$urzadzenie'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$urzadzenie) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Nie można usunąć urządzenia: $urzadzenie, bo jest już wykorzystywane(a) w sprzęcie</h3>";
                            $ii=1;
                        }else{
                        $q2="DELETE FROM `urządzenie` WHERE `nazwa`='$urzadzenie'";
                        $r=mysqli_query($polacz,$q2);
                        }
                        }
                        if($ii==0){
                        echo "<meta http-equiv='refresh' content='0'>";
                        }
                }
            }


            echo "<br><table id='tab'><tr><th>Producent</th><th id='trzecie'>Edytuj</th><th id='trzecie'>Usuń</th></tr>";
            $q="SELECT * FROM producent";
            $r=mysqli_query($polacz,$q);
            while($wyn=mysqli_fetch_row($r)){
                echo"<tr><td>$wyn[0]</td><td><label id='kontener'><input type='radio' name='edytujP2[]' value='$wyn[0]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='checkbox' name='usunP2[]' value='$wyn[0]'><span id='znaczek'></span></label></td></tr>";
            }
            echo "<tr><td id='invis'></td><td id='invis'><input type='submit' name='edytujP' value='Edytuj'></td><td id='invis'><input type='submit' name='usunP' value='Usuń'></td></tr></table>";
            if(isset($_POST['edytujP'])){
                if(!empty($_POST['edytujP2'])) {
                    foreach($_POST['edytujP2'] as $producent) {
                    $q="SELECT `producent` FROM `sprzęt` WHERE `producent`='$producent' LIMIT 1";
                    $r=mysqli_query($polacz,$q);
                    while($wyn=mysqli_fetch_row($r)){
                    echo "<h3>Nazwa producenta: $wyn[0]<br>
                    <input type='text' name='producent' placeholder='Podaj nową nazwe producenta'><br>
                    <input type='hidden' name='edytujP2[]' value='$producent'>
                    <input type='submit' name='edytujP3' value='Edytuj producenta' id='nie'></h3>";
                    }    
                    }
                }
            }
            
            if(isset($_POST['edytujP3'])){
                if(!empty($_POST['producent'])) {
                    foreach($_POST['edytujP2'] as $producent) {
                        $value=$_POST['producent'];
                        $q="SELECT * FROM producent WHERE nazwa='$value'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$value) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Już istnieje taki producent</h3>";
                        }else{
                            if(strlen($value)>30){
                                echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                            }else{
                                $q="UPDATE `sprzęt` SET `producent`='$value' WHERE `producent`='$producent'";
                                $r=mysqli_query($polacz,$q);
                                $q="UPDATE `producent` SET `nazwa`='$value' WHERE `nazwa`='$producent'";
                                $r=mysqli_query($polacz,$q);
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }
                    }
                }else{
                    echo "<h3 id='blad'>Pole nie może być puste</h3>";
                }
            }
            if(isset($_POST['usunP'])){
                if(!empty($_POST['usunP2'])) {
                    $ii=0;
                    foreach($_POST['usunP2'] as $producent) {
                        $q="SELECT `producent` FROM `sprzęt` WHERE `producent`='$producent'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$producent) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Nie można usunąć producenta: $producent, bo jest już wykorzystywany w sprzęcie</h3>";
                            $ii=1;
                        }else{
                        $q2="DELETE FROM `producent` WHERE `nazwa`='$producent'";
                        $r=mysqli_query($polacz,$q2);
                        }
                        }
                        if($ii==0){
                        echo "<meta http-equiv='refresh' content='0'>";
                        }
                }
            }


            echo "<br><table id='tab'><tr><th>Dostawca</th><th>Adres</th><th>Telefon</th><th>Email</th><th id='trzecie'>Edytuj</th><th id='trzecie'>Usuń</th></tr>";
            $q="SELECT * FROM dostawca";
            $r=mysqli_query($polacz,$q);
            while($wyn=mysqli_fetch_row($r)){
                $dost=explode("*",$wyn[0]);
                echo "<tr><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td><label id='kontener'><input type='radio' name='edytujD2[]' value='$wyn[0]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='checkbox' name='usunD2[]' value='$wyn[0]'><span id='znaczek'></span></label></td></tr>";
            }
            echo "<tr><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td></td><td id='invis'><input type='submit' name='edytujD' value='Edytuj'></td><td id='invis'><input type='submit' name='usunD' value='Usuń'></td></tr></table>";
            if(isset($_POST['edytujD'])){
                if(!empty($_POST['edytujD2'])) {
                    foreach($_POST['edytujD2'] as $dostawca) {
                    $q="SELECT `dostawca` FROM `sprzęt` WHERE `dostawca`='$dostawca' LIMIT 1";
                    $r=mysqli_query($polacz,$q);
                    while($wyn=mysqli_fetch_row($r)){
                    $dost=explode("*",$wyn[0]);
                    echo "<h3>Nazwa dostawcy: $dost[0]<br>
                    <input type='text' name='dostawcaN' placeholder='Podaj nową nazwe dostawcy'></h3>
                    <h3>Adres dostawcy: $dost[1]<br>
                    <input type='text' name='dostawcaA' placeholder='Podaj nowy adres dostawcy'></h3>
                    <h3>Telefon dostawcy: $dost[2]<br>
                    <input type='number' maxlenght='9' name='dostawcaT' placeholder='Podaj nowy telefon dostawcy'></h3>
                    <h3>Email dostawcy: $dost[3]<br>
                    <input type='text' name='dostawcaE' placeholder='Podaj nowy email dostawcy'><br>
                    <input type='hidden' name='edytujD2[]' value='$dostawca'>
                    <input type='submit' name='edytujD3' value='Dodaj dostawce' id='nie'></h3>";
                    }    
                    }
                }
            }
            if(isset($_POST['edytujD3'])){
                if(!empty($_POST['dostawcaN']) || !empty($_POST['dostawcaA']) || !empty($_POST['dostawcaT']) || !empty($_POST['dostawcaE'])) {
                    foreach($_POST['edytujD2'] as $dostawca) {
                        $a=$_POST['dostawcaN'];
                        $b=$_POST['dostawcaA'];
                        $c=$_POST['dostawcaT'];
                        $d=$_POST['dostawcaE'];
                        $value=$a."*".$b."*".$c."*".$d;
                        $q="SELECT * FROM `dostawca` WHERE `nazwa, adres, telefon, email`='$value'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$value) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Już istnieje taki dostawca</h3>";
                        }else{
                            if(strlen($c)>9 || strlen($c)<9){
                                echo "<h3 id='blad'>Numer telefonu jest błędny</h3>";
                            }else{
                                if(strlen($a)>30 || strlen($b)>30 || strlen($d)>30){
                                    echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                                }else{
                                $q="UPDATE `sprzęt` SET `dostawca`='$value' WHERE `dostawca`='$dostawca'";
                                $r=mysqli_query($polacz,$q);
                                $q="UPDATE `dostawca` SET `nazwa, adres, telefon, email`='$value' WHERE `nazwa, adres, telefon, email`='$dostawca'";
                                $r=mysqli_query($polacz,$q);
                                echo "<meta http-equiv='refresh' content='0'>";
                                }
                            }
                        }
                    }
                }else{
                    echo "<h3 id='blad'>Pole nie może być puste</h3>";
                }
            }
            if(isset($_POST['usunD'])){
                if(!empty($_POST['usunD2'])) {
                    $ii=0;
                    foreach($_POST['usunD2'] as $dostawca) {
                        $q="SELECT `dostawca` FROM `sprzęt` WHERE `dostawca`='$dostawca'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$dostawca) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Nie można usunąć dostawcy: $dostawca, bo jest już wykorzystywany w sprzęcie</h3>";
                            $ii=1;
                        }else{
                        $q2="DELETE FROM `dostawca` WHERE `nazwa, adres, telefon, email`='$dostawca'";
                        $r=mysqli_query($polacz,$q2);
                        }
                        }
                        if($ii==0){
                        echo "<meta http-equiv='refresh' content='0'>";
                        }
                }
            }

            echo "<br><table id='tab'><tr><th>Lokalizacja</th><th id='trzecie'>Edytuj</th><th id='trzecie'>Usuń</th></tr>";
            $q="SELECT * FROM lokalizacja";
            $r=mysqli_query($polacz,$q);
            while($wyn=mysqli_fetch_row($r)){
                echo"<tr><td>$wyn[0]</td><td><label id='kontener'><input type='radio' name='edytujL2[]' value='$wyn[0]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='checkbox' name='usunL2[]' value='$wyn[0]'><span id='znaczek'></span></label></td></tr>";
            }
            echo "<tr><td id='invis'></td><td id='invis'><input type='submit' name='edytujL' value='Edytuj'></td><td id='invis'><input type='submit' name='usunL' value='Usuń'></td></tr></table>";
            if(isset($_POST['edytujL'])){
                if(!empty($_POST['edytujL2'])) {
                    foreach($_POST['edytujL2'] as $lokalizacja) {
                    $q="SELECT `lokalizacja` FROM `sprzęt` WHERE `lokalizacja`='$lokalizacja' LIMIT 1";
                    $r=mysqli_query($polacz,$q);
                    while($wyn=mysqli_fetch_row($r)){
                    echo "<h3>Nazwa lokalizacji: $wyn[0]<br>
                    <input type='text' name='lokalizacja' placeholder='Podaj nową nazwe lokalizacji'><br>
                    <input type='hidden' name='edytujL2[]' value='$lokalizacja'>
                    <input type='submit' name='edytujL3' value='Edytuj lokalizacje' id='nie'></h3>";
                    }    
                    }
                }
            }
            
            if(isset($_POST['edytujL3'])){
                if(!empty($_POST['lokalizacja'])) {
                    foreach($_POST['edytujL2'] as $lokalizacja) {
                        $value=$_POST['lokalizacja'];
                        $q="SELECT * FROM lokalizacja WHERE nazwa='$value'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$value) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Już istnieje taka lokalizacja</h3>";
                        }else{
                            if(strlen($value)>30){
                                echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                            }else{
                                $q="UPDATE `sprzęt` SET `lokalizacja`='$value' WHERE `lokalizacja`='$lokalizacja'";
                                $r=mysqli_query($polacz,$q);
                                $q="UPDATE `lokalizacja` SET `nazwa`='$value' WHERE `nazwa`='$lokalizacja'";
                                $r=mysqli_query($polacz,$q);
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }
                    }
                }else{
                    echo "<h3 id='blad'>Pole nie może być puste</h3>";
                }
            }
            if(isset($_POST['usunL'])){
                if(!empty($_POST['usunL2'])) {
                    $ii=0;
                    foreach($_POST['usunL2'] as $lokalizacja) {
                        $q="SELECT `lokalizacja` FROM `sprzęt` WHERE `lokalizacja`='$lokalizacja'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$lokalizacja) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Nie można usunąć lokalizacji: $lokalizacja, bo jest już wykorzystywana w sprzęcie</h3>";
                            $ii=1;
                        }else{
                        $q2="DELETE FROM `lokalizacja` WHERE `nazwa`='$lokalizacja'";
                        $r=mysqli_query($polacz,$q2);
                        }
                        }
                        if($ii==0){
                        echo "<meta http-equiv='refresh' content='0'>";
                        }
                }
            }

            echo "<br><table id='tab'><tr><th>Status</th><th id='trzecie'>Edytuj</th><th id='trzecie'>Usuń</th></tr>";
            $q="SELECT * FROM status";
            $r=mysqli_query($polacz,$q);
            $i=1;
            while($wyn=mysqli_fetch_row($r)){
                echo"<tr><td>$wyn[0]</td><td><label id='kontener'><input type='radio' name='edytujS2[]' value='$wyn[0]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='checkbox' name='usunS2[]' value='$wyn[0]'><span id='znaczek'></span></label></td></tr>";
                $i++;
            }
            echo "<tr><td id='invis'></td><td id='invis'><input type='submit' name='edytujS' value='Edytuj'></td><td id='invis'><input type='submit' name='usunS' value='Usuń'></td></tr></table>";
            if(isset($_POST['edytujS'])){
                if(!empty($_POST['edytujS2'])) {
                    foreach($_POST['edytujS2'] as $status) {
                    $q="SELECT `status` FROM `sprzęt` WHERE `status`='$status' LIMIT 1";
                    $r=mysqli_query($polacz,$q);
                    while($wyn=mysqli_fetch_row($r)){
                    echo "<h3>Nazwa statusu: $wyn[0]<br>
                    <input type='text' name='status' placeholder='Podaj nową nazwe statusu'><br>
                    <input type='hidden' name='edytujS2[]' value='$status'>
                    <input type='submit' name='edytujS3' value='Edytuj status' id='nie'></h3>";
                    }    
                    }
                }
            }
            if(isset($_POST['edytujS3'])){
                if(!empty($_POST['status'])) {
                    foreach($_POST['edytujS2'] as $status) {
                        $value=$_POST['status'];
                        $q="SELECT * FROM status WHERE nazwa='$value'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$value) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Już istnieje taki status</h3>";
                        }else{
                            if(strlen($value)>30){
                                echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                            }else{
                                $q="UPDATE `sprzęt` SET `status`='$value' WHERE `status`='$status'";
                                $r=mysqli_query($polacz,$q);
                                $q="UPDATE `status` SET `nazwa`='$value' WHERE `nazwa`='$status'";
                                $r=mysqli_query($polacz,$q);
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }
                    }
                }else{
                    echo "<h3 id='blad'>Pole nie może być puste</h3>";
                }
            }
            if(isset($_POST['usunS'])){
                if(!empty($_POST['usunS2'])) {
                    $ii=0;
                    foreach($_POST['usunS2'] as $status) {
                        $q="SELECT `status` FROM `sprzęt` WHERE `status`='$status'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$status) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Nie można usunąć statusu: $status, bo jest już wykorzystywany w sprzęcie</h3>";
                            $ii=1;
                        }else{
                        $q2="DELETE FROM `status` WHERE `nazwa`='$status'";
                        $r=mysqli_query($polacz,$q2);
                        }
                        }
                        if($ii==0){
                        echo "<meta http-equiv='refresh' content='0'>";
                        }
                }
            }

            echo "<br><table id='tab'><tr><th>Login</th><th>Hasło</th><th>Gr. użytkowników</th><th>Email</th><th>Lokalizacja</th><th id='trzecie'>Edytuj</th><th id='trzecie'>Usuń</th></tr>";
            $q="SELECT * FROM użytkownik";
            $r=mysqli_query($polacz,$q);
            while($wyn=mysqli_fetch_row($r)){
                echo "<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td><label id='kontener'><input type='radio' name='edytujU4[]' value='$wyn[6]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='checkbox' name='usunU4[]' value='$wyn[6]'><span id='znaczek'></span></label></td></tr>";
            }
            echo "<tr><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td></td><td id='invis'><input type='submit' name='edytujU6' value='Edytuj'></td><td id='invis'><input type='submit' name='usunU3' value='Usuń'></td></tr></table>";
            if(isset($_POST['edytujU6'])){
                if(!empty($_POST['edytujU4'])) {
                    foreach($_POST['edytujU4'] as $użytkownik) {
                    $q="SELECT * FROM `użytkownik` WHERE `id`='$użytkownik' LIMIT 1";
                    $r=mysqli_query($polacz,$q);
                    while($wyn=mysqli_fetch_row($r)){
                    echo "<h3>Login użytkownika: $wyn[0]<br>
                    <input type='text' name='uzytkownikL'></h3>
                    <h3>Hasło użytkownika: $wyn[1]<br>
                    <input type='text' name='uzytkownikH'></h3>
                    <h3>Grupa użytkowników: $wyn[2]<br>
                    <input type='text' name='uzytkownikG'></h3>
                    <h3>Email użytkownika: $wyn[3]<br>
                    <input type='text' name='uzytkownikE'></h3>
                    <h3>Lokalizacja użytkownika: $wyn[4]<br>
                    <input type='text' name='uzytkownikL'><br>
                    <input type='hidden' name='edytujU4[]' value='$użytkownik'>
                    <input type='submit' name='edytujU5' value='Edytuj użytkownika' id='nie'></h3>";
                    }    
                    }
                }
            }
            if(isset($_POST['edytujU5'])){
                if(!empty($_POST['uzytkownikL']) || !empty($_POST['uzytkownikH']) || !empty($_POST['uzytkownikG']) || !empty($_POST['uzytkownikE']) || !empty($_POST['uzytkownikL'])) {
                    foreach($_POST['edytujU4'] as $użytkownik) {
                        $a=$_POST['uzytkownikL'];
                        $b=$_POST['uzytkownikH'];
                        $c=$_POST['uzytkownikG'];
                        $d=$_POST['uzytkownikE'];
                        $e=$_POST['uzytkownikL'];
                        $q="SELECT * FROM `użytkownik` WHERE `login`='$a' AND `hasło`='$b'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$value) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Już istnieje taki uzytkownik</h3>";
                        }else{
                            if(strlen($a)>30 || strlen($b)>30 || strlen($d)>30){
                                echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                            }else{
                            $q="UPDATE `użytkownik` SET `login`='$a',`hasło`='$b',`grupa użytkowników`='$c',`email`='$d',`lokalizacja`='$e',`czyAdmin`='0' WHERE `id`='$użytkownik'";
                            $r=mysqli_query($polacz,$q);
                            echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }
                    }
                }else{
                    echo "<h3 id='blad'>Pola nie mogą być puste</h3>";
                }
            }
            if(isset($_POST['usunU3'])){
                if(!empty($_POST['usunU4'])) {
                    foreach($_POST['usunU4'] as $uzytkownik) {
                        $q="DELETE FROM `użytkownik` WHERE `id`='$uzytkownik'";
                        $r=mysqli_query($polacz,$q);
                        }
                        echo "<meta http-equiv='refresh' content='0'>";
                }
            }

            echo "<br><table id='tab'><tr><th>Zdarzenie</th><th id='trzecie'>Edytuj</th><th id='trzecie'>Usuń</th></tr>";
            $q="SELECT * FROM zdarzenie";
            $r=mysqli_query($polacz,$q);
            while($wyn=mysqli_fetch_row($r)){
                echo"<tr><td>$wyn[0]</td><td><label id='kontener'><input type='radio' name='edytujZ2[]' value='$wyn[0]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='checkbox' name='usunZ2[]' value='$wyn[0]'><span id='znaczek'></span></label></td></tr>";
            }
            echo "<tr><td id='invis'></td><td id='invis'><input type='submit' name='edytujZ' value='Edytuj'></td><td id='invis'><input type='submit' name='usunZ' value='Usuń'></td></tr></table>";
            if(isset($_POST['edytujZ'])){
                if(!empty($_POST['edytujZ2'])) {
                    foreach($_POST['edytujZ2'] as $zdarzenie) {
                    $q="SELECT `nazwa` FROM `zdarzenie` WHERE `nazwa`='$zdarzenie'";
                    $r=mysqli_query($polacz,$q);
                    while($wyn=mysqli_fetch_row($r)){
                    echo "<h3>Nazwa zdarzenia: $wyn[0]<br>
                    <input type='text' name='zdarzenie' placeholder='Podaj nową nazwe zdarzenia'><br>
                    <input type='hidden' name='edytujZ2[]' value='$zdarzenie'>
                    <input type='submit' name='edytujZ3' value='Edytuj zdarzenie' id='nie'></h3>";
                    }    
                    }
                }
            }
            if(isset($_POST['edytujZ3'])){
                if(!empty($_POST['zdarzenie'])) {
                    foreach($_POST['edytujZ2'] as $zdarzenie) {
                        $value=$_POST['zdarzenie'];
                        $q="SELECT * FROM zdarzenie WHERE nazwa='$value'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$value) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Już istnieje takie zdarzenie</h3>";
                        }else{
                            if(strlen($value)>30){
                                echo "<h3 id='blad'>Nazwa jest za długa</h3>";
                            }else{
                                $q="UPDATE `zdarzenia` SET `nazwa`='$value' WHERE `nazwa`='$zdarzenie'";
                                $r=mysqli_query($polacz,$q);
                                $q="UPDATE `zdarzenie` SET `nazwa`='$value' WHERE `nazwa`='$zdarzenie'";
                                $r=mysqli_query($polacz,$q);
                                echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }
                    }
                }else{
                    echo "<h3 id='blad'>Pole nie może być puste</h3>";
                }
            }
            if(isset($_POST['usunZ'])){
                if(!empty($_POST['usunZ2'])) {
                    $ii=0;
                    foreach($_POST['usunZ2'] as $zdarzenie) {
                        $q="SELECT `nazwa` FROM `zdarzenia` WHERE `nazwa`='$zdarzenie'";
                        $r=mysqli_query($polacz,$q);
                        $i=0;
                        while($wyn=mysqli_fetch_row($r)){
                            if($wyn[0]==$zdarzenie) $i=1;
                        }
                        if($i==1){
                            echo "<h3 id='blad'>Nie można usunąć zdarzenia: $zdarzenie, bo jest już wykorzystywane w sprzęcie</h3>";
                            $ii=1;
                        }else{
                        $q2="DELETE FROM `zdarzenie` WHERE `nazwa`='$zdarzenie'";
                        $r=mysqli_query($polacz,$q2);
                        }
                        }
                        if($ii==0){
                        echo "<meta http-equiv='refresh' content='0'>";
                        }
                }
            }
            ?>
            </form>
            </h3>
            
            </div>
        </div>
    </div>
</body>
</html>