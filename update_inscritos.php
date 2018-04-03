<?php
  require_once "config.php";
  require_once "menu.php";
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    
    $cod = null;
    if ( !empty($_GET['cod'])) {
        $cod = $_REQUEST['cod'];
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
        $inscricao = $_POST['inscricao'];


<<<<<<< HEAD
        $verifica = mysqli_query($con,"select * from inscricao where numero=$inscricao and etapa_idetapa=$id");
        if (mysqli_num_rows($verifica) > 0) {
=======
        $verifica = mysql_query("select * from inscricao where numero=$inscricao");
        if (mysql_num_rows($verifica) > 0) {
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
          echo "<script>alert('INSCRIÇÃO JÁ CADASTRADO!!!');</script>";
          echo "<meta http-equiv='refresh' content='0, url=./update_inscritos.php?id=$id&cod=$cod'>";
        }
        else {
<<<<<<< HEAD
          mysqli_query($con,"UPDATE inscricao SET numero='$inscricao' where numero='$cod' and etapa_idetapa='$id'");
          echo "<script>alert('INSCRIÇÃO ALTERADA COM SUCESSO!!!');</script>";
          echo "<meta http-equiv='refresh' content='0, url=./inscritos.php?id=$id'>";
          #header("Location: inscritos.php?id=$id");
        } 
    }
    else {
            $sql = mysqli_query($con,"select a.nome, i.numero from inscricao i join atleta a on i.atleta_cpf=a.cpf where i.etapa_idetapa='$id' and i.numero='$cod'");
            while ($data=mysqli_fetch_assoc($sql)){ 
=======
          mysql_query("UPDATE inscricao SET numero='$inscricao' where numero='$cod' and etapa_idetapa='$id'");
          echo "<script>alert('INSCRIÇÃO ALTERADA COM SUCESSO!!!');</script>";
          header("Location: inscritos.php?id=$id");
        } 
    }
    else {
            $sql = mysql_query("select a.nome, i.numero from inscricao i join atleta a on i.atleta_cpf=a.cpf where i.etapa_idetapa='$id' and i.numero='$cod'");
            while ($data=mysql_fetch_assoc($sql)){ 
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                $nome_participante = $data['nome'];
                $inscricao = $data['numero'];  
            }

      }
         
        

 
?>

<html>
<body>
   <div class="container">
     
        <div class="span10 offset1">
           <div class="row">
            <h3 align="center">ALTERAR INSCRIÇÃO</h3>
            <br>
            <br>
        </div>

      

        <form class="form-horizontal" action="update_inscritos.php?id=<?php echo $id?>&cod=<?php echo $cod?>" method="post">  
        
          <div class="control-group">
              <label class="control-label">Name</label>
                 <div class="controls">
                    <input class="input-xlarge uneditable-input" name="nome_participante" type="text" placeholder="Name" value="<?php echo !empty($nome_participante)?$nome_participante:'';?>">
                 </div>
          </div>

          <div class="control-group">
               <label class="control-label">Inscrição:</label>
              <div class="controls">
<<<<<<< HEAD
                <input autofocus name="inscricao" type="text"  placeholder="Número Inscrição" value="<?php echo !empty($inscricao)?$inscricao:'';?>">
=======
                <input name="inscricao" type="text"  placeholder="Número Inscrição" value="<?php echo !empty($inscricao)?$inscricao:'';?>">
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
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