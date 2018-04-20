<?php
include 'config.php';
$ultima_etapa = mysqli_query($con, "SELECT max(idetapa) as idetapa FROM etapa");
while ($row_etapa = mysqli_fetch_assoc($ultima_etapa)) {
  $etapa = $row_etapa['idetapa'];
} #DEFINIR QUAL ETAPA DESEJA GERAR RESULTADO
$cat = mysqli_query($con,"SELECT idcategoria FROM categoria order by idcategoria");
while ($categoria = mysqli_fetch_assoc($cat) ) {
   
   $idcategoria = $categoria['idcategoria'];	

   # CALCULO DE PODIO DNF POR CATEGORIA
   $sql_dnf = mysqli_query($con,"SELECT count(numero) as qnt_inscritos FROM inscricao i
                                      WHERE i.etapa_idetapa = $etapa 
                                        AND i.categoria_idcategoria = $idcategoria");
    while ($row = mysqli_fetch_assoc($sql_dnf)){
      $podio_dnf = $row['qnt_inscritos'] + 1;
    }

   $sql_longa = mysqli_query($con,"SELECT i.numero  
                        FROM inscricao i 
                          join atleta p ON i.atleta_cpf = p.cpf
                          join categoria c on c.idcategoria = i.categoria_idcategoria 
                   WHERE i.etapa_idetapa = $etapa 
                   AND i.tempo <> '00:00:00' 
                   AND c.idcategoria = $idcategoria
                   order by i.tempo");  
   
   #Atualizando as posições da prova longa por categoria
   $podio = 1;
   while ($row = mysqli_fetch_assoc($sql_longa)){
      $num_atleta=$row['numero'];
      mysqli_query($con,"UPDATE inscricao SET podio_longa=$podio WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
      $podio++;
   } 

   #Atualizando as posições da prova longa por categoria - DNF
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
      mysqli_query($con,"UPDATE inscricao SET podio_longa=$podio_dnf WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
   }

   #Atualizando as posições da prova tecnica por categoria.
   $podio = 1;
   $sql_tecnica = mysqli_query($con,"SELECT i.numero  
                    FROM inscricao i 
                      join atleta p on p.cpf = i.atleta_cpf
                      join categoria c on c.idcategoria = i.categoria_idcategoria
                    WHERE i.etapa_idetapa = $etapa 
                    AND c.idcategoria = $idcategoria
                    and i.tempo_t <> '00:00:00' 
                    order by i.tempo_t");  
   while ($row = mysqli_fetch_assoc($sql_tecnica)){
      $num_atleta=$row['numero'];
      mysqli_query($con,"UPDATE inscricao SET podio_tecnica=$podio WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
      $podio++;
   }

   
   #Atualizando as posições da prova Tecnica por categoria - DNF

    $sql_tecnica = mysqli_query($con,"SELECT i.numero  
                    FROM inscricao i 
                      join atleta p on p.cpf = i.atleta_cpf
                      join categoria c on c.idcategoria = i.categoria_idcategoria
                    WHERE i.etapa_idetapa = $etapa 
                    AND c.idcategoria = $idcategoria
                    and (i.tempo_t = '00:00:00' or i.tempo_t is null) 
                    order by i.tempo_t");  
   while ($row = mysqli_fetch_assoc($sql_tecnica)){
      $num_atleta=$row['numero'];
      mysqli_query($con,"UPDATE inscricao SET podio_tecnica=$podio_dnf WHERE etapa_idetapa=$etapa AND numero=$num_atleta AND categoria_idcategoria = $idcategoria");
   }
}

echo "<meta http-equiv='refresh' content='0, url=./resultado_cbsup.php'>";

?>
