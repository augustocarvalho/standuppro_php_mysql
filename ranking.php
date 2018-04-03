<?php
require_once "config.php";
?>

<?php

#LEMBRAR DE EXECUTAR O JUNIOR SEPARADO POIS EXISTEM ATLETAS EM DUAS CATEGORIAS.
# categoria_idcategoria in (3,4)
# demais categoria_idcategoria in (1,2,5,6,7,8,9,10,11,12,13,14,15,16,17,22,23,24,25,26,27,28,29,30,31,32)

#(1,2,3,4) kids, Jr
#(5,6,7,8,9,10) FunRace
#(11,12,24,25,26,27) Race Amador
#(23,16,22,15,14,13,28,32,31,17,30,29) Race12 e 14 PRO




$etapa=19;

$contador = 1;
$categorias = mysql_query ("SELECT distinct(categoria_idcategoria) FROM inscricao WHERE etapa_idetapa=$etapa and tempo <> '00:00:00' 
                            and categoria_idcategoria in (1,2,3,4) order by 1");
while ($id_categoria = mysql_fetch_assoc($categorias)){
$ordenar = mysql_query(
"SELECT
 i.atleta_cpf
    FROM inscricao i 
     JOIN atleta a ON a.cpf = i.atleta_cpf
WHERE etapa_idetapa = $etapa and tempo <> '00:00:00' and categoria_idcategoria = $id_categoria[categoria_idcategoria]
order by tempo") ;
$colocacao = 1;
while ($pontua = mysql_fetch_assoc($ordenar)){ 
  switch ($colocacao){
    case 1:
       mysql_query ("update ranking set pontos = 900 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");   
       break;
     case 2:
      mysql_query ("update ranking set pontos = 888 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 3:
      mysql_query ("update ranking set pontos = 875 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 4:
      mysql_query ("update ranking set pontos = 863 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 5:
      mysql_query ("update ranking set pontos = 850 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 6:
      mysql_query ("update ranking set pontos = 838 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
     case 7:
      mysql_query ("update ranking set pontos = 829 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 8:
      mysql_query ("update ranking set pontos = 821 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 9:
      mysql_query ("update ranking set pontos = 813 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 10:
      mysql_query ("update ranking set pontos = 804 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     case 11:
      mysql_query ("update ranking set pontos = 796 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 12:
      mysql_query ("update ranking set pontos = 788 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 13:
      mysql_query ("update ranking set pontos = 779 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 14:
      mysql_query ("update ranking set pontos = 771 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 15:
      mysql_query ("update ranking set pontos = 763 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 16:
      mysql_query ("update ranking set pontos = 754 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
      case 17:
      mysql_query ("update ranking set pontos = 746 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 18:
      mysql_query ("update ranking set pontos = 738 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 19:
      mysql_query ("update ranking set pontos = 729 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 20:
      mysql_query ("update ranking set pontos = 721 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 21:
      mysql_query ("update ranking set pontos = 713 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     case 22:
      mysql_query ("update ranking set pontos = 704 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 23:
      mysql_query ("update ranking set pontos = 696 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 24:
      mysql_query ("update ranking set pontos = 688 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 25:
      mysql_query ("update ranking set pontos = 679 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 26:
      mysql_query ("update ranking set pontos = 671 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
      case 27:
      mysql_query ("update ranking set pontos = 663 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;    
      case 28:
      mysql_query ("update ranking set pontos = 654 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;
     case 29:
      mysql_query ("update ranking set pontos = 646 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;         
      case 30:
      mysql_query ("update ranking set pontos = 638 , colocacao = $colocacao WHERE atleta_cpf = $pontua[atleta_cpf] AND categoria_idcategoria = $id_categoria[categoria_idcategoria] and etapa_idetapa = $etapa");    
       break;  
     }; 
     $colocacao++;   
  };
  
};
echo "<script>alert('ETAPA PONTUADA NO BAHIANO!! ');</script>";
echo "<meta http-equiv='refresh' content='0, url=./ranking_categoria.php'>";
?>