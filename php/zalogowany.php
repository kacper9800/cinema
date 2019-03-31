<?php

	session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
    <title>Kino MaxFun</title>
    <meta charset="UTF-8" />
    <!--CSS-->
    <link rel="stylesheet" href="../css/style.css">
    <!--CSS-->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!-- Bootstrap -->

</head>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="index.php">Strona główna <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="login.php">Logowanie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="shedule.php">Repertuar</a>
            </li>
             <li class="nav-item ">
                <a class="nav-link" href="kina.php">
                    <?php
        if(isset($_SESSION['zalogowany']))
        {
        echo "<p style='font-size:12pt; text-align:center;'>Rezerwacja</p>";
        }
        ?>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link">
                    <?php
        if(isset($_SESSION['zalogowany']))
        {
        echo "<p style='font-size:12pt; text-align:center; color:red; '>Zalogowany jako: ".$_SESSION['nazwa_uzytkownika']."</p>";
        }
        else
            echo "<p style='font-size:10pt; text-align:center; color:white; '>Niezalogowany!</p>";
        ?>
                </a>
            </li>
            <li class="nav-item ">
                <?php
        if(isset($_SESSION['zalogowany']))
        {
        echo "<a class='nav-link' style='font-size:12pt; text-align:center; color:grey' href='logout.php'> Wyloguj</a>";
        }
        ?>
            </li>
        </ul>
    </div>
</nav>

<body oncopy="return false" oncut="return false" onpaste="return false">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 ">
                <?php 
            echo "<p style='font-size:30pt; text-align:center'>Witaj ".$_SESSION['Imie']." ".$_SESSION['Nazwisko']."!</p>";?>

                <?php
            $login = $_SESSION['nazwa_uzytkownika'];
         
            
            require_once "connect.php";

            $baza = @new mysqli($host, $db_user, $db_password, $db_name);
            
            if($baza->connect_errno!=0)
            {
            echo "Error:". $baza->connect_errno;
            }
            
            else
            {
            $zapytanie = "SELECT uprawnienia FROM users WHERE nazwa_uzytkownika= '$login'";
    
                if($rezultat = @$baza->query($zapytanie))
                {
                    $wiersz = $rezultat->fetch_assoc();
                    if ($wiersz['uprawnienia'] == 0 ) 
                    {
                    echo "<p style='text-align:center;'>Twoje rezerwacje:</p>";?>
                <div class="container-fluid">
                    <div class="row">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Numer rezerwacji</th>
                                    <th scope="col">Data rezerwacji</th>
                                    <th scope="col">Liczba biletów ulgowych</th>
                                    <th scope="col">Liczba biletów normalnych</th>
                                    <th scope="col">Kino</th>
                                    <th scope="col">Twoje imie</th>
                                    <th scope="col">Twoje nazwisko</th>
                                </tr>
                            </thead>
                            <tbody>
        <?php
        
        $id_user=$_SESSION['id_user'];
        $sql=$baza->query("SELECT id_rezerwacji, repertuar.data,bilety_u, bilety_n, id_kina,users.Imie, users.Nazwisko
        FROM ((rezerwacje
       INNER JOIN users  ON rezerwacje.id_user=users.id_user)
       INNER JOIN repertuar on repertuar.id_zdarzenia=rezerwacje.id_zdarzenia) WHERE rezerwacje.id_user=$id_user"); //ZAPYTANIE MYSQL
        if($baza->connect_errno!=0)
        {
        echo "Error:". $baza->connect_errno;
        }
        else
        {
        while($row = mysqli_fetch_array($sql))
        {
        echo
        "<tr>
        <td>".$row[0]."</td>
        <td>".$row[1]."</td>
        <td>".$row[2]."</td>
        <td>".$row[3]."</td>
        <td>".$row[4]."</td>
        <td>".$row[5]."</td>
        <td>".$row[5]."</td>";
        }}
    
       echo"</tr>";

        ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <?php
                    }
                   
                    elseif($wiersz['uprawnienia'] == 1) 
                    {
                    echo "<p style='font-size:30pt; text-align:center'>Panel administratora</p>";
                    echo "<p style='text-align:center;'>Rezerwacje:</p>";
                    ?>
                <div class="container-fluid">
                    <div class="row">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">id_rezerwacji</th>
                                    <th scope="col">uzytkownik</th>
                                    <th scope="col">id_zdarzenia</th>
                                    <th scope="col">Akcja</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
        $sql=$baza->query("SELECT `id_rezerwacji`,`id_user`,`id_zdarzenia` FROM `rezerwacje`");
        if($baza->connect_errno!=0)
        {
        echo "Error:". $baza->connect_errno;
        }
        else
        {
        while($row = mysqli_fetch_array($sql))
        {
        echo
        "<tr>
        <td>".$row[0]."</td>
        <td>".$row[1]."</td>
        <td>".$row[2]."</td>
        <td><button type='button' class='btn btn-danger
        '>Usuń rezerwację</button></td>";
        }}
    
       echo"</tr>";
        ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <?php
                    }
                }
    
            $baza->close();
            }
            ?>
            </div>
        </div>
        <hr>
    </div>
</body>

</html>
