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
    <div id="left">
        <div id="karta">
        <h2>Sprzęt szpitalu</h2>
        <table id="tab">
            <tr><th rowspan="2">Nr inwentaryzacyjny</th><th rowspan="2">Nr seryjny</th><th rowspan="2">Urządzenie</th><th rowspan="2">Producent</th><th rowspan="2">Model</th><th rowspan="2">Lokalizacja</th><th colspan="4"  style="text-align:center;">Dostawca</th><th rowspan="2">Data zakupu</th><th rowspan="2">Data gwarancji</th><th rowspan="2">Data przeglądu</th><th rowspan="2">Wartość brutto</th><th rowspan="2">Status</th></tr>
            <tr><th>Nazwa</th><th>Adres</th><th>Telefonu</th><th>Email</th></tr>
        <?php
        $polacz=mysqli_connect("localhost","root","","sprzęt medyczny");
        mysqli_set_charset($polacz, "utf8");
        if($_SESSION['czyAdmin']==1){
            $q="SELECT `Numer inwentaryzacyjny`, `Numer seryjny`,`Urządzenie`,`Producent`, `Model`,`Lokalizacja`,`Dostawca`, DATE_FORMAT(`Data zakupu`, '%d-%m-%Y'), DATE_FORMAT(`Data gwarancji`, '%d-%m-%Y'), DATE_FORMAT(`Data przeglądu`, '%d-%m-%Y'), `Wartość brutto`,`Status` FROM `sprzęt`";
        }else{
            $q="SELECT `Numer inwentaryzacyjny`, `Numer seryjny`,`Urządzenie`,`Producent`, `Model`,`Lokalizacja`,`Dostawca`, DATE_FORMAT(`Data zakupu`, '%d-%m-%Y'), DATE_FORMAT(`Data gwarancji`, '%d-%m-%Y'), DATE_FORMAT(`Data przeglądu`, '%d-%m-%Y'), `Wartość brutto`,`Status` FROM `sprzęt` WHERE `Lokalizacja`='".$_SESSION['lokalizacja']."'";
        }
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            $dost=explode("*",$wyn[6]);
            echo"<tr><td>$wyn[0]</td><td>$wyn[1]</td><td>$wyn[2]</td><td>$wyn[3]</td><td>$wyn[4]</td><td>$wyn[5]</td><td>$dost[0]</td><td>$dost[1]</td><td>$dost[2]</td><td>$dost[3]</td><td id='data'>$wyn[7]</td><td id='data'>$wyn[8]</td><td>$wyn[9]</td><td>$wyn[10]</td><td>$wyn[11]</td></tr>";
        }
        echo "</table>";

        ?>
        </div>
    </div>
    <div id="right">
        <div id="karta">
    <form action="" method="post">
        <?php
        if($_SESSION['czyAdmin']==1){
        if(isset($_POST["dodaj"])){
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
                $q="INSERT INTO `sprzęt`(`Id`, `Numer inwentaryzacyjny`, `Numer seryjny`, `Urządzenie`, `Producent`, `Model`, `Lokalizacja`, `Dostawca`, `Data zakupu`, `Data gwarancji`, `Data przeglądu`, `Wartość brutto`, `Status`, `Zdjęcie`, `Uwagi`) VALUES ('','$numI','$numS','$urza','$prod','$mod','$lok','$dos','$datZ','$datG','$datP','$wart','$status','$zdj','$uwagi')";
                $r=mysqli_query($polacz,$q);
                echo "<h2 id='gut'>Sprzęt został pomyślnie dodany</h2>";
            }


        }
        



        echo "
        <h2>Dodaj sprzęt</h2>
        <h3>Numer inwentaryzacyjny:<br>
        <input type='text' name='numerI'></h3>
        <h3>Numer seryjny:<br>
        <input type='text' name='numerS'></h3>
        <h3>Urządzenie:<br>";
        $polacz=mysqli_connect("localhost","root","","sprzęt medyczny");
        mysqli_set_charset($polacz, "utf8");
        echo "<select name='urzadzenie'><option value=''>------</option>";
        $q="SELECT * FROM urządzenie";
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            echo"<option value='$wyn[0]'>$wyn[0]</option>";
        }
        echo "</select></h3>";
        echo "<h3>Producent:<br>";
        echo "<select name='producent'><option value=''>------</option>";
        $q="SELECT * FROM producent";
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            echo"<option value='$wyn[0]'>$wyn[0]</option>";
        }
        echo "</select></h3>
        <h3>Model: <br>
        <input type='text' name='model'></h3>
        <h3>Lokalizacja:<br>";
        echo "<select name='lokalizacja'><option value=''>------</option>";
        $q="SELECT * FROM lokalizacja";
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            echo"<option value='$wyn[0]'>$wyn[0]</option>";
        }
        echo "</select></h3>
        <h3>Dostawca:<br>
        <select name='dostawca'><option value=''>------</option>";
        $q="SELECT * FROM dostawca";
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            echo"<option value='$wyn[0]'>$wyn[0]</option>";
        }
        echo "</select></h3>
        <h3>Data zakupu:<br>
        <input type='date' name='dataZ'></h3>
        <h3>Data gwarancji:<br>
        <input type='date' name='dataG'></h3>
        <h3>Data przeglądu:<br>
        <input type='date' name='dataP'></h3>
        <h3>Wartość brutto:<br>
        <input type='text' name='wartoscB'></h3>";
        echo " <h3>Status:<br>
        <select name='status'><option value=''>------</option>";
        $q="SELECT * FROM status";
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            echo"<option value='$wyn[0]'>$wyn[0]</option>";
        }
        echo "</select></h3>
        <h3>Zdjęcie:<br>
        <input type='file' name='zdjecie'></h3>
        <h3>Uwagi:<br>
        <input type='text' name='uwagi' value='brak'></h3>
        <input type='submit' value='Dodaj' name='dodaj'>";
        }
        ?>
        </form>
    </div>
    </div>
    </div>
    <div id="footer">
        <h2>Wykonał: Stanisław</h2>
    </div>
</body>
</html>