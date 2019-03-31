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
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
</head>
    
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Strona główna <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="login.php">Logowanie</a>
      </li>
      <li class="nav-item active">
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
        <a class="nav-link" >
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
<!-- Navbar -->
    
    <br><br>
    
<div class="container-fluid">
    <div class="row">
        <table class="table table-hover table-bordered " id="myTable">
   <thead>
     <tr>
       <th scope="col">Data</th>
       <th scope="col">Miasto</th>
       <th scope="col">Lokalizacja</th>
       <th scope="col">Tytuł</th>
       <th scope="col">Producent</th>
     </tr>
   </thead>
   <tbody>
       <?php
        require_once "connect.php";
        
        $baza = @new mysqli($host, $db_user, $db_password, $db_name);
        $sql=$baza->query("SELECT repertuar.data, kino.miasto, kino.nazwa, filmy.tytul, filmy.producent, filmy.rodzaj, repertuar.id_zdarzenia, sala.l_miejsc  FROM(((repertuar INNER JOIN kino  ON repertuar.id_kina=kino.id_kina)INNER JOIN filmy on repertuar.id_filmu=filmy.id_filmu)
INNER JOIN sala on repertuar.id_sali=sala.id_sali) ORDER BY repertuar.data");
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
        <td>".date("d.m.Y", strtotime($row[0]))."</td>
        <td>".$row[1]."</td>
        <td>".$row[2]."</td>
        <td>".$row[3]."</td>
        <td>".$row[4]."</td>";
        }}
    
       echo"</tr>";
        $baza->close();
        ?>
    </tbody>
</table>
</div>
</div>
<br><br><br><br>
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