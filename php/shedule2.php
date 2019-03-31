<?php

session_start();

require_once "connect.php";

$baza = @new mysqli($host, $db_user, $db_password, $db_name);

if($baza->connect_errno!=0)
{
    echo "Error:". $baza->connect_errno;
}
else
{
    $zapytanie = "SELECT * FROM users WHERE nazwa_uzytkownika='$login' AND haslo='$haslo'";
    
    if($rezultat = @$polaczenie->query($zapytanie))
    {
     
    }
    
    $baza->close();
}


?>