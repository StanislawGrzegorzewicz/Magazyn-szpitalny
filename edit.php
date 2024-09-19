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
            <tr><th rowspan="2">Nr inwentaryzacyjny</th><th rowspan="2">Nr seryjny</th><th rowspan="2">Urządzenie</th><th rowspan="2">Producent</th><th rowspan="2">Model</th><th rowspan="2">Lokalizacja</th><th colspan="4"  style="text-align:center;">Dostawca</th><th rowspan="2">Data zakupu</th><th rowspan="2">Data gwarancji</th><th rowspan="2">Data przeglądu</th><th rowspan="2">Wartość brutto</th><th rowspan="2">Status</th><th rowspan="2">Zdjęcie</th><th rowspan="2">Uwagi</th><th  colspan="5"  style="text-align:center;">Zdarzenie</th><th rowspan="2">Edytuj</th><th rowspan="2">Usuń</th></tr>
            <tr><th>Nazwa</th><th>Adres</th><th>Telefonu</th><th>Email</th><th>Nazwa</th><th>Data rozpoczęcia</th><th>Data zakończenia</th><th>Opis</th><th>Załącznik</th></tr>
        <?php
        $polacz=mysqli_connect("localhost","root","","sprzęt medyczny");
        mysqli_set_charset($polacz, "utf8");
        $q="SELECT `Numer inwentaryzacyjny`, `Numer seryjny`,`Urządzenie`,`Producent`, `Model`,`Lokalizacja`,`Dostawca`, DATE_FORMAT(`Data zakupu`, '%d-%m-%Y'), DATE_FORMAT(`Data gwarancji`, '%d-%m-%Y'), DATE_FORMAT(`Data przeglądu`, '%d-%m-%Y'), `Wartość brutto`,`Status`,`zdjęcie`,`uwagi`,`Id` FROM `sprzęt` ORDER BY `Id` ASC";
        $r=mysqli_query($polacz,$q);
        $q2="SELECT `nazwa`, DATE_FORMAT(`data rozpoczęcia`, '%d-%m-%Y'), DATE_FORMAT(`data zakończenia`, '%d-%m-%Y'),`opis`,`załącznik`,`sprzęt id` FROM `zdarzenia` ORDER BY `sprzęt id` ASC";
        $r2=mysqli_query($polacz,$q2);
        $i=0;
        while($wyn2=mysqli_fetch_row($r2)){
            if($i==0){
                $zdarz = array (
                    array("$wyn2[0]","$wyn2[1]","$wyn2[2]","$wyn2[3]","$wyn2[4]","$wyn2[5]")
                );
                $i++;
            }else{
                $zdarz[] = array("$wyn2[0]", "$wyn2[1]", "$wyn2[2]", "$wyn2[3]", "$wyn2[4]", "$wyn2[5]");
                $i++;
            }

        }
        
        $zdarz[] = array("", "", "", "", "", "0");
        $j=$i;
        $i=0;
        while($wyn=mysqli_fetch_row($r)){
            $dost=explode("*",$wyn[6]);
            if($j<$i){
                echo"<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td>$wyn[5]</td><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td id='data'>$wyn[7]</td><td id='data'>$wyn[8]</td><td id='data'>$wyn[9]</td><td>$wyn[10]</td><td>$wyn[11]</td><td>$wyn[12]</td><td>$wyn[13]</td><td>brak</td><td>brak</td><td>brak</td><td>brak</td><td>brak</td><td><label id='kontener'><input type='radio' name='edytujr' value='$wyn[14]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='radio' name='Usuń' value='$wyn[14]'><span id='znaczek'></span></label></td></tr>";
            
            }else{
            if($wyn[14]==$zdarz[$i][5]){
                    echo"<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td>$wyn[5]</td><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td id='data'>$wyn[7]</td><td id='data'>$wyn[8]</td><td id='data'>$wyn[9]</td><td>$wyn[10]</td><td>$wyn[11]</td><td>$wyn[12]</td><td>$wyn[13]</td><td>".$zdarz[$i][0]."</td><td>".$zdarz[$i][1]."</td><td>".$zdarz[$i][2]."</td><td>".$zdarz[$i][3]."</td><td>".$zdarz[$i][4]."</td><td><label id='kontener'><input type='radio' name='edytujr' value='$wyn[14]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='radio' name='Usuń' value='$wyn[14]'><span id='znaczek'></span></label></td></tr>";
                    $i++;
                    }else{
                    echo"<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td>$wyn[5]</td><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td id='data'>$wyn[7]</td><td id='data'>$wyn[8]</td><td id='data'>$wyn[9]</td><td>$wyn[10]</td><td>$wyn[11]</td><td>$wyn[12]</td><td>$wyn[13]</td><td>brak</td><td>brak</td><td>brak</td><td>brak</td><td>brak</td><td><label id='kontener'><input type='radio' name='edytujr' value='$wyn[14]'><span id='znaczek'></span></label></td><td><label id='kontener'><input type='radio' name='Usuń' value='$wyn[14]'><span id='znaczek'></span></label></td></tr>";
                    }
                    while($wyn[14]==$zdarz[$i][5]){
                        echo"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>".$zdarz[$i][0]."</td><td>".$zdarz[$i][1]."</td><td>".$zdarz[$i][2]."</td><td>".$zdarz[$i][3]."</td><td>".$zdarz[$i][4]."</td><td></td><td></td></tr>"; 
                        $i++;
                    }
            }
        }
        echo"<tr><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'>
        <input type='submit' name='edytuj' value='Edytuj'></td><td id='invis'>
        <input type='submit' name='usun' value='Usuń'></td></tr></table>";

        ?>
        </div>
    </div>
    <div id="right">
        <div id="karta">
        <?php
        if(isset($_POST['edytuj'])){
        if(!empty($_POST['edytujr'])) {
        $value=$_POST['edytujr'];
        $q="SELECT `Numer inwentaryzacyjny`, `Numer seryjny`,`Urządzenie`,`Producent`, `Model`,`Lokalizacja`,`Dostawca`, DATE_FORMAT(`Data zakupu`, '%d-%m-%Y'), DATE_FORMAT(`Data gwarancji`, '%d-%m-%Y'), DATE_FORMAT(`Data przeglądu`, '%d-%m-%Y'), `Wartość brutto`,`Status`,`zdjęcie`,`uwagi`,`Id` FROM `sprzęt` WHERE `Id`='$value'";
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            echo "<h2>Edycja sprzętu</h2>";
            echo "<h3>Numer inwentaryzacyjny:   $wyn[0]   <input type='text' name='numerI' placeholder='Podaj nowy numer inwentaryzacyjny' id='zarzad'></h3>";
            echo "<h3>Numer seryjny:   $wyn[1]   <input type='text' name='numerS' placeholder='Podaj nowy numer seryjny' id='zarzad'></h3>";
            echo "<h3>Urządzenie:   $wyn[2]   <select name='urzadzenie'><option value=''>------</option>";
            $q="SELECT * FROM urządzenie";
            $r=mysqli_query($polacz,$q);
            while($wyn2=mysqli_fetch_row($r)){
                echo"<option value='$wyn2[0]'>$wyn2[0]</option>";
            }
            echo "</select></h3>";
            echo "<h3>Producent:   $wyn[3]   <select name='producent'><option value=''>------</option>";
            $q="SELECT * FROM producent";
            $r=mysqli_query($polacz,$q);
            while($wyn2=mysqli_fetch_row($r)){
                echo"<option value='$wyn2[0]'>$wyn2[0]</option>";
            }
            echo "</select></h3>";
            echo "<h3>Model:   $wyn[4]   <input type='text' name='model' placeholder='Podaj nowy model' id='zarzad'>";
            echo "<h3>Lokalizacja:   $wyn[5]   <select name='lokalizacja'><option value=''>------</option>";
            $q="SELECT * FROM lokalizacja";
            $r=mysqli_query($polacz,$q);
            while($wyn2=mysqli_fetch_row($r)){
                echo"<option value='$wyn2[0]'>$wyn2[0]</option>";
            }
            echo "</select></h3>";
            echo "<h3>Dostawca:   $wyn[6]   <select name='dostawca'><option value=''>------</option>";
            $q="SELECT * FROM dostawca";
            $r=mysqli_query($polacz,$q);
            while($wyn2=mysqli_fetch_row($r)){
                echo"<option value='$wyn2[0]'>$wyn2[0]</option>";
            }
            echo "</select></h3>";
            echo"
            <h3>Data zakupu:   $wyn[7]   <input type='date' name='dataZ' id='zarzad'>
            <h3>Data gwarancji:   $wyn[8]   <input type='date' name='dataG' id='zarzad'>
            <h3>Data przeglądu:   $wyn[9]   <input type='date' name='dataP' id='zarzad'>
            <h3>Wartość brutto:   $wyn[10]   <input type='text' name='wartoscB' placeholder='Podaj nową wartość brutto' id='zarzad'>";
            echo "<h3>Status:   $wyn[11]   <select name='status'><option value=''>------</option>";
            $q="SELECT * FROM status";
            $r=mysqli_query($polacz,$q);
            while($wyn2=mysqli_fetch_row($r)){
                echo"<option value='$wyn2[0]'>$wyn2[0]</option>";
            }
            echo "</select></h3>";
            echo "<h3>Zdjęcie:   $wyn[12]   <input type='file' name='zdjecie' placeholder='Podaj nową nazwę' id='zarzad'>
            <h3>Uwagi:   $wyn[13]   <input type='text' name='uwagi' placeholder='Podaj nową nazwę' id='zarzad' value='brak'>";
        }
        echo "<p><input type='submit' name='edytuj2' value='Edytuj' id='ed'></p>";
        echo "<input type='hidden' name='value' value='$value'>";
        }else{
            echo "<h2 id='blad'>Sprzęt nie został zaznaczony</h2>";
        }
    }
    if(isset($_POST["edytuj2"])){
        $value=$_POST["value"];
        $numI=$_POST["numerI"];
        $numS=$_POST["numerS"];
        $urza=$_POST["urzadzenie"];
        $prod=$_POST["producent"];
        $mod=$_POST["model"];
        $lok=$_POST["lokalizacja"];
        $dos=$_POST["dostawca"];
        $datZ=$_POST["dataZ"];
        $datG=$_POST["dataG"];
        $datP=$_POST["dataP"];
        $wart=$_POST["wartoscB"];
        $status=$_POST["status"];
        $zdj=$_POST["zdjecie"];
        $uwagi=$_POST["uwagi"];
        if($zdj=="") $zdj="brak";
        if($numI=="" || $numS=="" || $urza=="" || $prod=="" || $mod=="" || $lok=="" || $dos=="" || $datZ=="" || $datG=="" || $datP=="" || $wart=="" || $status==""){
            echo "<h2 id='blad'>Nie wypełniono wszystkich wymaganych pól</h2>";
        }else{
            $q="UPDATE `sprzęt` SET`Numer inwentaryzacyjny`='$numI',`Numer seryjny`='$numS',`Urządzenie`='$urza',`Producent`='$prod',`Model`='$mod',`Lokalizacja`='$lok',`Dostawca`='$dos',`Data zakupu`='$datZ',`Data gwarancji`='$datG',`Data przeglądu`='$datP',`Wartość brutto`='$wart',`Status`='$status',`Zdjęcie`='$zdj',`Uwagi`='$uwagi' WHERE `Id`='$value'";
            $r=mysqli_query($polacz,$q);
            echo "<h2 id='gut'>Edycja powiodła się</h2>";
        }
    }
    if(isset($_POST['usun'])){
        
        if(!empty($_POST['Usuń'])) {
        $value=$_POST['Usuń'];
        echo "<h2>Jesteś pewny(a), aby usunąć ten sprzęt?</h2>";
        echo "<input type='submit' name='usun2' value='TAK' id='tak'><input type='submit' name='usun3' value='NIE' id='nie'>";
        echo "<input type='hidden' name='value' value='$value'>";
        }else{
            echo "<h2 id='blad'>Sprzęt nie został zaznaczony</h2>";
        }
        
    }
    if(isset($_POST['usun2'])){
        $value=$_POST["value"];
        $q="DELETE FROM `sprzęt` WHERE `Id`='$value'";
        $r=mysqli_query($polacz,$q);
        echo "<h2 id='blad'>Sprzęt został usunięty</h2>";
    }
    if(isset($_POST['usun3'])){
        echo "<h2 id='gut'>Sprzęt nie został usunięty</h2>";
    }
    ?>
        </div>
    </div>
    </div>
    <div id="footer">
        <h2>Wykonał: Stanisław</h2>
    </div>
    </form>
</body>
</html>