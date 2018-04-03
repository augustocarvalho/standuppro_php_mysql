<?php
  require_once "config.php";
  require_once "menu.php";
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    	$sql = mysqli_query($con, "SELECT filiacao_abasup_2018 FROM atleta WHERE cpf=$id");
        while ($row = mysqli_fetch_assoc($sql)){
         if ($row[filiacao_abasup_2018] == 0) { 
          mysqli_query($con, "UPDATE atleta SET filiacao_abasup_2018 = true WHERE cpf=$id");
          echo "<script>alert('Filiação Realizada com Sucesso');</script>";
          echo "<meta http-equiv='refresh' content='0, url=./listar_atleta.php'>";
         } else {
          mysqli_query($con, "UPDATE atleta SET filiacao_abasup_2018 = false WHERE cpf=$id");
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
