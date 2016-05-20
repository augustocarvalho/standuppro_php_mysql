<?php
include 'config.php';
$count=415;
$sql = mysql_query("SELECT distinct(i.numero), p.nome FROM inscricao i join atleta p  
                          WHERE i.etapa_idetapa ='5' and i.atleta_cpf = p.cpf order by p.nome");  
while ($row = mysql_fetch_assoc($sql)){
   $cod=$row['numero'];
   mysql_query("UPDATE inscricao SET numero=$count WHERE etapa_idetapa='5' AND numero=$cod");
   $count++;
}
echo '"ORDENADOS!!!!"'
?>
