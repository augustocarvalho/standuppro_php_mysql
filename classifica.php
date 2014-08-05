<?php
require_once "config.php";
?>

<html>
<head>
     <meta http-equiv="Content-Type" content="text/html, charset=utf-8">
     <title><?=$titulo?></title>
	 <link rel="stylesheet" type="text/css" href="style.css">
</head>

<html>
<div id="cadastro">
  <body>
    <table id="form_selecao">
	<form  method="post" > 
	<tr>
	  <td> Etapa: </td>
           <td> <select name="etapa" id="etapa" class="txt" > 
		  <option value="02">BAHIA SUP ECO 2014</option>
		   <option value="01">SALINAS DAS MARGARIDAS</option>
      </td>
	  <td>
	      <input type="submit" name="action" value="PÓDIO" style="font-weight:bold" class="btn" id="btnCad">
	      <input type="button" value="INÍCIO" class="btn" style="font-weight:bold" onclick="location. href='./index.php' ">
	  </td>	  
	</tr> 
    <tr>
	  <td> Categoria: </td>
      <td> <select name="categoria" id="categoria" class="txt" >
        <option value="00"> GERAL</option>
		<option value="01"> KIDS MASCULINO</option>
        <option value="02">KIDS FEMININO</option>
        <option value="03">JUNIOR MASCULINO</option>
		<option value="04"> JUNIOR FEMININO</option>
        <option value="05">FUN RACE MASCULINO</option>
        <option value="06">FUN RACE MASCULINO MASTER</option>
		<option value="07"> FUN RACE MASCULINO GRAN MASTER</option>
        <option value="08">FUN RACE FEMININO</option>
        <option value="09">FUN RACE FEMININO MASTER</option>
		<option value="10"> FUN RACE FEMININO GRAN MASTER</option>
        <option value="11">RACE AMADOR MASCULINO</option>
        <option value="12">RACE AMADOR FEMININO</option>
		<option value="13"> RACE MASCULINO PROFISSIONAL</option>
        <option value="14">RACE FEMININO PROFISSIONAL</option>
        <option value="15">RACE MASTER</option>
		<option value="16">RACE GRAN MASTER</option>
		<option value="17">RACE 14</option>
		<option value="18">UNLIMIT</option>
		<option value="19">PADDLE BOARD MASCULINO</option>
		<option value="20">CANOA HAVAIANA</option>
		<option value="21">PADDLE BOARD FEMININO</option>
      </select> </td>
     <td>
	   <input type="submit" name="action" value="ABASUP" class="btn" style="font-weight:bold" onclick="location. href='./classifica.php?go=abasup' ">
	   <input type="submit" name="action" value="ABSUP" class="btn" style="font-weight:bold" onclick="location. href='./classifica.php?go=absup' ">
	 </td>
	 </tr>
	  
	 </form>
	 </table>
		 
	</body>
</div>	
</html>


<?php
if (@$_POST['action'] == 'ABASUP'){
    $contador = 1;
    $id_categoria = $_POST['categoria'];
	$sql = mysql_query("select nome_participante, estado, pontos from ranking r join participante p  where r.id_categoria=$id_categoria and r.id_participante=p.id_participante order by pontos DESC");
    $sql_categoria = mysql_query("select nome_categoria from categoria  where id_categoria=$id_categoria");

  echo "<table cellpadding=10 border=1 id=form_relatorio>";
  while ($categoria = mysql_fetch_assoc($sql_categoria)){
    echo "<tr>";
	echo "<td>";
	echo "<B>".$categoria['nome_categoria'].  " -- ABASUP" . "</b>";
    echo "</td>";
	echo "</tr>";  
  }
	echo "<table cellpadding=10 border=1 id=form_relatorio>";
	while ($exibe = mysql_fetch_assoc($sql)){
	    echo "<tr>";
		echo "<td>";
		echo $contador++ . "    -          ";
		echo $exibe['nome_participante'] . "  (" . $exibe['estado'] . ")" . " ------- "   . $exibe['pontos']; 
		echo "</td>";
		echo "</tr>";
	}
	echo "<br>";
	echo "<br>";
	echo "</table>";

}
?>

<?php
if (@$_POST['action'] == 'PÓDIO'){
	$id_etapa = $_POST['etapa'];		
	$id_categoria = $_POST['categoria'];
	$coluna = 1;
	
	$etapa = mysql_query ("select  local  from etapa where id_etapa=$id_etapa");
	
	if ($id_categoria > 0) {
		$sql = mysql_query("select nome_participante, estado, tempo from inscricao i join participante p  where i.id_etapa=$id_etapa and i.id_categoria=$id_categoria and i.id_participante=p.id_participante and tempo is not null order by tempo");
        $sql_categoria = mysql_query("select nome_categoria from categoria  where id_categoria=$id_categoria");	
       echo "<table cellpadding=10 border=1 id=form_relatorio>";
       while ($categoria = mysql_fetch_assoc($sql_categoria)){
	       	echo "<tr>";
			echo "<td>";
			while ($nome_etapa = mysql_fetch_assoc($etapa)){
			  echo "<B>".$categoria['nome_categoria'] . " ---- " . $nome_etapa['local'] . "</b>";
			}
			echo "</td>";
			echo "</tr>";
            echo "</table>";			
		echo "<table cellpadding=10 border=1 id=form_relatorio>";
		while ($exibe = mysql_fetch_assoc($sql)){
			echo "<tr>";
			echo "<td>";
			echo $coluna++ . "    -          ";
			echo $exibe['nome_participante'] . "  (" . $exibe['estado'] . ")" . "        -------                 "   . $exibe['tempo']; 
			echo "</td>";
			echo "</tr>";
		}
		 echo "<br>";
		 echo "<br>";
		  echo "</table>";
		}
		 
	} else {
	  echo "<table cellpadding=10 border=1 id=form_relatorio>";
		   while ($nome_etapa = mysql_fetch_assoc($etapa)){
		      echo "<tr>";
			  echo "<td>";
			  echo "<B>". " GERAL" . " ---- " . $nome_etapa['local'] . "</b>";
			  echo "</td>";
			  echo "</tr>";
		    }
		echo "</table>"	;
		echo "<br>";
		echo "<br>";
			
	  
	  $sql = mysql_query("select nome_participante, estado, tempo, c.nome_categoria from inscricao i join participante p  join categoria c where i.id_etapa=$id_etapa and i.id_categoria=c.id_categoria and i.id_participante=p.id_participante and tempo is not null order by tempo");
	  echo "<table cellpadding=10 border=1 id=form_relatorio>";	
   	  while ($exibe = mysql_fetch_assoc($sql)){
			echo "<tr>";
			echo "<td>";
			echo $coluna++ . "    -          ";
			echo $exibe['nome_participante'] . "  (" . $exibe['estado'] . ")" . "        -------                 "   . $exibe['tempo'] . " --------- " . $exibe['nome_categoria'] ; 
			echo "</td>";
			echo "</tr>";
		}
	 }
  
}   
?>

