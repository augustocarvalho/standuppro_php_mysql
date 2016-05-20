<?php

   $count = 0;
	$row = mysql_query("select * from inscricao where id_etapa=2");
	while  ($existe=mysql_fetch_assoc($row) ){
		$ranking = mysql_query("select * from ranking where id_participante=$existe[id_participante] and id_categoria=$existe[id_categoria] ");
        if (mysql_num_rows($ranking) > 0) {
		 $count++; 
		}
     }	
    echo $count;
?>