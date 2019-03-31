<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: zalogowany.php');
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
    
    <!--FullPage -->
</head>


<nav class="navbar navbar-expand-lg navbar-light bg-transparent">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Strona główna <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="login.php">Logowanie</a>
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
    </ul>
  </div>
</nav>

    <div class="alert alert-danger" role="alert">
        <h5 style="text-align:center"> Zaloguj się, aby móc dokonać rezerwacji!</h5>
    </div>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 offset-2">
            <div id="form1">
                <form action="zaloguj.php" method="post">
                <div class="form-group">
                <label for="exampleFormControlSelect1" style="font-family:sans-serif;">
                Login: 
                </label>
                <input type="text" name="login" /> <br>
                <label for="exampleFormControlSelect1" style="font-family:sans-serif;">
                Hasło:
                </label>
                <input type="password" name="password"/>
                    <br><br>
                <input type="submit" value="Zaloguj się!" class="btn btn-success"/>
                </div>
                </form>
            <?php 
                if(isset($_SESSION['error']))
                    echo $_SESSION['error'];
            ?>
            </div>
            </div> 
            <div class="col-2 bg-transparent">
                <br><h5> Nie masz konta?<br></h5>  
                 <a href="rejestracja.php" class="btn btn-danger btn-lg active" role="button" aria-pressed="true">Zarejestruj się!</a>
            </div>
        </div>
     </div>
</body>
    <br><br><br><br><br>
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