<?php

	session_start();
	
    if(isset($_POST['email']))
    {

        $good = true; //flaga
        $nick = $_POST['nick']; 
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        if((strlen($nick)<3)||(strlen($nick)>20))
        {
            $good=false;
            $_SESSION['ern']="Nick musi posiadać od 3 do 20 znaków";
        }
        if(ctype_alnum($nick)==false)
        {
            $good = false;
            $_SESSION['ern']="Nick moze skladac sie tylko z liter i cyfr - bez polskich znakow";
        }
        
        $email=$_POST['email'];
        $emailn = filter_var($email, FILTER_SANITIZE_EMAIL);
        
        if((filter_var($emailn,FILTER_VALIDATE_EMAIL)==false)||($emailn!=$email))
        {
            $good = false;
            $_SESSION['ere']="Podaj poprawny adres e-mail!";
        }
        
        $haslo1=$_POST['password'];
        $haslo2=$_POST['password2'];
        
        if($haslo1!=$haslo2)
        {
            $good=false;
            $_SESSION['erh2']="Hasla nie sa identyczne!";
        }
        
        if((strlen($haslo1)<8)||(strlen($haslo1)>20))
        {
            $good=false;
            $_SESSION['erh']="Haslo musi zawierac od 8 do 20 znakow";
        } 
        
        //$secret_key = "6LdP440UAAAAAHJJrcRAxnWhFRwVIo4CL4UJtcwl";
        
        //$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'$respnse='.$_POST['g-recaptcha-response']);
        
        //$odpowiedz = json_decode($sprawdz);
        
        //if($odpowiedz->success==false)
        //{
        //    $good=false;
        //    $_SESSION['erc']="BOT?!";
        //}
        
        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if($polaczenie->connect_errno!=0)
            {
            throw new Exception(mysqli_connect_errno());
            }  
            else
            {
            //email
            $rezultat=$polaczenie->query("SELECT id_user FROM users WHERE e_mail='$email'");
                
            if(!$rezultat) throw new Exception($polaczenie->error);
                
            $ile_maili = $rezultat->num_rows;
            if($ile_maili>0)
            {
                $good=false;
                $_SESSION['ere']= "Podany e-mail jest juz wykorzystywany!";
            }
            //nick
            $rezultat=$polaczenie->query("SELECT id_user FROM users WHERE nazwa_uzytkownika='$nick'");
                
            if(!$rezultat) throw new Exception($polaczenie->error);
                
            $ile_nick = $rezultat->num_rows;
            if($ile_nick>0)
            {
                $good=false;
                $_SESSION['ern']= "Istnieje juz osoba o podanym nicku";
            }
            
            if($good==true)
            {       
                if($polaczenie->query("INSERT INTO users VALUES('NULL','$email', '$nick','$haslo1','0','$imie','$nazwisko')"))
                {
                    $_SESSION['udanarejestracja']=true;
                    echo "Rejestracja przebiegła pomyślnie";
                    header('Location: index.php');
                }
                else
                {
                    throw new Exception($polaczenie->error);
                }
            }
                
            $polaczenie->close();
            }
        
        }
        catch(Exception $e)
        {
            echo'<span style="color:red;">Błąd serwera </span>';
        }
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
    
    <!-- Captcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Captcha -->
</head>

<header>
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <img src="../Pictures/pic1.jpg" alt="COŚ" width="50%" >
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
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Rezerwacja
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="kina.php">Wyszukaj kino</a>
          <a class="dropdown-item" href="zalogowany.php">Twoje rezerwacje</a>
        </div>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-6 offset-4">
            <!--form-->
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Nazwa użytkownika</label>
                <input name="nick" type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nazwa użytkownika">
                <?php 
                if(isset($_SESSION['ern']))
                {
                    echo'<div class="error">'.$_SESSION['ern'].'</div>';
                    unset($_SESSION['ern']);
                }
                ?>    
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hasło</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Twoje haslo">
            </div>
                  <?php 
                if(isset($_SESSION['erh']))
                {
                    echo'<div class="error">'.$_SESSION['erh'].'</div>';
                    unset($_SESSION['erh']);
                }
                ?>
             <div class="form-group">
                <label for="exampleInputPassword1">Powtórz Hasło</label>
                <input name="password2" type="password" class="form-control" id="exampleInputPassword1" placeholder="Twoje haslo">
            </div>
             <?php 
                if(isset($_SESSION['erh2']))
                {
                    echo'<div class="error">'.$_SESSION['erh2'].'</div>';
                    unset($_SESSION['erh2']);
                }
                ?> 
            <div class="form-group">
                <label for="exampleInputPassword1">Imie</label>
                <input name="imie" type="text" class="form-control" id="exampleInputPassword1" placeholder="Imie">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Nazwisko</label>
                <input name="nazwisko" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nazwisko">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">E-mail</label>
                <input name="email" type="e-mail" class="form-control" id="exampleInputPassword1" placeholder="E-mail">
            </div>
             <?php 
                if(isset($_SESSION['ere']))
                {
                    echo'<div class="error">'.$_SESSION['ere'].'</div>';
                    unset($_SESSION['ere']);
                }
                ?> 
           
            <div class="g-recaptcha form-group form-check" data-sitekey="6LdP440UAAAAAFQDaP-2NmXXQjnQmZS8Ks4Hbm4R"></div>
              <!--<?php 
                if(isset($_SESSION['erc']))
                {
                    echo'<div class="error">'.$_SESSION['erc'].'</div>';
                    unset($_SESSION['erc']);
                }
                ?> 
    -->
            <button type="submit" class="btn btn-success">Zarejestruj</button>
        </form>
        <!--form-->
        </div>
        <div class="col-2">
        
           
        </div>
        </div>
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