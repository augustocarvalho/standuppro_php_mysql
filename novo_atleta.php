<?php
     require_once "config.php";  
     require_once "menu.php";
     

    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $estadoError = null;
        $cpfError = null;

        // keep track post values
        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $estado = $_POST['estado'];
        $dt_nascimento = $_POST['dt_nascimento'];
        $sexo = $_POST['sexo'];
        $cod_cbsup = $_POST['cod_cbsup'];
<<<<<<< HEAD
        $cidade = $_POST['cidade'];
=======
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
         

        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }

         if (empty($cpf)) {
            $cpfError = 'Please enter CPF';
            $valid = false;
        }
         
        
        // insert data
        if ($valid) {
<<<<<<< HEAD
            $sql_result = mysqli_query($con, "select * from atleta where cpf=$cpf");
              if (mysqli_num_rows($sql_result) == 0) {
                mysqli_query($con, "INSERT INTO atleta (cpf,nome,estado,data_nascimento,sexo,email,cidade,cod_cbsup) values('$cpf','$name','$estado','$dt_nascimento','$sexo','$email','$cidade','$cod_cbsup')");
=======
            $sql_result = mysql_query("select * from atleta where cpf=$cpf");
              if (mysql_num_rows($sql_result) == 0) {
                mysql_query("INSERT INTO atleta (cpf,nome,estado,data_nascimento,sexo,email, cod_cbsup) values('$cpf','$name','$estado','$dt_nascimento','$sexo','$email','$cod_cbsup')");
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                echo "<script>alert('Cadastro efetuado com sucesso.');</script>";
                echo "<meta http-equiv='refresh' content='0, url=./inscricao.php?id=$cpf'>";
              }
              else {
               echo "<script>alert('CPF JÁ CADASTRADO!!!');</script>";
               echo "<meta http-equiv='refresh' content='0, url=./listar_atleta.php'>";
              }  

        }
    }
?>

<html lang="en">

<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3 align="center">NOVO ATLETA</h3>
                        <br>
                        <br>
                    </div>
             
                    <form class="form-horizontal" action="novo_atleta.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="name" type="text" autofocus  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                       <div class="control-group <?php echo !empty($cpfError)?'error':'';?>">
                        <label class="control-label">CPF</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="cpf" type="text"  placeholder="CPF" value="<?php echo !empty($cpf)?$cpf:'';?>">
                            <?php if (!empty($cpfError)): ?>
                                <span class="help-inline"><?php echo $cpfError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dtError)?'error':'';?>">
                        <label class="control-label">Data de Nascimento</label>
                        <div class="controls">
<<<<<<< HEAD
                            <input style="min-height:35px;" name="dt_nascimento" type="date"  placeholder="dt_nascimento" value="<?php echo !empty($dt_nascimento)?$dt_nascimento:'';?>">
=======
                            <input name="dt_nascimento" type="date"  placeholder="dt_nascimento" value="<?php echo !empty($dt_nascimento)?$dt_nascimento:'';?>">
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                            <?php if (!empty($dt_nascimentoError)): ?>
                                <span class="help-inline"><?php echo $dt_nascimentoError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($sexoError)?'error':'';?>">
                        <label class="control-label">Sexo</label>
                        <div class="controls">
                            <input name="sexo" type="radio"  placeholder="sexo" value="<?php echo !empty($sexo)?$sexo:'';?>M" checked> Masculino
                            <input name="sexo" type="radio"  placeholder="sexo" value="<?php echo !empty($sexo)?$sexo:'';?>F"> Feminino
                            <?php if (!empty($sexoError)): ?>
                                <span class="help-inline"><?php echo $sexoError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>



                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">CÓDIGO CBSUP</label>
                        <div class="controls">
<<<<<<< HEAD
                            <input style="min-height:35px;" name="cod_cbsup" type="text" placeholder="CBSUP" value="<?php echo !empty($cod_cbsup)?$cod_cbsup:'';?>">
=======
                            <input name="cod_cbsup" type="text" placeholder="CBSUP" value="<?php echo !empty($cod_cbsup)?$cod_cbsup:'';?>">
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($estadoError)?'error':'';?>">
                        <label class="control-label">ESTADO</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="estado" type="text"  placeholder="Estado" value="<?php echo !empty($estado)?$estado:'';?>">
                            <?php if (!empty($estadoError)): ?>
                                <span class="help-inline"><?php echo $estadoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($estadoError)?'error':'';?>">
                        <label class="control-label">CIDADE</label>
                        <div class="controls">
                            <input style="min-height:35px;" name="cidade" type="text"  placeholder="Cidade" value="<?php echo !empty($cidade)?$cidade:'';?>">
                            <?php if (!empty($estadoError)): ?>
                                <span class="help-inline"><?php echo $estadoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button style="min-height:35px;" type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>


