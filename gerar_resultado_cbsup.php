<?php
include 'config.php';
$etapa = 20; #DEFINIR QUAL ETAPA DESEJA GERAR RESULTADO
$podio=1;
$cat = mysqli_query($con,"SELECT idcategoria FROM categoria order by idcategoria");
while ($categoria = mysqli_fetch_assoc($cat) ) {
   $idcategoria = $categoria['idcategoria'];	
   $sql_longa = mysqli_query($con,"SELECT i.numero  
                        FROM inscricao i 
                          join atleta p ON i.atleta_cpf = p.cpf
                          join categoria c on c.idcategoria = i.categoria_idcategoria 
                   WHERE i.etapa_idetapa = $etapa 
                   AND i.tempo <> '00:00:00' 
                   AND c.idcategoria = $idcategoria
                   order by i.tempo");  
   
   #Atualizando as posições da prova longa por categoria
   while ($row = mysqli_fetch_assoc($sql_longa)){
      $num_atleta=$row['numero'];
      mysqli_query($con,"UPDATE inscricao SET podio_longa=$podio WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
      $podio++;
   } 

   #Atualizando as posições da prova longa por categoria - DNF
   $podio++;
   $sql_longa_dnf = mysqli_query($con,"SELECT i.numero  
                        FROM inscricao i 
                          join atleta p ON i.atleta_cpf = p.cpf
                          join categoria c on c.idcategoria = i.categoria_idcategoria 
                   WHERE i.etapa_idetapa = $etapa 
                   AND c.idcategoria = $idcategoria
                   AND i.tempo = '00:00:00' #DNF 
                   order by i.tempo");  
   while ($row = mysqli_fetch_assoc($sql_longa_dnf)){
      $num_atleta=$row['numero'];
      mysqli_query($con,"UPDATE inscricao SET podio_longa=$podio WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
   }

   #Atualizando as posições da prova tecnica por categoria.
   $podio = 1;
   $sql_tecnica = mysqli_query($con,"SELECT i.numero  
                    FROM inscricao i 
                      join atleta p on p.cpf = i.atleta_cpf
                      join categoria c on c.idcategoria = i.categoria_idcategoria
                    WHERE i.etapa_idetapa = $etapa 
                    AND c.idcategoria = $idcategoria
                    and i.podio_tecnica <> 0 
                    order by i.podio_tecnica");  
   while ($row = mysqli_fetch_assoc($sql_tecnica)){
      $num_atleta=$row['numero'];
      mysqli_query($con,"UPDATE inscricao SET podio_tecnica=$podio WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
      $podio++;
   }
}

echo "<script>alert('RESULTADO CBSUP !!');</script>";
echo "<meta http-equiv='refresh' content='0, url=./resultado_cbsup.php'>";

?>
