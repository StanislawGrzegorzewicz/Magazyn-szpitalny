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
        <form action="" method="post">
    <div id="left">
        <div id="karta">
        <h2>Sprzęt szpitalu</h2>
        <table id="tab">
            <tr><th rowspan="2">Nr inwentaryzacyjny</th><th rowspan="2">Nr seryjny</th><th rowspan="2">Urządzenie</th><th rowspan="2">Producent</th><th rowspan="2">Model</th><th rowspan="2">Lokalizacja</th><th colspan="4"  style="text-align:center;">Dostawca</th><th rowspan="2">Data zakupu</th><th rowspan="2">Data gwarancji</th><th rowspan="2">Data przeglądu</th><th rowspan="2">Wartość brutto</th><th rowspan="2">Status</th><th rowspan="2">Zdjęcie</th><th rowspan="2">Uwagi</th><th  colspan="5"  style="text-align:center;">Zdarzenie</th><th rowspan="2">Dodaj do sprzętu</th><th rowspan="2">Edytuj zdarzenie</th><th rowspan="2">Usuń zdarzenie</th></tr>
            <tr><th>Nazwa</th><th>Adres</th><th>Telefonu</th><th>Email</th><th>Nazwa</th><th>Data rozpoczęcia</th><th>Data zakończenia</th><th>Opis</th><th>Załącznik</th></tr>
        <?php
        $polacz=mysqli_connect("localhost","root","","sprzęt medyczny");
        mysqli_set_charset($polacz, "utf8");
        $q="SELECT `Numer inwentaryzacyjny`, `Numer seryjny`,`Urządzenie`,`Producent`, `Model`,`Lokalizacja`,`Dostawca`, DATE_FORMAT(`Data zakupu`, '%d-%m-%Y'), DATE_FORMAT(`Data gwarancji`, '%d-%m-%Y'), DATE_FORMAT(`Data przeglądu`, '%d-%m-%Y'), `Wartość brutto`,`Status`,`zdjęcie`,`uwagi`,`Id` FROM `sprzęt` ORDER BY `Id` ASC";
        $r=mysqli_query($polacz,$q);
        $q2="SELECT `nazwa`, DATE_FORMAT(`data rozpoczęcia`, '%d-%m-%Y'), DATE_FORMAT(`data zakończenia`, '%d-%m-%Y'),`opis`,`załącznik`,`sprzęt id`,`id` FROM `zdarzenia` ORDER BY `sprzęt id` ASC";
        $r2=mysqli_query($polacz,$q2);
        $i=0;
        while($wyn2=mysqli_fetch_row($r2)){
            if($i==0){
                $zdarz = array (
                    array("$wyn2[0]","$wyn2[1]","$wyn2[2]","$wyn2[3]","$wyn2[4]","$wyn2[5]","$wyn2[6]")
                );
                $i++;
            }else{
                $zdarz[] = array("$wyn2[0]", "$wyn2[1]", "$wyn2[2]", "$wyn2[3]", "$wyn2[4]", "$wyn2[5]", "$wyn2[6]");
                $i++;
            }

        }
        
        $zdarz[] = array("", "", "", "", "", "0","0");
        $j=$i;
        $i=0;
        while($wyn=mysqli_fetch_row($r)){
            $dost=explode("*",$wyn[6]);
            if($j<$i){
                echo"<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td>$wyn[5]</td><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td id='data'>$wyn[7]</td><td id='data'>$wyn[8]</td><td id='data'>$wyn[9]</td><td>$wyn[10]</td><td>$wyn[11]</td><td>$wyn[12]</td><td>$wyn[13]</td><td>brak</td><td>brak</td><td>brak</td><td>brak</td><td>brak</td><td><label id='kontener'><input type='radio' name='wybor' value='$wyn[14]'><span id='znaczek'></span></label></td><td></td><td></td></tr>";
            
            }else{
            if($wyn[14]==$zdarz[$i][5]){
                    echo"<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td>$wyn[5]</td><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td id='data'>$wyn[7]</td><td id='data'>$wyn[8]</td><td id='data'>$wyn[9]</td><td>$wyn[10]</td><td>$wyn[11]</td><td>$wyn[12]</td><td>$wyn[13]</td><td>".$zdarz[$i][0]."</td><td>".$zdarz[$i][1]."</td><td>".$zdarz[$i][2]."</td><td>".$zdarz[$i][3]."</td><td>".$zdarz[$i][4]."</td><td><label id='kontener'><input type='radio' name='wybor' value='$wyn[14]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='radio' name='edytuj' value=".$zdarz[$i][6]."><span id='znaczek'></span></label></td><td><label id='kontener'><input type='radio' name='Usuń' value=".$zdarz[$i][6]."><span id='znaczek'></span></label></td></tr>";
                    $i++;
                    }else{
                    echo"<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td>$wyn[5]</td><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td id='data'>$wyn[7]</td><td id='data'>$wyn[8]</td><td id='data'>$wyn[9]</td><td>$wyn[10]</td><td>$wyn[11]</td><td>$wyn[12]</td><td>$wyn[13]</td><td>brak</td><td>brak</td><td>brak</td><td>brak</td><td>brak</td><td><label id='kontener'><input type='radio' name='wybor' value='$wyn[14]'><span id='znaczek'></span></label></td><td></td><td></td></tr>";
                    }
                    while($wyn[14]==$zdarz[$i][5]){
                        echo"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>".$zdarz[$i][0]."</td><td>".$zdarz[$i][1]."</td><td>".$zdarz[$i][2]."</td><td>".$zdarz[$i][3]."</td><td>".$zdarz[$i][4]."</td><td></td><td><label id='kontener'><input type='radio' name='edytuj' value=".$zdarz[$i][6]."><span id='znaczek'></span></label></td><td><label id='kontener'><input type='radio' name='Usuń' value=".$zdarz[$i][6]."><span id='znaczek'></span></label></td></tr>"; 
                        $i++;
                    }
            }
        }
        echo"<tr><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'>
        <input type='submit' name='dodaj' value='Dodaj'></td><td id='invis'>
        <input type='submit' name='edytuj2' value='Edytuj'></td><td id='invis'>
        <input type='submit' name='usun' value='Usuń'></td></tr></table>";

        ?>
        </div>
    </div>
    <div id="right">
        <div id="karta">
        <?php
        if(isset($_POST['dodaj'])){
            if(!empty($_POST['wybor'])) {
            $value=$_POST['wybor'];
            echo " <h3>Nazwa zdarzenia:<br>
            <select name='nazwa'><option value=''>------</option>";
            $q="SELECT * FROM zdarzenie";
            $r=mysqli_query($polacz,$q);
            while($wyn=mysqli_fetch_row($r)){
                echo"<option value='$wyn[0]'>$wyn[0]</option>";
            }
            echo "</select></h3>";
            echo "<h3>Data rozpoczęcia:<br>
                <input type='date' name='dataR'></h3>";
            echo "<h3>Data zakończenia:<br>
                <input type='date' name='dataZ'></h3>";
            echo "<h3>Opis zdarzenia<br>
                <input type='text' name='opis'></h3>";
            echo "<h3>Załącznik:<br>
                <input type='file' name='zalacznik'></h3>";
            echo "<input type='hidden' name='value' value='$value'>";
            echo "<input type='submit' name='dodaj2' value='Dodaj'>";
            }else{
                echo "<h2 id='blad'>Sprzęt nie został wybrany</h2>";
            }
        }
        if(isset($_POST['dodaj2'])){
            $value=$_POST["value"];
            $a=$_POST["nazwa"];
            $b=$_POST["dataR"];
            $c=$_POST["dataZ"];
            $d=$_POST["opis"];
            $e=$_POST["zalacznik"];
            if($e=="") $e="brak";
            if($a=="" || $b=="" || $c==""|| $d==""){
                echo "<h2 id='blad'>Nie wypełniono wszystkich pól</h2>";
            }else{
                $q="INSERT INTO `zdarzenia`(`nazwa`, `data rozpoczęcia`, `data zakończenia`, `opis`, `załącznik`, `sprzęt id`) VALUES ('$a','$b','$c','$d','$e','$value')";
                $r=mysqli_query($polacz,$q);
                echo "<h2 id='gut'>Zdarzenie zostało dodane</h2>";
        
            }
        }
        if(isset($_POST['usun'])){
            if(!empty($_POST['Usuń'])) {
            $value=$_POST['Usuń'];
            echo "<h2>Jesteś pewny(a), aby usunąć te zdarzenie?</h2>";
            echo "<input type='submit' name='usun2' value='TAK' id='tak'><input type='submit' name='usun3' value='NIE' id='nie'>";
            echo "<input type='hidden' name='value' value='$value'>";
            }else{
                echo "<h2 id='blad'>Zdarzenie nie został zaznaczone</h2>";
            }
            
        }
        if(isset($_POST['usun2'])){
            $value=$_POST["value"];
            $q="DELETE FROM `zdarzenia` WHERE `id`='$value'";
            $r=mysqli_query($polacz,$q);
            echo "<h2 id='blad'>Zdarzenie zostało usunięte</h2>";
        }
        if(isset($_POST['usun3'])){
            echo "<h2 id='gut'>Zdarzenie nie zostało usunięte</h2>";
        }
        if(isset($_POST['edytuj2'])){
            if(!empty($_POST['edytuj'])) {
            $value=$_POST['edytuj'];
            echo "<h2>Edycja zdarzenia</h2>";
            $q="SELECT `nazwa`, DATE_FORMAT(`data rozpoczęcia`, '%d-%m-%Y'), DATE_FORMAT(`data zakończenia`, '%d-%m-%Y'),`opis`,`załącznik`,`sprzęt id`,`id` FROM `zdarzenia`WHERE `id`='$value'";
            $r=mysqli_query($polacz,$q);
            while($zdarz=mysqli_fetch_row($r)){
                echo " <h3>Nazwa zdarzenia: $zdarz[0]<br>
                <select name='nazwa'><option value=''>Podaj nową nazwe zdarzenia</option>";
                $q="SELECT * FROM zdarzenie";
                $r=mysqli_query($polacz,$q);
                while($wyn=mysqli_fetch_row($r)){
                    echo"<option value='$wyn[0]'>$wyn[0]</option>";
                }
                echo "</select></h3>";
                echo "<h3>Data rozpoczęcia: $zdarz[1]<br>
                <input type='date' name='dataR'></h3>";
                echo "<h3>Data zakończenia: $zdarz[2]<br>
                    <input type='date' name='dataZ'></h3>";
                echo "<h3>Opis zdarzenia: $zdarz[3]<br>
                    <input type='text' name='opis' placeholder='Podaj nowy opis'></h3>";
                echo "<h3>Załącznik: $zdarz[4]<br>
                    <input type='file' name='zalacznik'></h3>";
                echo "<input type='hidden' name='value' value='$value'>";
                echo "<input type='submit' name='edytuj3' value='Edytuj'>";
                }
                
            }else{
                echo "<h2 id='blad'>Zdarzenie nie zostało wybrane</h2>";
            }
            
        }
        if(isset($_POST["edytuj3"])){
            $value=$_POST["value"];
            $a=$_POST["nazwa"];
            $b=$_POST["dataR"];
            $c=$_POST["dataZ"];
            $d=$_POST["opis"];
            $e=$_POST["zalacznik"];
            if($e=="") $e="brak";
            if($a=="" || $b=="" || $c==""|| $d==""){
                echo "<h2 id='blad'>Nie wypełniono wszystkich pól</h2>";
            }else{
                $q="UPDATE `zdarzenia` SET `nazwa`='$a',`data rozpoczęcia`='$b',`data zakończenia`='$c',`opis`='$d',`załącznik`='$e' WHERE `id`='$value'";
                $r=mysqli_query($polacz,$q);
                echo "<h2 id='gut'>Zdarzenie zostało edytowane</h2>";
        
            }
        }
        ?>
        </form>
    </div>
    </div>
</div>
    
</body>
</html>