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
        <?php
        if($_SESSION['czyAdmin']==1){
        echo "<a href='edit.php' id='toleft'>Edycja sprzętu</a>
        <a href='add2.php' id='toleft'>Zarządzanie zdarzeniami</a>
        <a href='manage.php' id='toleft'>Zarządzanie słownikami</a>";
        }
        ?>
        <a href='login.php' id='toright'>Logowanie</a>
    </div>
    <div id="rest">
        <form action="" method="post">
    <div id="left">
        <div id="karta">
        <h2>Sprzęt szpitalu</h2>
        <table id="tab">
            <tr><th rowspan="2">Nr inwentaryzacyjny</th><th rowspan="2">Nr seryjny</th><th rowspan="2">Urządzenie</th><th rowspan="2">Producent</th><th rowspan="2">Model</th><th rowspan="2">Lokalizacja</th><th colspan="4"  style="text-align:center;">Dostawca</th><th rowspan="2">Data zakupu</th><th rowspan="2">Data gwarancji</th><th rowspan="2">Data przeglądu</th><th rowspan="2">Wartość brutto</th><th rowspan="2">Status</th><th rowspan="2">Awaria</th></tr>
            <tr><th>Nazwa</th><th>Adres</th><th>Telefonu</th><th>Email</th></tr>
        <?php
        $polacz=mysqli_connect("localhost","root","","sprzęt medyczny");
        mysqli_set_charset($polacz, "utf8");
        if($_SESSION['czyAdmin']==1){
            $q="SELECT `Numer inwentaryzacyjny`, `Numer seryjny`,`Urządzenie`,`Producent`, `Model`,`Lokalizacja`,`Dostawca`, DATE_FORMAT(`Data zakupu`, '%d-%m-%Y'), DATE_FORMAT(`Data gwarancji`, '%d-%m-%Y'), DATE_FORMAT(`Data przeglądu`, '%d-%m-%Y'), `Wartość brutto`,`Status`,`id` FROM `sprzęt`";
        }else{
            $q="SELECT `Numer inwentaryzacyjny`, `Numer seryjny`,`Urządzenie`,`Producent`, `Model`,`Lokalizacja`,`Dostawca`, DATE_FORMAT(`Data zakupu`, '%d-%m-%Y'), DATE_FORMAT(`Data gwarancji`, '%d-%m-%Y'), DATE_FORMAT(`Data przeglądu`, '%d-%m-%Y'), `Wartość brutto`,`Status`,`id` FROM `sprzęt` WHERE `Lokalizacja`='".$_SESSION['lokalizacja']."'";
        }
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            $dost=explode("*",$wyn[6]);
            echo"<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td>$wyn[5]</td><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td id='data'>$wyn[7]</td><td id='data'>$wyn[8]</td><td>$wyn[9]</td><td>$wyn[10]</td><td>$wyn[11]</td><td><label id='kontener'><input type='radio' name='dodaj2' value='$wyn[12]'><span id='znaczek'></span></label></td></tr>";
        }
        echo"<tr><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'></td><td id='invis'>
        <input type='submit' name='dodaj' value='Dodaj'></td></tr>";
        echo "</table>";

        ?>
        </div>
    </div>
    <div id="right">
        <div id="karta">
        <?php
            if(isset($_POST['dodaj'])){
                    if(!empty($_POST['dodaj2'])) {
                    $value=$_POST['dodaj2'];
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
                    echo "<input type='submit' name='dodaj3' value='Dodaj'>";
                    }else{
                        echo "<h2 id='blad'>Sprzęt nie został wybrany</h2>";
                    }
                }
                if(isset($_POST['dodaj3'])){
                    $value=$_POST["value"];
                    $a="awaria";
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
                        $q="UPDATE `sprzęt` SET `status`='awaria' WHERE `Id`='$value'";
                        $r=mysqli_query($polacz,$q);
                        echo "<h2 id='gut'>Zdarzenie zostało dodane</h2>";
                
                    }
                }
                ?>
        </form>
        </div>
    </div>
</div>     
</body>
</html>