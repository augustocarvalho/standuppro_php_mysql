<?php
# >> Defina o título do site
   $titulo="Circuito ABASUP - 2019";


   
# >> Dados do mySql
   $user="root"; # usuário do mySql
   $pass=""; # senha do mySql
   $bd="circuito"; # nome do banco de dados
   
# >> Conexão
   $con = mysqli_connect("localhost", $user, $pass) or die ("Banco de Dados Morreu");
   $banco = mysqli_select_db($con, $bd) or die ("Db não selecionada");
   mysqli_query($con,"SET NAMES 'utf8'");
   mysqli_query($con,'SET character_set_connection=utf8');
   mysqli_query($con,'SET character_set_client=utf8');
   mysqli_query($con,'SET character_set_results=utf8');


?>






