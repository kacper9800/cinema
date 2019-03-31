<?php

	session_start();
	

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

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <img src="../Pictures/pic1.jpg" alt="COŚ" width="50%">
                <br>
                <p style="color:white;font-size:20pt; font-family:sanf-serif">Witamy na stronie dla klientów naszego kina, zapraszamy do rezerwacji!
                </p>
            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Strona główna <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="login.php">Logowanie</a>
            </li>
            <li class="nav-item ">
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

<br><br>

<body oncopy="return false" oncut="return false" onpaste="return false">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 offset-2">
                <img src="../Pictures/underdog_okladka.jpg" width="300pt" height="300pt">
            </div>
            <div class="col-4 offset-2">
                <img src="../Pictures/pic4.jpeg" width="300pt" height="300pt">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4 offset-5">
                <img src="../Pictures/pic4.jpeg" width="300pt" height="300pt">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4 offset-2">
                <img src="../Pictures/pic4.jpg" width="300pt" height="300pt">
            </div>
            <div class="col-4 offset-2">
                <img src="../Pictures/pic4.jpg" width="300pt" height="300pt">
            </div>

        </div>
        <br>
    </div>
</body>
<hr>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br>
                <br>
                <br>
                <h4>Created by Kacper Rzymkiewicz</h4>
                <br>
                <h6>RZ STUDIO</h6>
                <br>

            </div>
        </div>
    </div>
</footer>

</html>
