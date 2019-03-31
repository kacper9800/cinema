<?php

	session_start();
	
?> 
<!-- SELECT * FROM((repertuar INNER JOIN kino  ON repertuar.id_kina=kino.id_kina)
			   			 INNER JOIN filmy on repertuar.id_filmu=filmy.id_filmu) WHERE repertuar.id_kina=1;-->
<div class="container-fluid">
    <div class="row">
        <?php
        
        require_once "connect.php";
        $id=$_POST['id_zdarzenia'];
       
        $baza = @new mysqli($host, $db_user, $db_password, $db_name);
        
        if($baza->connect_errno!=0)
        {
        echo "Error:". $baza->connect_errno;
        }
        else
        {
            
            $u = $_SESSION['id_user'];
            $iz = $_POST['id_zdarzenia'];
            $ul = $_POST['ulgowe'];
            $n = $_POST['normalny'];
            
            $baza->query("INSERT INTO rezerwacje (id_user, id_zdarzenia, bilety_u, bilety_n)
                                    VALUES ('$u','$iz','$ul','$n')");
            $sql2 = $baza->query("SELECT id_rezerwacji from rezerwacje ORDER BY id_rezerwacji desc");
            $row = mysqli_fetch_array($sql2);
                
             echo "<span style='font-size:50px; text-align:center;'>Twoj numer rezerwacji: ".$row[0]."</span>";
        }
        $baza->close();
        ?>
        
    
</div>
</div>