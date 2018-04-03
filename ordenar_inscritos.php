<?php
include 'config.php';
<<<<<<< HEAD
$count=150;
$sql = mysql_query("SELECT distinct(i.numero), p.nome 
						FROM inscricao i 
						  join atleta p  ON  i.atleta_cpf = p.cpf
                          WHERE i.etapa_idetapa ='14' order by p.nome");  
while ($row = mysql_fetch_assoc($sql)){
   $cod=$row['numero'];
   mysql_query("UPDATE inscricao SET numero=$count WHERE etapa_idetapa='14' AND numero=$cod");
=======
$count=415;
$sql = mysql_query("SELECT distinct(i.numero), p.nome FROM inscricao i join atleta p  
                          WHERE i.etapa_idetapa ='5' and i.atleta_cpf = p.cpf order by p.nome");  
while ($row = mysql_fetch_assoc($sql)){
   $cod=$row['numero'];
   mysql_query("UPDATE inscricao SET numero=$count WHERE etapa_idetapa='5' AND numero=$cod");
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
   $count++;
}
echo '"ORDENADOS!!!!"'
?>
