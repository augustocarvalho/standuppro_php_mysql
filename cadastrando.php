<?php
require_once "config.php";
?>

<html>
<head>
     <meta http-equiv="Content-Type" content="text/html, charset=utf-8">
     <title><?=$titulo?></title>
	 <link rel="stylesheet" type="text/css" href="style.css">
</head>

<div id="cadastro">
<body>
 <td> <H1 align="center"> <font color="778899" >Novo Atleta</H1>  </td>
 <table id="form_table">	
  <form method="post" action="?go=cadastro"> 
   	<tr>
	     <td> Nome: </td>
	     <td> <input type="text" name="nome" id="nome" class="txt" /> </td>
    </tr>
    <tr>  
	     <td> CPF: </td>
       <td> <input type="number" name="inscricao" class="txt" id="inscricao"/> </td>
	  </tr>  
	  <tr>  
	     <td> EMAIL: </td>
       <td> <input type="txt" name="email" class="txt" id="email"/> </td>
	  </tr>  
    <tr>
	     <td> Estado: </td> 
	     <td> <input type="text" name="estado" id="estado" class="txt" maxlength="2"/></td>
    </tr>
	  <tr>
      <td colspan="2">
        <input type="button" value="INÍCIO"  style="font-weight:bold" class="btn" onclick="location. href='./index.php' "> 
        <input type="submit" value="CADASTRAR" class="btn" style="font-weight:bold" id="btnCad"> 
		    <input type="button" value="INSCRIÇÃO" class="btn" style="font-weight:bold" onclick="location. href='./inscricao.php' "> 
	    </td>
    </tr>  
  </form> 
 </table>
</body>
</div></html>

<?php
if (@$_GET['go'] == 'cadastro'){
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $id_participante = $_POST['inscricao']; 
  $estado = $_POST['estado'];
  $sql_result = mysqli_query($con, "select id_participante from participante where id_participante=$id_participante");
  if (mysqli_num_rows($sql_result) == 0) {
    mysqli_query($con, "insert into participante (id_participante, nome_participante, estado, email) values('$id_participante','$nome','$estado','$email')");
    echo "<script>alert('Cadastro efetuado com sucesso.');</script>";
    echo "<meta http-equiv='refresh' content='0, url=./inscricao.php'>";
  }
  else {
   echo "<script>alert('CPF JÁ CADASTRADO!!!');</script>";
   echo "<meta http-equiv='refresh' content='0, url=./cadastrando.php'>";
  }  
}   


?>