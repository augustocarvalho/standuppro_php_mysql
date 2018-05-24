<?php
require_once "config.php";
?>

<html>
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title><?=$titulo?></title>
   <link rel="stylesheet" href="css/bootstrap.css">
     <script src="js/jquery.js"></script>
     <script src="js/jquery_mask.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="js/bootstrap-select.js"></script>
   <script type="text/javascript">
    $(document).ready(function(){
      $('.time').mask('00:00:00');
    })
   </script>


</head>
<body>
    


<div class="navbar navbar-fixed-top navbar-inverse" id="menu">
    <ul class="nav nav-pills">
      <li><a href="http://abasup.com.br" target="_blank"><img src="logo_2018.png"></a></li>
      <li><a href="index.php">HOME</a></li>
      <li class="dropdown">
		   <a href="#" class="dropdown-toggle" data-toggle="dropdown">ATLETA</a>
          <ul class="dropdown-menu">
		        <li><a href="novo_atleta.php">NOVO </a></li>
            <li class="divider"></li>
            <li><a href="listar_atleta.php">LISTAR ATLETAS</a></li>
            <li class="divider"></li>
            <li><a href="filiados.php">FILIADOS 2018</a></li>
          </ul>
	    </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ETAPA</span></a>
          <ul class="dropdown-menu">
                 <li><a href="inscritos.php?id=21">INSCRITOS</a></li>
                 <li><a href="reg_chegada.php?id=21">CHEGADA LONGA</a></li>
                 <li><a href="reg_chegada_tecnica.php?id=21">CHEGADA TECNICA</a></li>
                 <li><a href="gerar_resultado_cbsup.php">GERAR RESULTADO FINAL</a></li>
         </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">RESULTADOS</span></a>
          <ul class="dropdown-menu">
                 <li><a href="resultado_cbsup.php?id=20">2018 - PRIMEIRA ETAPA</a></li> 
                 <li class="divider"></li>
                 <li><a href="classifica.php">2017 / 2016 / 2015</a></li>
         </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">RANKING</span></a>
          <ul class="dropdown-menu">
            <li><a href="ranking_categoria_2018.php">RANKING 2018</a> </li>
            <li class="divider"></li>
            <li><a href="ranking_categoria.php">RANKING 2017</a> </li>
      </li> 
 
      </li>   

    </ul>
</div>
</body>
</html>
