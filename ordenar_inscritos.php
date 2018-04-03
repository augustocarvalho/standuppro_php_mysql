<?php
include 'config.php';
$count=150;
$sql = mysql_query("SELECT distinct(i.numero), p.nome 
						FROM inscricao i 
						  join atleta p  ON  i.atleta_cpf = p.cpf
                          WHERE i.etapa_idetapa ='14' order by p.nome");  
while ($row = mysql_fetch_assoc($sql)){
   $cod=$row['numero'];
   mysql_query("UPDATE inscricao SET numero=$count WHERE etapa_idetapa='14' AND numero=$cod");
   $count++;
}
echo '"ORDENADOS!!!!"'
?>
