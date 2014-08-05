<?php
require_once "config.php";
?>


<?php

$contador = 1;
$categoria = mysql_query("select id_categoria from categoria");
while ($id_categoria = mysql_fetch_assoc($categoria)){
$result  = mysql_query ("select id_participante, tempo from inscricao where id_etapa = 2 and id_categoria=$id_categoria[id_categoria] and tempo is not null order by tempo");
 while ($pontua = mysql_fetch_assoc($result)){

  switch ($contador){
    case 1:
	  mysql_query ("update ranking_brasileiro set pontos = pontos + 925 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 2:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 913 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 3:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 900 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 4:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 888 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 5:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 875 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 6:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 863 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	  
	case 7:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 850 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 8:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 838 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 9:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 829 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 10:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 821 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	
	case 11:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 813 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;		  
	 case 12:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 804 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	
	 case 13:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 796 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
     case 14:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 788 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;		  
	 case 15:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 779 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	
	 case 16:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 771 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	  
	 case 17:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 763 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
     case 18:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 754 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;		  
	 case 19:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 746 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	
	 case 20:
      mysql_query ("update ranking_brasileiro set pontos = pontos + 738 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	
  }
  $contador++;
 }
 $contador = 1;
}
echo "<script>alert('ETAPA PONTUADA NO BRASILEIRO!! ');</script>";
echo "<meta http-equiv='refresh' content='0, url=./classifica.php'>";
?>