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
    


<div class="navbar" id="menu">
  <div class="navbar-inner">
    <ul class="nav">
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
                 <li><a href="inscritos.php?id=20">INSCRITOS</a></li>
                 <li><a href="reg_chegada.php?id=20">CHEGADA LONGA</a></li>
                 <li><a href="reg_chegada_tecnica.php?id=20">CHEGADA TECNICA</a></li>
         </ul>
      </li>

      <li class="dropdown">
       <a href="classifica.php">RESULTADOS</a> </li>
      </li> 
      <li class="dropdown">
       <a href="ranking_categoria.php">RANKING 2017</a> </li>
      </li> 
      
      </li>   
    </ul>
   </div>
   </div>
  </div> 
  </div>
 </div>
</body>
</html>
