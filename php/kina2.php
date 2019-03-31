<?php

	session_start();
	
?> 
<!DOCTYPE HTML>
<!-- SELECT * FROM((repertuar INNER JOIN kino  ON repertuar.id_kina=kino.id_kina)
			   			 INNER JOIN filmy on repertuar.id_filmu=filmy.id_filmu)
													WHERE repertuar.id_kina=1;-->
<div class="container-fluid">
    <div class="row">
        <table class="table" id="myTable">
   <thead>
     <tr>
       <th scope="col">Data</th>
       <th scope="col">Miasto</th>
       <th scope="col">Lokalizacja</th>
       <th scope="col">Tytuł</th>
       <th scope="col">Producent</th>
       <th scope="col">Rodzaj filmu</th>
        <th scope="col">Liczba miejsc</th>
       <th scope="col">Bilety ulgowe</th>
       <th scope="col">Bilety normalne</th>
       <th scope="col">Akcja</th>
     </tr>
   </thead>
   <tbody>
       <?php
        require_once "connect.php";
        $lokalizacja=$_POST['lokalizacja'];
        //$data=$_POST['data'];
        
        $baza = @new mysqli($host, $db_user, $db_password, $db_name);
        $sql=$baza->query("SELECT repertuar.data, kino.miasto, kino.nazwa, filmy.tytul, filmy.producent, filmy.rodzaj, repertuar.id_zdarzenia, sala.l_miejsc  FROM(((repertuar INNER JOIN kino  ON repertuar.id_kina=kino.id_kina)INNER JOIN filmy on repertuar.id_filmu=filmy.id_filmu)
INNER JOIN sala on repertuar.id_sali=sala.id_sali) WHERE repertuar.id_kina='$lokalizacja' ORDER BY data");
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
        <td>".$row[4]."</td>
        <td>".$row[5]."</td>";
   
            $zm1=0;
                $zm0=0;
            $sql_2=$baza->query("SELECT `bilety_u`,`bilety_n` from rezerwacje where id_zdarzenia=$row[6]");
              
            if(mysqli_num_rows($sql_2)>1)
            {
                while($roww = mysqli_fetch_array($sql_2))
                {
                $zm0+=$roww[0];
                $zm1+=$roww[1];
                }
        
            $zm1=$row[7]-$zm0-$zm1;
            }
            else
            {
                $zm1=$row[7];
            }
            
              echo "<td><p style='text-align:center'>Pozostało miejsc: ".$zm1."</p></td>";
        ?>

        <td><select id="normalne<?php echo $row[6] ?>">
            <?php for($i=0; $i<=10; $i++)
            echo'<option value="'.$i.'">'.$i.'</option>';
            ?>
            </select></td>
       <td><select id="ulgowe<?php echo $row[6] ?>">
            <?php for($i=0; $i<=10; $i++)
            echo'<option value="'.$i.'">'.$i.'</option>';
            ?>
            </select></td>
            
        <td><button onClick='form2(<?php echo $row[6].', '.$zm1; ?>)' type='button' class='btn btn-success'>Zarezerwuj</button></td>
       
        
        <?php
        }
        }
        $baza->close();
        ?>
    </tbody>
</table>
</div>
</div>
