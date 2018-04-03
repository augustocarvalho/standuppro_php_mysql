<?php
include 'config.php';
<<<<<<< HEAD
$etapa = 18;
=======
$etapa = 4;
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
$podio=1;
$cat = mysql_query("SELECT idcategoria FROM categoria order by idcategoria");
while ($categoria = mysql_fetch_assoc($cat) ) {
   $idcategoria = $categoria['idcategoria'];	
   $sql_longa = mysql_query("SELECT i.numero  
                   FROM inscricao i join atleta p join categoria c 
                   WHERE i.etapa_idetapa = $etapa and i.atleta_cpf = p.cpf 
                   and i.tempo <> '00:00:00' 
                   and i.categoria_idcategoria = c.idcategoria 
                   AND c.idcategoria = $idcategoria
                   order by i.tempo");  
   while ($row = mysql_fetch_assoc($sql_longa)){
      $num_atleta=$row['numero'];
      mysql_query("UPDATE inscricao SET podio_longa=$podio WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
      $podio++;
   }
   $podio = 1;
   $sql_tecnica = mysql_query("SELECT i.numero  
                   FROM inscricao i join atleta p join categoria c 
                   WHERE i.etapa_idetapa = $etapa and i.atleta_cpf = p.cpf 
<<<<<<< HEAD
                   and i.podio_tecnica <> 0 
                   and i.categoria_idcategoria = c.idcategoria 
                   AND c.idcategoria = $idcategoria
                   order by i.podio_tecnicas");  
=======
                   and i.tempo_2 <> '00:00:00' 
                   and i.categoria_idcategoria = c.idcategoria 
                   AND c.idcategoria = $idcategoria
                   order by i.tempo_2");  
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
   while ($row = mysql_fetch_assoc($sql_tecnica)){
      $num_atleta=$row['numero'];
      mysql_query("UPDATE inscricao SET podio_tecnica=$podio WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
      $podio++;
   }
}

<<<<<<< HEAD
echo "<script>alert('RESULTADO CBSUP !!');</script>";
echo "<meta http-equiv='refresh' content='0, url=./resultado_cbsup.php'>";

=======
echo '"GERADO RESULTADO!!!!"'
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
?>
