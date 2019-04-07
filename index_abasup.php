<?php
require_once "config.php";
require_once "menu.php";
?>

<html>

    <style>
     body {
			background: -moz-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
    		background: -webkit-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
    		background: -webkit-gradient(linear, 45deg, from(rgba(42, 27, 161, 0.6)), to(rgba(29, 210, 177, 0.6)));
    		background: -o-linear-gradient(45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%);
    		background: linear-gradient(to 45deg, rgba(42, 27, 161, 0.6), rgba(29, 210, 177, 0.6) 100%); 
      }

          /* Carousel base class */
    .carousel {
      margin-bottom: 60px;
    }

    .carousel .container {
      position: relative;
      z-index: 9;
    }

    .carousel-control {
      height: 80px;
      margin-top: 0;
      font-size: 120px;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      background-color: transparent;
      border: 0;
      z-index: 10;
    }

    .carousel .item {
      height: 500px;
    }
    .carousel img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 500px;
    }

    .carousel-caption {
      background-color: transparent;
      position: static;
      max-width: 550px;
      padding: 0 20px;
      margin-top: 200px;
    }
    .carousel-caption h1,
    .carousel-caption .lead {
      margin: 0;
      line-height: 1.25;
      color: #001471;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
    }
    .carousel-caption .btn {
      margin-top: 10px;
    }

    #footer {
    background-color: #2527486e;
    font-size: large;
    font-style: italic;
    font-family: -webkit-pictograph;
    }
    </style>
<body>
  <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
 <div class="container">
 <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <img src="./itacimirim_2018_1.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Primeira Etapa 2018</h1>
              <p class="lead">Ínicio de temporada aconteceu em Itacimim/Ba no SuperSUP ABASUP 2018</p>
              <a class="btn btn-large btn-primary" href="./resultado_cbsup.php?id=20">Resultado Geral</a>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="./itacimirim_2018_2.jpg" alt="">
          <div class="container">
            <div class="carousel-caption">
              <h1>Ranking 2018</h1>
              <p class="lead">Ocorreu a Premiação dos melhores de 2017, e o início do novo ranking 2018 entre os filiados ABASUP.</p>
              <a class="btn btn-large btn-primary" href="./ranking_categoria_2018.php">Ranking 2018</a>
            </div>
          </div>
        </div>
        
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->
</div>

    <div id="footer">
      <div class="container">
        <div class="footer-copyright text-center py-3">Developed by Augusto Carvalho:
          <a href="http://standuppro.com.br/"> StandupPRO.com.br</a>
        </div>
      </div> 
    </div>



</body>

</html>
