<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
    header('Location: index.php');
    exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Error:". $polaczenie->connect_errno;
}
else
{
    $login = $_POST['login'];
    $haslo = $_POST['password'];
    
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE nazwa_uzytkownika='%s' AND haslo='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$haslo))))
        {
            $liczba_userow = $rezultat->num_rows;
            if($liczba_userow>0)
            {
                $_SESSION['zalogowany'] = true;
                $wiersz = $rezultat->fetch_assoc();
                $_SESSION['id_user'] = $wiersz['id_user'];
                $_SESSION['nazwa_uzytkownika'] = $wiersz['nazwa_uzytkownika'];
                $_SESSION['Imie'] = $wiersz['Imie'];
                $_SESSION['Nazwisko'] = $wiersz['Nazwisko'];
                $_SESSION['e_mail'] = $wiersz['e_mail'];
                $_SESSION['uprawnienia'] = $wiersz['uprawnienia'];
        
                unset($_SESSION['error']);
            
                $rezultat->free_result();
        
                header('Location: zalogowany.php');
            }
            else
                {
                $_SESSION['error'] = '<span style="color:red; font-size: 15pt;">Nieprawidlowy login lub haslo!</span>';
                header('Location: login.php');
                }
        }
    
    $polaczenie->close();
}
//$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
//$rezultat = @$polaczenie->query
//$wiersz = $rezultat->fetch_assoc();

?>