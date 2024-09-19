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

                }else{
                    echo "<h1>Witaj na stronie: ".$_SESSION['nazwa']."</h1>";
                }
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
    <div id='kartas'>
    <form action="" method="post">
        
        <?php
        $polacz=mysqli_connect('localhost','root','','sprzęt medyczny');
        mysqli_set_charset($polacz, 'utf8');
        if($_SESSION['logged']=='niezalogowany'){
        echo "<h2> Logowanie</h2>
        <h3>Nazwa użytkownika</h3>
        <input type='text' name='NazwaU' placeholer='Nazwa użytkownika'><br>
        <h3>Hasło</h3>
        <input type='password' name='HasloU' placeholer='Hasło'><br>
        <input type='submit' value='Zaloguj się' name='zaloguj'>";
        }else{
            echo "<center><input type='submit' value='Wyloguj się' name='wyloguj' id='wyloguj'></center>
            ";
        }
        if(isset($_POST["wyloguj"])){
            $_SESSION['logged']='niezalogowany';
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if(isset($_POST["zaloguj"])){
            $nazwa=$_POST["NazwaU"];
            $haslo=$_POST["HasloU"];
            $q="SELECT login,hasło,czyAdmin,lokalizacja FROM użytkownik WHERE login='$nazwa' AND hasło='$haslo'";
            $r=mysqli_query($polacz,$q);
            while($wyn=mysqli_fetch_row($r)){
                if($wyn[0]==$nazwa AND $wyn[1]==$haslo){
                    $czyAdmin=$wyn[2];
                    $lokalizacja=$wyn[3];
                    $_SESSION['logged']=$haslo;
                    $_SESSION['nazwa']=$nazwa;
                    $_SESSION['czyAdmin']=$czyAdmin;
                    $_SESSION['lokalizacja']=$lokalizacja;
                }
            }
            echo "<meta http-equiv='refresh' content='0'>";
        }
        ?>
    </form>
    </div>
    </div>
</body>
</html>