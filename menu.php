<?php
require_once "config.php";

// Latest etapa, used by the etapa menu links
$etapa_atual = mysqli_fetch_assoc(mysqli_query($con, "SELECT idetapa FROM etapa ORDER BY idetapa DESC LIMIT 1"));
$id_etapa_atual = $etapa_atual['idetapa'] ?? '';
?>

<html>
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title><?=$titulo?></title>
   <link rel="stylesheet" href="css/bootstrap.css">
   <style>
       #menu {
           text-align: center;
       }
       #menu .nav {
           display: inline-block;
           float: none;
           position: static;
           margin: 0;
           text-align: left;
       }
       #menu .nav > li {
           float: none;
           display: inline-block;
           vertical-align: middle;
       }
   </style>
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
      <li><a href="index.php">HOME</a></li>
      <li class="dropdown">
		   <a href="#" class="dropdown-toggle" data-toggle="dropdown">ATLETA</a>
          <ul class="dropdown-menu">
		        <li><a href="novo_atleta.php">NOVO </a></li>
            <li class="divider"></li>
            <li><a href="listar_atleta.php">LISTAR ATLETAS</a></li>
          </ul>
	    </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ETAPA</span></a>
          <ul class="dropdown-menu">
                 <li><a href="inscritos.php">INSCRITOS</a></li>
                 <li><a href="reg_chegada.php?id=<?= $id_etapa_atual ?>">CHEGADA LONGA</a></li>
                 <li><a href="reg_chegada_tecnica.php?id=<?= $id_etapa_atual ?>">CHEGADA TECNICA</a></li>
                 <li><a href="reg_chegada_canoa.php?id=<?= $id_etapa_atual ?>">CHEGADA CANOA</a></li>
                 <li><a href="gerar_resultado_cbsup.php?id=<?= $id_etapa_atual ?>">GERAR RESULTADO FINAL</a></li>
                 <li class="divider"></li>
                 <li><a href="nova_etapa.php">NOVA ETAPA</a></li>
         </ul>
      </li>

      <li><a href="classifica.php">RESULTADOS</a></li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">RANKING</span></a>
          <ul class="dropdown-menu">
            <li><a href="ranking_categoria_2025.php">RANKING ABASUP 2025</a> </li>                        
            <li><a href="ranking_cbsup_2025.php">RANKING CBSUP 2025</a> </li>
      </li> 
 
      </li>   

    </ul>
</div>
</body>
</html>
