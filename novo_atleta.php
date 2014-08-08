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
            $sql_result = mysql_query("select id_participante from participante where id_participante=$cpf");
              if (mysql_num_rows($sql_result) == 0) {
                mysql_query("INSERT INTO participante (id_participante,nome_participante,estado,email) values('$cpf','$name','$estado','$email')");
                echo "<script>alert('Cadastro efetuado com sucesso.');</script>";
                echo "<meta http-equiv='refresh' content='0, url=./novo_atleta.php'>";
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
                            <input name="name" type="text" autofocus  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                       <div class="control-group <?php echo !empty($cpfError)?'error':'';?>">
                        <label class="control-label">CPF</label>
                        <div class="controls">
                            <input name="cpf" type="text"  placeholder="CPF" value="<?php echo !empty($cpf)?$cpf:'';?>">
                            <?php if (!empty($cpfError)): ?>
                                <span class="help-inline"><?php echo $cpfError;?></span>
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
                      <div class="control-group <?php echo !empty($estadoError)?'error':'';?>">
                        <label class="control-label">ESTADO</label>
                        <div class="controls">
                            <input name="estado" type="text"  placeholder="Estado" value="<?php echo !empty($estado)?$estado:'';?>">
                            <?php if (!empty($estadoError)): ?>
                                <span class="help-inline"><?php echo $estadoError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>


