<?php
    require 'config.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $estadoError = null;

        // keep track post values
        $nome_participante = $_POST['nome_participante'];
        $data_nascimento = $_POST['data_nascimento'];
        $email = $_POST['email'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $cod_cbsup = $_POST['cod_cbsup'];
        $categoria = $_POST['categoria'];
        
         
        // validate input
        $valid = true;
        if (empty($nome_participante)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
                
               
        // update data
        if ($valid) {
          mysqli_query($con, "UPDATE atleta  set nome='$nome_participante', data_nascimento='$data_nascimento', email='$email', estado='$estado', cidade='$cidade', cod_cbsup='$cod_cbsup', categoria_idcategoria='$categoria' WHERE cpf='$id'");
          header("Location: listar_atleta.php");

        }
    } else {
        $sql = mysqli_query($con, "SELECT * FROM atleta where cpf=$id");
        while ($data=mysqli_fetch_assoc($sql)){ 
          $nome_participante = $data['nome'];
          $data_nascimento = $data['data_nascimento'];  
          $email = $data['email'];
          $cidade = $data['cidade'];
          $estado = $data['estado'];
          $cod_cbsup = $data['cod_cbsup'];
          $categoria = $data['categoria_idcategoria'];
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <br>
                        <br>
                        <h3 align="center">Alterar Atleta</h3>
                        <br>
                        <br>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
          <input name="nome_participante" type="text"  placeholder="Name" value="<?php echo !empty($nome_participante)?$nome_participante:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                  
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Data de Nascimento</label>
                         <div class="controls">
          <input name="data_nascimento" type="date"  placeholder="Data de Nascimento" value="<?php echo !empty($data_nascimento)?$data_nascimento:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                  

                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">Estado</label>
                        <div class="controls">
                            <input name="estado" type="text"  placeholder="Estado" value="<?php echo !empty($estado)?$estado:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Cidade</label>
                        <div class="controls">
                            <input name="cidade" type="text"  placeholder="Cidade" value="<?php echo !empty($cidade)?$cidade:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group">
                       <label class="control-label">Categoria:</label>
                             <div class="controls">
                               <select class="span4" name="categoria" value="<?php echo !empty($categoria)?$categoria:'';?>">
                                   <option value="">Escolha uma abaixo</option>
                                   <option <?php if ($categoria == 13 ) echo 'selected' ; ?> value="13">RACE 12'6 PRO MASCULINO </option>
                                   <option <?php if ($categoria == 14 ) echo 'selected' ; ?> value="14">RACE 12'6 PRO FEMININO </option>
                                   <option <?php if ($categoria == 17 ) echo 'selected' ; ?> value="17">RACE 14'' PRO MASCULINO</option>
                                   <option <?php if ($categoria == 28 ) echo 'selected' ; ?> value="28">RACE 14'' PRO FEMININO</option>
                                   <option <?php if ($categoria == 1 ) echo 'selected' ; ?> value="01"> KIDS MASCULINO</option>
                                   <option <?php if ($categoria == 2 ) echo 'selected' ; ?> value="02">KIDS FEMININO</option>
                                   <option <?php if ($categoria == 3 ) echo 'selected' ; ?> value="03">JUNIOR MASCULINO</option>
                                   <option <?php if ($categoria == 4 ) echo 'selected' ; ?> value="04"> JUNIOR FEMININO</option>
                                   <option <?php if ($categoria == 5 ) echo 'selected' ; ?> value="05">FUN RACE MASCULINO</option>
                                   <option <?php if ($categoria == 8 ) echo 'selected' ; ?> value="08">FUN RACE FEMININO</option>
                                   <option <?php if ($categoria == 11 ) echo 'selected' ; ?> value="11">RACE 12'6 AMADOR MASCULINO</option>
                                   <option <?php if ($categoria == 12 ) echo 'selected' ; ?> value="12">RACE 12'6 AMADOR FEMININO</option>
                                   <option <?php if ($categoria == 113 ) echo 'selected' ; ?> value="113">RACE AMADOR LEGEND MASC</option>
                                   <option <?php if ($categoria == 114 ) echo 'selected' ; ?> value="114">RACE AMADOR KAHUNA MASC</option>
                                   <option <?php if ($categoria == 115 ) echo 'selected' ; ?> value="115">RACE AMADOR KAHUNA FEM</option>
                                   <option <?php if ($categoria == 116 ) echo 'selected' ; ?> value="116">RACE AMADOR LEGEND FEM</option>
                                   <option <?php if ($categoria == 53 ) echo 'selected' ; ?> value="53">RACE 14'' AMADOR MASCULINO</option>
                                   <option <?php if ($categoria == 54 ) echo 'selected' ; ?> value="54">RACE 14'' AMADOR FEMININO</option>
                                   <option <?php if ($categoria == 19 ) echo 'selected' ; ?> value="19">PADDLE BOARD MASCULINO</option>
                                   <option <?php if ($categoria == 21 ) echo 'selected' ; ?> value="21">PADDLE BOARD FEMININO</option>
                                   <option <?php if ($categoria == 115 ) echo 'selected' ; ?> value="115">RACE KAHUNA FEM</option>                    
                                   <option <?php if ($categoria == 114 ) echo 'selected' ; ?> value="114">RACE KAHUNA MASC</option>
                                   <option <?php if ($categoria == 113 ) echo 'selected' ; ?> value="113">RACE LEGEND MASC</option>
                                   <option <?php if ($categoria == 116 ) echo 'selected' ; ?> value="116">RACE LEGEND FEM</option>
                                 </select> 
                              </div>   
                        </div>        

                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Codigo CBSUP</label>
                        <div class="controls">
                            <input name="cod_cbsup" type="text" placeholder="Cod CBSUP" value="<?php echo !empty($cod_cbsup)?$cod_cbsup:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="listar_atleta.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>




