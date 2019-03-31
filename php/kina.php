<?php

	session_start();
	require_once "connect.php";
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    if($conn->connect_errno!=0)
    {
        echo "Error:". $conn->connect_errno;
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
    
    <!-- Wyświetlanie informacji -->
    <script src="../js/skrypt.js"></script>
    
</head>
    
<header>
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <img src="../Pictures/pic1.jpg" alt="COŚ" width="50%" >
            <br>
            <p style="color:white;font-size:20pt;font-family:sanf-serif">Witamy na stronie dla klientów naszego kina, zapraszamy do rezerwacji</p>
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

    <br><br>
 
<body oncopy="return false" oncut="return false" onpaste="return false">
<div id="zamiana">
<div class="container-fluid">
   <div class="row">
        <div class="col-6 offset-4">
        <form id="form">
        <div class="form-group">
            <label for="exampleInputEmail1">Wybierz lokalizację:</label>
            <select name="kino" class="form-control form-control-sm" name="pow">
                <?php
                $sql = $conn->query("SELECT * from kino");
                while($row = mysqli_fetch_array($sql)){
                echo"<option value='".$row['id_kina']."'>".$row['miasto']."</option>";}
                ?>
            </select>
        </div>
        
        <div class="form-group">
           <div class="col-6 offset-3">
            <label for="exampleInputEmail1">Data seansu:</label>
            <input name="data" class="form-control form-control-sm" type="date" id="d_start" value="<?php echo date("yyyy-MM-dd"); ?>" >
            </div>
        </div>
        <submit class="btn btn-success" onClick="form()">Szukaj</submit>
  </form>     
</div>
</div>
</div>
</div>
</body>
    
    <hr>i
    <br>
    <br>
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