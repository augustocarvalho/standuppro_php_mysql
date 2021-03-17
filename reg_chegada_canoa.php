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
        $tempo_t = $_POST['tempo_t'];
        
         
        // validate input
        $valid = true;
		$result = mysqli_query($con,"select * from inscricao where etapa_idetapa=$id and numero=$cod");
        if (  (empty($cod) ) or (mysqli_num_rows($result)==0) ){
            $codError = 'Inscrição inválida';
            $valid = false;
        }

         if (empty($tempo)) {
            $tempoError = 'Tempo não informado';
            $valid = false;
        }
         
        
        // insert data
        if ($valid) {
	            mysqli_query($con,"UPDATE inscricao SET tempo = time(time('$tempo')-time('$tempo_t')) where numero='$cod' and etapa_idetapa='$id'");
                echo "<script>alert('Cadastro efetuado com sucesso.');</script>";       
                echo "<meta http-equiv='refresh' content='0, url=./reg_chegada_canoa.php?id=$id'>";
        }
              
    }
?>



<html lang="en">
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3 align="center">Registro de Chegada - CANOA</h3>
                        <br>
                        <br>
                    </div>
             
                    <form class="form-horizontal" action="reg_chegada_canoa.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($codError)?'error':'';?>">
                        <label class="control-label">Inscrição</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="cod" type="text"  placeholder="Número de Inscrição"value="<?php echo !empty($cod)?$cod:'';?>">
                            <?php if (!empty($codError)): ?>
                                <span class="help-inline"><?php echo $codError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($tempoError)?'error':'';?>">
                        <label class="control-label">Hora de Saida</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="tempo_t" type="text" class="time" placeholder="tempo de saída" value="<?php echo !empty($tempo_t)?$tempo_t:'';?>">
                            <?php if (!empty($tempoError)): ?>
                                <span class="help-inline"><?php echo $tempoError;?></span>
                            <?php endif; ?>
                        </div>
                       </div> 
                       <div class="control-group <?php echo !empty($tempoError)?'error':'';?>">
                        <label class="control-label">Hora de Chegada</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="tempo" type="text" class="time" placeholder="tempo de chegada" value="<?php echo !empty($tempo)?$tempo:'';?>">
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
