<?php
require_once "config.php";
require_once "menu.php";
?>

<html>
<head>
     <meta http-equiv="Content-Type" content="text/html, charset=utf-8">
     <title><?=$titulo?></title>
	 <link rel="stylesheet" type="text/css" href="style.css">
</head>

<div id="cadastro">
 <body>
 <td> <H1 align="center"> <font color="778899" >CHEGADA</H1>  </td>
   <table id="form_table">
    <form  method="post" action="?go=chegar"> 
	  <tr>
	  <td> Etapa: </td>
      <td> <select name="etapa" id="etapa" class="txt" > 
		<option value="02">BAHIA SUP ECO 2014</option>
        <option value="01">SALINAS DAS MARGARIDAS</option>
		</td>
	  
	</tr>  
	 <tr>  
	   <td> Número de Inscrição: </td>
       <td> <input type="number" name="inscricao" class="txt" id="inscricao"/> </td>
	</tr>
	<tr>
	  <td> Tempo: </td>
	   <td> <input type="setime" name="time" id="time" class="txt" /> </td>
    </tr>
    <tr>
        <td colspan="2"> 
           <input type="button" value="Inicio" class="btn" style="font-weight:bold" onclick="location. href='./index.php' "> 
		   <input type="submit" value="Registrar" class="btn" style="font-weight:bold" id="btnCad">
		   <input type="button" value="ABASUP" class="btn" style="font-weight:bold" onclick="location. href='./ranking.php' ">
		   <input type="button" value="ABSUP" class="btn" style="font-weight:bold" onclick="location. href='./rankingBrasileiro.php' ">
		</td>
    </tr>  
	</form>
   </table>
  </body>
</div>  
</html>

<?php

if (@$_GET['go'] == 'chegar'){
  $id_etapa = $_POST['etapa'];
  $cod_inscricao = $_POST['inscricao']; 
  $tempo = $_POST['time'];
  $inscricao = mysql_query ("select cod_inscricao from inscricao where cod_inscricao='$cod_inscricao'");
  if (mysql_num_rows ($inscricao) == 0) {
    echo "<script>alert('INSCRIÇÃO NÃO EXISTE');</script>";
    echo "<meta http-equiv='refresh' content='0, url=./chegada.php'>";
  }else {
   mysql_query("UPDATE inscricao SET tempo='$tempo' where cod_inscricao='$cod_inscricao' and id_etapa='$id_etapa'");
  
        
  $coluna = 1;
  $sql_categoria = mysql_query ("select c.id_categoria, c.nome_categoria  from inscricao i join categoria c where i.id_etapa=$id_etapa and i.cod_inscricao=$cod_inscricao and i.id_categoria = c.id_categoria");
  while ($categoria = mysql_fetch_assoc($sql_categoria)){
    echo "<table cellpadding=10 border=1 id=form_relatorio>";  
    echo "<tr>";
	echo "<td>";
	echo "<B>". " ----------- " . $categoria['nome_categoria'].  " ----------- "  ."</b>";
    echo "</td>";
	echo "</tr>";  
   $sql = mysql_query (" select p.nome_participante, p.estado, i.tempo, i.cod_inscricao from inscricao i join participante p where  i.id_etapa=$id_etapa and i.id_categoria=$categoria[id_categoria] and i.id_participante=p.id_participante");
   while ($exibe = mysql_fetch_assoc($sql)){
	 echo "<tr>";
	 echo "<td>";
     if ($cod_inscricao == $exibe['cod_inscricao']) {
	  echo "<B>";
	  echo $coluna++ . "    -          ";
	  echo $exibe['nome_participante'] . "  (" . $exibe['estado'] . ")" . "        -------                 "   . $exibe['tempo'] ; 
	  echo "</b>";
	 }
	 else {
	   echo $coluna++ . "    -          ";
	   echo $exibe['nome_participante'] . "  (" . $exibe['estado'] . ")" . "        -------                 "   . $exibe['tempo']; 
	 }
	 echo "</td>";
	 echo "</tr>";
	 echo "<br>";
	}
	$coluna = 1;  
	echo "</table>";
	 echo "<br>";
   }	
  }	
}   

?>

