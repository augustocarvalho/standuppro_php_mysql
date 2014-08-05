<?php
# >> Defina o título do site
   $titulo="Circuito SUP - 2014";
   
# >> Dados do mySql
   $user="root"; # usuário do mySql
   $pass=""; # senha do mySql
   $bd="campeonato"; # nome do banco de dados
   
# >> Conexão
   $con = @mysql_connect("localhost", $user, $pass) or die ("Banco de Dados Morreu");
   mysql_select_db($bd, $con) or die ("Db não selecionada");


?>






