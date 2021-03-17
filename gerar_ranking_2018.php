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
#(5,6,7,8,9,10) FunRace
#(11,12,24,25,26,27,71,72) Race 12'6 Amador
#(53,54,55,56,57,58) Race 14 Amador
#(113,114,115,116) Race Amador
#(23,16,22,15,14,13,28,32,31,17,30,29) Race12 e 14 PRO
#(19,21) Paddle
#(20,33,39,40,43,44,49,73,45,46) Canoa
#(20,39,43,74,33,40,44,49,73,79,80,81,82,83,84,85,86,87,46,93,94,45,95,96,92,97,98,52,59,60,78,61,76,77,88,89,90,90,75)


#INSERIR OS ATLETAS FILIADOS POR ETAPA ANTES DE ATUALIZAR
#INSERT INTO ranking (categoria_idcategoria, atleta_cpf, pontos, etapa_idetapa, colocacao)
#
#SELECT i.categoria_idcategoria, i.atleta_cpf, 0, 42, 0
#FROM atleta a
#JOIN filiacao f ON f.atleta_cpf = a.cpf 
#JOIN inscricao i ON i.atleta_cpf = a.cpf and i.etapa_idetapa = 42
#WHERE f.ano = 2020
#AND (a.categoria_idcategoria = i.categoria_idcategoria or 
#a.categoria_idcategoria in 
# (SELECT i2.categoria_idcategoria 
#    FROM inscricao i2
#      WHERE i2.etapa_idetapa = 42 
#      and i2.numero = i.numero 
#      and i2.categoria_idcategoria <> i.categoria_idcategoria))



$etapa=42;

$contador = 1;
$categorias = mysqli_query($con,"SELECT distinct(categoria_idcategoria) 
                            FROM inscricao WHERE etapa_idetapa=$etapa
                            and categoria_idcategoria in (19,21)
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
  $colocacao = $pontua[podio_longa];  
   switch ($colocacao){
    case 1:
       mysqli_query($con,"UPDATE ranking set pontos = 900 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");   
       break;
     case 2:
      mysqli_query($con,"UPDATE ranking set pontos = 888 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 3:
      mysqli_query($con,"UPDATE ranking set pontos = 875 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 4:
      mysqli_query($con,"UPDATE ranking set pontos = 863 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 5:
      mysqli_query($con,"UPDATE ranking set pontos = 850 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 6:
      mysqli_query($con,"UPDATE ranking set pontos = 838 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
     case 7:
      mysqli_query($con,"UPDATE ranking set pontos = 829 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 8:
      mysqli_query($con,"UPDATE ranking set pontos = 821 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 9:
      mysqli_query($con,"UPDATE ranking set pontos = 813 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 10:
      mysqli_query($con,"UPDATE ranking set pontos = 804 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     case 11:
      mysqli_query($con,"UPDATE ranking set pontos = 796 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 12:
      mysqli_query($con,"UPDATE ranking set pontos = 788 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 13:
      mysqli_query($con,"UPDATE ranking set pontos = 779 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 14:
      mysqli_query($con,"UPDATE ranking set pontos = 771 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 15:
      mysqli_query($con,"UPDATE ranking set pontos = 763 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 16:
      mysqli_query($con,"UPDATE ranking set pontos = 754 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
      case 17:
      mysqli_query($con,"UPDATE ranking set pontos = 746 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 18:
      mysqli_query($con,"UPDATE ranking set pontos = 738 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 19:
      mysqli_query($con,"UPDATE ranking set pontos = 729 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 20:
      mysqli_query($con,"UPDATE ranking set pontos = 721 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 21:
      mysqli_query($con,"UPDATE ranking set pontos = 713 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     case 22:
      mysqli_query($con,"UPDATE ranking set pontos = 704 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 23:
      mysqli_query($con,"UPDATE ranking set pontos = 696 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 24:
      mysqli_query($con,"UPDATE ranking set pontos = 688 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 25:
      mysqli_query($con,"UPDATE ranking set pontos = 679 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 26:
      mysqli_query($con,"UPDATE ranking set pontos = 671 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 27:
      mysqli_query($con,"UPDATE ranking set pontos = 663 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
      case 28:
      mysqli_query($con,"UPDATE ranking set pontos = 654 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 29:
      mysqli_query($con,"UPDATE ranking set pontos = 646 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 30:
      mysqli_query($con,"UPDATE ranking set pontos = 638 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     };
     $colocacao++;   
  };
  
};
echo "<script>alert('ETAPA PONTUADA NO BAHIANO 2019!! ');</script>";
echo "<meta http-equiv='refresh' content='0, url=./ranking_categoria_2020.php'>";
?>