<?php
require_once "config.php";
require_once "menu.php";
?>

<html>
<head>
<style>
   	     body {
			background: -moz-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
    		background: -webkit-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
    		background: -webkit-gradient(linear, 45deg, from(rgba(42, 27, 161, 0.6)), to(rgba(29, 210, 177, 0.6)));
    		background: -o-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
    		background: linear-gradient(to 45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%); 
      }
  
</style>

</head>

<body>


<div class="container">

     <div class="hero-unit">
        <h1>Aloha</h1>
        <p>O StandupPRO, desenvolvido em colaboração com a Associação Bahiana de Standup Paddle - ABASUP, oferece agilidade na apuração de resultados e pontuação de ranking para eventos de standup paddle. </p>
        <div class="pull-right">
          <a href="#"><img src="standuppro.png" style="height: 100px"></a>
        </div>
        <p> Acompanhe os eventos dos clubes abaixo:
        <p>
         <a href="./ranking_categoria_2024.php" style="padding-right:70px"><img src="logo_2018.png"></a>                          
         <a href="./ranking_cbsup_2024.php" href="/cbsup"><img src="cbsup_logo_blue.png"></a>
        </p>
      </div>
      <footer>
        <p>by AugustoCarvalho</p>
        <p>Contato: abasup.standuppro@gmail.com </p>
      </footer>
</div>

</body>
</html>
