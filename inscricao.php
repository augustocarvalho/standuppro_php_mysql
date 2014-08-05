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
        $cpfError = null;
        $inscricaoError = null;
        
        // keep track post values
        $cpf = $_POST['cpf'];
        $id_categoria = $_POST['categoria'];
        $inscricao = $_POST['inscricao'];
         
        // validate input
        $valid = true;
        $row = mysql_query("select * from participante where id_participante=$cpf");
        if ( (empty($cpf)) or (mysql_num_rows($row)==0) ) {
            $cpfError = 'CPF Não Cadastrado';
            $valid = false;
        }

        if (empty($inscricao)) {
            $inscricaoError = 'Preencha a Inscrição';
            $valid = false;
        }
     }    
                
               
        // update data
        if ($valid) {
          mysql_query("insert into inscricao (id_etapa, id_participante, id_categoria, cod_inscricao) values('$id','$cpf','$id_categoria','$inscricao')");
          mysql_query("insert into ranking (id_participante, id_categoria, pontos) values('$id_participante','$id_categoria','0')");
          if  ($id=2) {
            mysql_query("insert into ranking_brasileiro (id_participante, id_categoria, pontos) values('$id_participante','$id_categoria','0')");
          }
          header("Location: inscricao.php?id=$id");
        } 
        
?>

<html>
<body>
   <div class="container">
     
        <div class="span10 offset1">
           <div class="row">
            <h3 align="center">Nova Inscrição</h3>
            <br>
            <br>
        </div>

        <form class="form-horizontal" action="inscricao.php?id=<?php echo $id?>" method="post">  
          <div class="control-group">
            <label class="control-label">CPF:</label>
              <div class="controls">
                <input name="cpf" type="text"  placeholder="CPF" value="<?php echo !empty($cpf)?$cpf:'';?>">
                                  <?php if (!empty($cpfError)): ?>
                                      <span class="help-inline"><?php echo $cpfError;?></span>
                                  <?php endif; ?>
              </div>
          </div>    
          <div class="control-group">
               <label class="control-label">Inscrição:</label>
              <div class="controls">
                <input name="inscricao" type="text"  placeholder="Número Inscrição" value="<?php echo !empty($inscricao)?$inscricao:'';?>">
                                  <?php if (!empty($inscricaoError)): ?>
                                      <span class="help-inline"><?php echo $inscricaoError;?></span>
                                  <?php endif; ?>
              </div>
          </div>
          <div class="control-group">
            <label class="control-label">Categoria:</label>
              <div class="controls">
                <select class="span4" name="categoria" >
                    <option value=""></option>
                    <option value="01"> KIDS MASCULINO</option>
                    <option value="02">KIDS FEMININO</option>
                    <option value="03">JUNIOR MASCULINO</option>
                    <option value="04"> JUNIOR FEMININO</option>
                    <option value="05">FUN RACE MASCULINO</option>
                    <option value="06">FUN RACE MASCULINO MASTER</option>
                    <option value="07"> FUN RACE MASCULINO GRAN MASTER</option>
                    <option value="08">FUN RACE FEMININO</option>
                    <option value="09">FUN RACE FEMININO MASTER</option>
                    <option value="10"> FUN RACE FEMININO GRAN MASTER</option>
                    <option value="11">RACE AMADOR MASCULINO</option>
                    <option value="12">RACE AMADOR FEMININO</option>
                    <option value="13"> RACE MASCULINO PROFISSIONAL</option>
                    <option value="14">RACE FEMININO PROFISSIONAL</option>
                    <option value="15">RACE MASTER</option>
                    <option value="16">RACE GRAN MASTER</option>
                    <option value="17">RACE 14</option>
                    <option value="18">UNLIMIT</option>
                    <option value="19">PADDLE BOARD MASCULINO</option>
                    <option value="20">CANOA HAVAIANA</option>
                    <option value="21">PADDLE BOARD FEMININO</option>
                  </select> 
               </div>   
          </div>        
           
          <div class="form-actions">
             <button type="submit" class="btn btn-success">Submeter</button>
             <a class="btn" href="index.php">Back</a>
          </div>
       </form>
    </div>       
  </body>
</html>