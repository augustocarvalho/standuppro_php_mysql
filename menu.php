<?php
require_once "config.php";
?>

<html>
<head>
     <meta http-equiv="Content-Type" content="text/html, charset=utf-8">
     <title><?=$titulo?></title>
	 <link rel="stylesheet" href="css/bootstrap.css">
     <script src="js/jquery.js"></script>
	 <script src="js/bootstrap.js"></script>
   <script src="js/bootstrap-select.js"></script>
</head>
<body>
    


<div class="navbar" id="menu">
  <div class="navbar-inner">
    <ul class="nav">
      <li><a href="index.php">HOME</a></li>
      
      <li class="dropdown">
		   <a href="#" class="dropdown-toggle" data-toggle="dropdown">ATLETA<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
		        <li><a href="novo_atleta.php">Novo </a></li>
            <li class="divider"></li>
            <li><a href="listar_atleta.php">Listar/Alterar</a></li>
          </ul>
	    </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">ETAPA<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-submenu">
               <a tabindex="-1" href="#">SALINAS DAS MARGARIDAS</a>
                      <ul class="dropdown-menu">
                        <li><a href="inscricao.php?id=1">Inscrição</a></li>
                        <li><a href="reg_chegada.php?id=1">Registrar Chegada</a></li>
                      </ul>
             </li>         
            <li class="divider"></li>
            <li class="dropdown-submenu">
               <a tabindex="-1" href="#">BAHIA SUP ECO 2014</a>
                      <ul class="dropdown-menu">
                        <li><a href="inscricao.php?id=2">Inscrição</a></li>
                        <li><a href="reg_chegada.php?id=2">Registrar Chegada</a></li>
                      </ul>
             </li>
          </ul>
      </li>

       <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">RELATÓRIOS<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
		        <li><a href="classifica.php">Pódio</a></li>
            <li class="dropdown-submenu">
               <a tabindex="-1" href="#">Ranking</a>
                      <ul class="dropdown-menu">
                        <li><a href="ranking_abasup.php">ABASUP</a></li>
                        <li><a href="ranking_absup.php">ABSUP</a></li>
                      </ul>
             </li>         
             <li class="dropdown-submenu">
              <a tabindex="-1" href="#">Inscritos</a>
                <ul class="dropdown-menu">
                    <li><a href="inscritos.php?id=1">SALINAS DAS MARGARIDAS</a></li>
                    <li><a href="inscritos.php?id=2">BAHIA SUP ECO 2014</a></li>
                </ul>
            </li>
          </ul>
	     </li>
      
      </li>   
    </ul>
  </div>
</div>
</body>
</html>
