<?php
require_once "config.php";
?>

<?php

<<<<<<< HEAD
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
=======
$contador = 1;
$categoria = mysql_query("select id_categoria from categoria");
while ($id_categoria = mysql_fetch_assoc($categoria)){

				$result  = mysql_query ("select id_participante, tempo from inscricao where id_etapa = 2 and id_categoria=$id_categoria[id_categoria] and tempo is not null order by tempo");
				 while ($pontua = mysql_fetch_assoc($result)) {
						 $existe = mysql_query ("select * from ranking where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria] ");
						 if (($row=mysql_num_rows($existe) ) > 0 ){
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
							 case 11:
							  mysql_query ("update ranking set pontos = pontos + 475 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 12:
							  mysql_query ("update ranking set pontos = pontos + 462 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 13:
							  mysql_query ("update ranking set pontos = pontos + 450 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 14:
							  mysql_query ("update ranking set pontos = pontos + 438 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 15:
							  mysql_query ("update ranking set pontos = pontos + 425 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 16:
							  mysql_query ("update ranking set pontos = pontos + 413 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;	  
							case 17:
							  mysql_query ("update ranking set pontos = pontos + 400 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 18:
							  mysql_query ("update ranking set pontos = pontos + 395 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 19:
							  mysql_query ("update ranking set pontos = pontos + 390 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 20:
							  mysql_query ("update ranking set pontos = pontos + 385 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;	
							case 21:
							  mysql_query ("update ranking set pontos = pontos + 380 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 22:
							  mysql_query ("update ranking set pontos = pontos + 375 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 23:
							  mysql_query ("update ranking set pontos = pontos + 370 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 24:
							  mysql_query ("update ranking set pontos = pontos + 365 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 25:
							  mysql_query ("update ranking set pontos = pontos + 360 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 26:
							  mysql_query ("update ranking set pontos = pontos + 355 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;	  
							case 27:
							  mysql_query ("update ranking set pontos = pontos + 350 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 28:
							  mysql_query ("update ranking set pontos = pontos + 345 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 29:
							  mysql_query ("update ranking set pontos = pontos + 340 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 30:
							  mysql_query ("update ranking set pontos = pontos + 335 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;	  
							 case 31:
							  mysql_query ("update ranking set pontos = pontos + 330 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 32:
							  mysql_query ("update ranking set pontos = pontos + 325 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 33:
							  mysql_query ("update ranking set pontos = pontos + 320 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 34:
							  mysql_query ("update ranking set pontos = pontos + 315 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 35:
							  mysql_query ("update ranking set pontos = pontos + 310 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 36:
							  mysql_query ("update ranking set pontos = pontos + 305 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;	  
							case 37:
							  mysql_query ("update ranking set pontos = pontos + 300 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 38:
							  mysql_query ("update ranking set pontos = pontos + 295 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 39:
							  mysql_query ("update ranking set pontos = pontos + 290 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;
							case 40:
							  mysql_query ("update ranking set pontos = pontos + 285 where id_participante=$pontua[id_participante] and id_categoria=$id_categoria[id_categoria]");	
							  break;	   
						  }
						}else {
						  
						  switch ($contador){
							case 1: 
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','1000'");	
							  break;
							case 2:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','860'");
							  break;
							case 3:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','730'");
							  break;
							case 4:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','670'");
							  break;
							case 5:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','610'");
							  break;
							case 6:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '583'");
							  break;	  
							case 7:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '555'");
							  break;
							case 8:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '528'");
							  break;
							case 9:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','500'");
							  break;
							case 10:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','488'");
							  break;	  
							case 11:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','475'");	
							  break;
							case 12:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','462'");
							  break;
							case 13:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','450'");
							  break;
							case 14:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','438'");
							  break;
							case 15:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','425'");
							  break;
							case 16:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '413'");
							  break;	  
							case 17:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '400'");
							  break;
							case 18:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '395'");
							  break;
							case 19:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','390'");
							  break;
							case 20:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','385'");
							  break;	  
							case 21:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','380'");
							  break;	  
							case 22:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','375'");
							  break;
							case 23:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','370'");
							  break;
							case 24:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','365'");
							  break;
							case 25:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','360'");
							  break;
							case 26:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '355'");
							  break;	  
							case 27:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '350'");
							  break;
							case 28:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '345'");
							  break;
							case 29:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','340'");
							  break;
							case 30:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','335'");
							  break;	  
							case 31:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','330'");	
							  break;
							case 32:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','325'");
							  break;
							case 33:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','320'");
							  break;
							case 34:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','315'");
							  break;
							case 35:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','310'");
							  break;
							case 36:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '305'");
							  break;	  
							case 37:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '300'");
							  break;
							case 38:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria', '295'");
							  break;
							case 39:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','290'");
							  break;
							case 40:
							  mysql_query ("insert into ranking (id_participante, id_categoria, pontos) values('$pontua[id_participante]','$id_categoria','285'");
							  break;
						  }
				        }
					$contador++;
				}
	$contador = 1;
}
echo "<script>alert('ETAPA PONTUADA NO CIRCUITO!! ');</script>";
echo "<meta http-equiv='refresh' content='0, url=./classifica.php'>";
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
?>