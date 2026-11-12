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

       /* Scale page content so it lines up with the background artwork
          without requiring browser zoom. */
       .container#cadastro {
           zoom: 1.4;
       }
       .container.my-5 {
           zoom: 1.4;
       }

       @media (min-width: 1900px) {
           .container.my-5 {
               zoom: 2;
           }
       }
       @media (max-width: 1349px) {
           .container#cadastro {
               zoom: 1;
           }
           .container.my-5 {
               zoom: 1.2;
           }
       }
       @media (max-width: 1149px) {
           .container.my-5 {
               zoom: 1;
           }
       }

       /* Keep the atletas title at the same distance from the top of the
          background panel at every width/zoom level. */
       @media (min-width: 1350px) and (max-width: 1899px) {
           .container.my-5 h2 {
               margin-top: calc(7.06vw - 84px);
           }
       }
       @media (min-width: 1150px) and (max-width: 1349px) {
           .container.my-5 h2 {
               margin-top: calc(8.23vw - 81px);
           }
       }
       @media (max-width: 1149px) {
           .container.my-5 h2 {
               margin-top: max(10px, calc(9.88vw - 78px));
           }
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
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">RANKING</a>
          <ul class="dropdown-menu">
            <li><a href="ranking.php">RANKINGS</a></li>
            <li class="divider"></li>
            <li><a href="gerar_ranking.php">GERAR RANKING</a></li>
          </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">SISTEMA</a>
          <ul class="dropdown-menu">
            <li><a href="banco.php">IMPORTAR / EXPORTAR BANCO</a></li>
          </ul>
      </li>

    </ul>
</div>
</body>
</html>
