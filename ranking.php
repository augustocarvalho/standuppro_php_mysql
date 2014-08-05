<?php
require_once "config.php";
?>


<?php

$contador = 1;
$categoria = mysql_query("select id_categoria from categoria");
while ($id_categoria = mysql_fetch_assoc($categoria)){
$result  = mysql_query ("select id_participante, tempo from inscricao where id_etapa = 1 and id_categoria=$id_categoria[id_categoria] and tempo is not null order by tempo");
 while ($pontua = mysql_fetch_assoc($result)){

  switch ($contador){
    case 1:
	  mysql_query ("update ranking set pontos = pontos + 1000 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 2:
      mysql_query ("update ranking set pontos = pontos + 860 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 3:
      mysql_query ("update ranking set pontos = pontos + 730 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 4:
      mysql_query ("update ranking set pontos = pontos + 670 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 5:
      mysql_query ("update ranking set pontos = pontos + 610 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 6:
      mysql_query ("update ranking set pontos = pontos + 583 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	  
	case 7:
      mysql_query ("update ranking set pontos = pontos + 555 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 8:
      mysql_query ("update ranking set pontos = pontos + 528 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 9:
      mysql_query ("update ranking set pontos = pontos + 500 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;
	case 10:
      mysql_query ("update ranking set pontos = pontos + 488 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
	  break;	  
  }
  $contador++;
 }
 $contador = 1;
}
echo "<script>alert('ETAPA PONTUADA NO CIRCUITO!! ');</script>";
echo "<meta http-equiv='refresh' content='0, url=./classifica.php'>";
?>