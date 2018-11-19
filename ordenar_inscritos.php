<?php
include 'config.php';
$count=124;
$sql = mysqli_query($con, "SELECT distinct(i.numero), p.nome 
						FROM inscricao i 
						  join atleta p  ON  i.atleta_cpf = p.cpf
                          WHERE i.etapa_idetapa ='26' 
                          AND (numero < 100 or numero > 123) order by p.nome");  
while ($row = mysqli_fetch_assoc($sql)){
   $cod=$row['numero'];
   mysqli_query($con, "UPDATE inscricao SET numero=$count WHERE etapa_idetapa='26' AND numero=$cod");
   $count++;
}
echo '"ORDENADOS!!!!"'
?>
