<?php
require_once "config.php";

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }


?>

<?php

#LEMBRAR DE EXECUTAR O JUNIOR SEPARADO POIS EXISTEM ATLETAS EM DUAS CATEGORIAS.

#(1,2,3,4) kids, Jr
#(5,6,7,8,9,10, 119, 120) Allboard
#(11,12,24,25,26,27,71,72) Race 12'6 Amador
#(53,54,55,56,57,58) Race 14 Amador
#(113,114,115,116,117,118) Race Amador
#(110,111,112) OC6 MISTA
#(23,16,22,15,14,13,28,32,31,17,30,29,121,122) Race12 e 14 PRO
#(19,21) Paddle
#(20,33,39,40,43,44,49,73,45,46) Canoa
#(20,39,43,74,33,40,44,49,73,79,80,81,82,83,84,85,86,87,46,93,94,45,95,96,92,97,98,52,59,60,78,61,76,77,88,89,90,90,75)



// #INSERIR OS ATLETAS FILIADOS POR ETAPA ANTES DE ATUALIZAR E LEMBRAR DE GERAR RESULTADO FINAL. (gerar_resultado_cbsup.php)
// INSERT INTO ranking (categoria_idcategoria, atleta_cpf, pontos, etapa_idetapa, colocacao)

// SELECT i.categoria_idcategoria, i.atleta_cpf, 0, 62 , 0
// FROM atleta a
// JOIN filiacao f ON f.atleta_cpf = a.cpf 
// JOIN inscricao i ON i.atleta_cpf = a.cpf and i.etapa_idetapa = 62  

// AND (a.categoria_idcategoria = i.categoria_idcategoria or 
// a.categoria_idcategoria in 
// (SELECT i2.categoria_idcategoria 
//    FROM inscricao i2
//      WHERE i2.etapa_idetapa = 59   
//      and i2.numero = i.numero 
//      and i2.categoria_idcategoria <> i.categoria_idcategoria))

// SELECT i.categoria_idcategoria, i.atleta_cpf, 0, 51 , 0
// FROM inscricao i 
// WHERE i.etapa_idetapa = 51  

// SELECT distinct atleta_cpf, categoria_idcategoria, 0,0, 2022, 1
// FROM ranking 
// where etapa_idetapa in (49,48,47,46)
// and categoria_idcategoria = 1





$etapa=64;

$contador = 1;
$categorias = mysqli_query($con,"SELECT distinct(categoria_idcategoria) 
                            FROM inscricao WHERE etapa_idetapa=$etapa
                            and categoria_idcategoria in (20,33,39,40,43,44,49,73,45,46)
                            order by 1");

while ($id_categoria = mysqli_fetch_assoc($categorias)){
$ordenar = mysqli_query($con,"SELECT (podio_longa + podio_tecnica) as geral, podio_longa, podio_tecnica, atleta_cpf, categoria_idcategoria  
FROM inscricao 
where etapa_idetapa = $etapa
AND categoria_idcategoria = $id_categoria[categoria_idcategoria]
order by categoria_idcategoria , geral, podio_longa ") ;
$colocacao = 1;
while ($pontua = mysqli_fetch_assoc($ordenar)){
# In Case Race and Tecnica comentar a linha abaixo 
  $colocacao = $pontua["podio_longa"];  
  switch ($colocacao){
    case 1:
       mysqli_query($con,"update ranking set pontos = 1000 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");   
       break;
     case 2:
      mysqli_query($con,"update ranking set pontos = 988 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 3:
      mysqli_query($con,"update ranking set pontos = 975 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 4:
      mysqli_query($con,"update ranking set pontos = 963 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 5:
      mysqli_query($con,"update ranking set pontos = 950 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 6:
      mysqli_query($con,"update ranking set pontos = 938 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
     case 7:
      mysqli_query($con,"update ranking set pontos = 925 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 8:
      mysqli_query($con,"update ranking set pontos = 913 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 9:
      mysqli_query($con,"update ranking set pontos = 900 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 10:
      mysqli_query($con,"update ranking set pontos = 888 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     case 11:
      mysqli_query($con,"update ranking set pontos = 875 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 12:
      mysqli_query($con,"update ranking set pontos = 863 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 13:
      mysqli_query($con,"update ranking set pontos = 850 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 14:
      mysqli_query($con,"update ranking set pontos = 838 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 15:
      mysqli_query($con,"update ranking set pontos = 829 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 16:
      mysqli_query($con,"update ranking set pontos = 821 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
      case 17:
      mysqli_query($con,"update ranking set pontos = 813 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 18:
      mysqli_query($con,"update ranking set pontos = 804 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 19:
      mysqli_query($con,"update ranking set pontos = 796 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 20:
      mysqli_query($con,"update ranking set pontos = 788 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 21:
      mysqli_query($con,"update ranking set pontos = 779 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     case 22:
      mysqli_query($con,"update ranking set pontos = 771 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 23:
      mysqli_query($con,"update ranking set pontos = 763 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 24:
      mysqli_query($con,"update ranking set pontos = 754 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 25:
      mysqli_query($con,"update ranking set pontos = 746 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 26:
      mysqli_query($con,"update ranking set pontos = 738 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 27:
      mysqli_query($con,"update ranking set pontos = 729 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
      case 28:
      mysqli_query($con,"update ranking set pontos = 721 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 29:
      mysqli_query($con,"update ranking set pontos = 713 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 30:
      mysqli_query($con,"update ranking set pontos = 704 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     };    
  };
  
};
echo "<script>alert('ETAPA PONTUADA NO BAHIANO 2024!! ');</script>";
echo "<meta http-equiv='refresh' content='0, url=./ranking_categoria_2024.php'>";
?>