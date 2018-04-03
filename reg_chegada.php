<?php
  require_once "config.php";
  require_once "menu.php";

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
	 
	 
    if ( !empty($_POST)) {
        // keep track validation errors
        $codError = null;
        $tempoError = null;

        // keep track post values
        $cod = $_POST['cod'];
		$tempo = $_POST['tempo'];
        
         
        // validate input
        $valid = true;
<<<<<<< HEAD
		$result = mysqli_query($con, "select * from inscricao where etapa_idetapa=$id and numero=$cod");
        if (  (empty($cod) ) or (mysqli_num_rows($result)==0) ){
=======
		$result = mysql_query("select * from inscricao where etapa_idetapa=$id and numero=$cod");
        if (  (empty($cod) ) or (mysql_num_rows($result)==0) ){
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
            $codError = 'Inscrição inválida';
            $valid = false;
        }

         if (empty($tempo)) {
            $tempoError = 'Tempo não informado';
            $valid = false;
        }
         
        
        // insert data
        if ($valid) {
<<<<<<< HEAD
	            mysqli_query($con, "UPDATE inscricao SET tempo='$tempo' where numero='$cod' and etapa_idetapa='$id'");
=======
	            mysql_query("UPDATE inscricao SET tempo_t='$tempo' where numero='$cod' and etapa_idetapa='$id'");
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                echo "<script>alert('Cadastro efetuado com sucesso.');</script>";
                echo "<meta http-equiv='refresh' content='0, url=./reg_chegada.php?id=$id'>";
        }
              
    }
?>



<html lang="en">
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3 align="center">Registro de Chegada - PROVA LONGA</h3>
                        <br>
                        <br>
                    </div>
             
                    <form class="form-horizontal" action="reg_chegada.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($codError)?'error':'';?>">
                        <label class="control-label">Inscrição</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="cod" type="text" autofocus  placeholder="Número de Inscrição"value="<?php echo !empty($cod)?$cod:'';?>">
                            <?php if (!empty($codError)): ?>
                                <span class="help-inline"><?php echo $codError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                       <div class="control-group <?php echo !empty($tempoError)?'error':'';?>">
                        <label class="control-label">Tempo</label>
                        <div class="controls">
<<<<<<< HEAD
                            <input style="min-height:35px;" name="tempo" type="text" class="time" placeholder="tempo" value="<?php echo !empty($tempo)?$tempo:'';?>">
=======
                            <input name="tempo" type="text" class="time" placeholder="tempo" value="<?php echo !empty($tempo)?$tempo:'';?>">
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                            <?php if (!empty($tempoError)): ?>
                                <span class="help-inline"><?php echo $tempoError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                     
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Registrar</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
