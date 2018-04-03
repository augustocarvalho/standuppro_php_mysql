<?php
# >> Defina o título do site
<<<<<<< HEAD
   $titulo="Circuito ABASUP - 2018";
=======
   $titulo="Circuito SUP - 2016";
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111


   
# >> Dados do mySql
   $user="root"; # usuário do mySql
   $pass=""; # senha do mySql
   $bd="circuito"; # nome do banco de dados
   
# >> Conexão
   $con = mysqli_connect("localhost", $user, $pass) or die ("Banco de Dados Morreu");
   $banco = mysqli_select_db($con, $bd) or die ("Db não selecionada");


?>






