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
    </style>
<body>
  <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
 <div class="container">
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
          <a href="./inscritos.php?id=21"><img src="Ubatuba2018.jpg" alt="INSCRITOS CONFIRMADOS">
          </a>
         </div>
        
      </div>
    </div><!-- /.carousel -->
</div>

</body>
</html>
