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
    <div id="menu_nav">
       
        <div id="menu2">
        <a href="index.php"><h1>Strona główna</a>
        </div>
        <div id="menu3">
        <a href="add.php"><h1>Dodawanie sprzętu</a>
        </div>
        <div id="menu4">
        <a href="edit.php"><h1>Zarządzanie sprzętem</a><!-- edit, podgląd i usun -->
        </div>
        <div id="menu5">
        <a href="add2.php"><h1>Dodawanie zdarzenia</a>
        </div>
        <div id="menu6">
        <a href="manage.php"><h1>Zarządzanie słownikami</a>
        </div>
        <div id="menu1">
        <a href="login.php"><h1>Logowanie</h1></a><!--  logowanie na głownej -> przekazywanie danych pomiędzy podstronami i automatyczne logowanie wtedy -->
        </div>
    </div>
    <div id="restdod">
    <form action="" method="post">
        <h2>Dodaj sprzęt</h2>
        <h3>Numer inwentaryzacyjny:<br>
        <input type="text" name="numerI"></h3>
        <h3>Numer seryjny:<br>
        <input type="text" name="numerS"></h3>
        <h3>Urządzenie:<br>
        <?php
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
        echo "</select></h3>";
        ?>
        <h3>Model: <br>
        <input type="text" name="model"></h3>
        <h3>Lokalizacja:<br>
        <?php
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
        echo "</select></h3>";
        ?> 
        <h3>Data zakupu:<br>
        <input type="date" name="dataZ"></h3>
        <h3>Data gwarancji:<br>
        <input type="date" name="dataG"></h3>
        <h3>Data przeglądu:<br>
        <input type="date" name="dataP"></h3>
        <h3>Wartość brutto:<br>
        <input type="text" name="wartoscB"></h3>
        <?php
        echo " <p>Status:<br>
        <select name='status'><option value=''>------</option>";
        $q="SELECT * FROM status";
        $r=mysqli_query($polacz,$q);
        while($wyn=mysqli_fetch_row($r)){
            echo"<option value='$wyn[0]'>$wyn[0]</option>";
        }
        echo "</select></h3>";
        ?>
        <h3>Zdjęcie:<br>
        <input type="file" name="zdjecie"></h3>
        <h3>Uwagi:<br>
        <input type="text" name="uwagi" value="brak"></h3>
        <input type="submit" value="dodaj" name="dodaj">
        <?php
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
                echo "Nie wypełniono wszystkich wymaganych pól";
            }else{
                $q="INSERT INTO `sprzęt`(`Id`, `Numer inwentaryzacyjny`, `Numer seryjny`, `Urządzenie`, `Producent`, `Model`, `Lokalizacja`, `Dostawca`, `Data zakupu`, `Data gwarancji`, `Data przeglądu`, `Wartość brutto`, `Status`, `Zdjęcie`, `Uwagi`) VALUES ('','$numI','$numS','$urza','$prod','$mod','$lok','$dos','$datZ','$datG','$datP','$wart','$status','$zdj','$uwagi')";
                $r=mysqli_query($polacz,$q);
            }


        }




        ?>

    </form>
    </div>
</body>
</html>