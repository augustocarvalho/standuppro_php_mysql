<?php
  require_once "config.php";
  require_once "menu.php";
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    	$sql = mysqli_query($con, "SELECT count(*) as filiado FROM filiacao WHERE atleta_cpf=$id and ano=2020");
        while ($row = mysqli_fetch_assoc($sql)){
         if ($row[filiado] == 0) { 
          $categoria = mysqli_query($con, "SELECT categoria_idcategoria FROM atleta where cpf=$id");
          while ($row_2 = mysqli_fetch_assoc($categoria)){
           if ( $row_2[categoria_idcategoria] <> 0 ) { 
              mysqli_query($con, "INSERT INTO filiacao (atleta_cpf, categoria_idcategoria, ano) 
                VALUES ('$id',  $row_2[categoria_idcategoria], 2020 )");
              echo "<script>alert('Filiação Realizada com Sucesso');</script>"; 
              echo "<meta http-equiv='refresh' content='0, url=./filiados.php'>";
            } else {
              echo "<script>alert('FAVOR CADASTRAR CATEGORIA PARA O ATLETA');</script>"; 
              echo "<meta http-equiv='refresh' content='0, url=./listar_atleta.php'>";
            }
          }
          
         } else {
          mysqli_query($con, "DELETE FROM filiacao WHERE atleta_cpf = '$id' and ano = 2020");
          echo "<script>alert('Filiação ENCERRADA com Sucesso');</script>";
          echo "<meta http-equiv='refresh' content='0, url=./listar_atleta.php'>";
         } 
        } 
    }
    else {
		echo "<script>alert('ATLETA NAO FOI FILIADO!!!');</script>";
        echo "<meta http-equiv='refresh' content='0, url=./listar_atleta.php'>";
    }  
    

?>
