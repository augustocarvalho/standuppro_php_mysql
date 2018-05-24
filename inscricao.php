<?php
  require_once "config.php";
  require_once "menu.php";
 
    $id = null;
    $id_etapa=1;
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
        $id_etapa = $_POST['etapa'];
        $id_categoria = $_POST['categoria'];
        $inscricao = $_POST['inscricao'];
        $year = date("Y");
        $sql = mysqli_query($con,"SELECT * FROM atleta where cpf=$id");
        while ($data=mysqli_fetch_assoc($sql)){ 
           sscanf($data['data_nascimento'], '%d-%d-%d', $ano, $mes, $dia);               
           $idade = $year - $ano;   
         }
        // validate input

                  
        $verifica = mysqli_query($con, "select * from inscricao where numero=$inscricao and etapa_idetapa=$id_etapa");
        if (mysqli_num_rows($verifica) > 0) {
          echo "<script>alert('INSCRIÇÃO JÁ CADASTRADA!!!');</script>";
          echo "<meta http-equiv='refresh' content='0, url=./inscricao.php?id=$id'>";
        }      
        else{
          mysqli_query($con, "insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','$id_categoria','$inscricao')");
          if (($id_categoria==05) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','06','$inscricao')");
          } 
          if (($id_categoria==8) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','09','$inscricao')");
          }  
          if (($id_categoria==11) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','24','$inscricao')");
          }  
          if (($id_categoria==13) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','15','$inscricao')");
          } 
          if (($id_categoria==12) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','26','$inscricao')");
          }
          if (($id_categoria==14) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','22','$inscricao')");
          }
          if (($id_categoria==17) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','29','$inscricao')");
          }
          if (($id_categoria==53) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','55','$inscricao')");
          }
          if (($id_categoria==54) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','57','$inscricao')");
          }
          if (($id_categoria==28) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','31','$inscricao')");
          }
          if (($id_categoria==20) and ($idade>39) and ($idade<50)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','39','$inscricao')");
          }  
          if (($id_categoria==33) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','40','$inscricao')");
          }
          if (($id_categoria==52) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','59','$inscricao')");
          }
          if (($id_categoria==33) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','44','$inscricao')");
          }
          if (($id_categoria==20) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','43','$inscricao')");
          }  
          if (($id_categoria==05) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','07','$inscricao')");
          }
          if (($id_categoria==8) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','10','$inscricao')");
          }
          if (($id_categoria==11) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','25','$inscricao')");
          }
          if (($id_categoria==13) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','16','$inscricao')");
          }  
          if (($id_categoria==12) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','27','$inscricao')");
          }
          if (($id_categoria==14) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','23','$inscricao')");
          }
          if (($id_categoria==17) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','30','$inscricao')");
          }
          if (($id_categoria==53) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','56','$inscricao')");
          }
          if (($id_categoria==54) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','58','$inscricao')");
          }
          if (($id_categoria==28) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','32','$inscricao')");
          }
          if (($id_categoria==52) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','60','$inscricao')");
          }
          echo "<script>alert('INSCRIÇÃO REALIZADA COM SUCESSO!!!');</script>";
          echo "<meta http-equiv='refresh' content='0, url=./listar_atleta.php'>";
          #header("Location: listar_atleta.php");
        }
    }
        else {
            $sql = mysqli_query($con,"SELECT * FROM atleta where cpf=$id");
            $year = date("Y");
            while ($data=mysqli_fetch_assoc($sql)){ 
                $cpf = $data['cpf'];
                $nome_participante = $data['nome'];
                $data_nascimento = $data['data_nascimento'];  
                sscanf($data_nascimento, '%d-%d-%d', $ano, $mes, $dia);               
                $idade = $year - $ano;         
            }
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
              <label class="control-label">Name</label>
                 <div class="controls">
                    <input class="input-xlarge uneditable-input" name="nome_participante" type="text" placeholder="Name" value="<?php echo !empty($nome_participante)?$nome_participante:'';?>">
                 </div>
          </div>

          <div class="control-group">
                        <label class="control-label">Data de Nascimento</label>
                         <div class="controls">
          <input class="input-xlarge uneditable-input" name="data_nascimento" type="date"  placeholder="Data de Nascimento" value="<?php echo !empty($data_nascimento)?$data_nascimento:'';?>">
                        </div>
                      </div>

        <div class="control-group">
                        <label class="control-label">Idade esse ano</label>
                         <div class="controls">
          <input class="input-xlarge uneditable-input" name="idade" type="text" value="<?php echo !empty($idade)?$idade:'';?>">
                         </div>
                      </div>



          <div class="control-group">
               <label class="control-label">Inscrição:</label>
              <div class="controls">
                <input autofocus name="inscricao" type="text"  placeholder="Número Inscrição" value="<?php echo !empty($inscricao)?$inscricao:'';?>">
              </div>
          </div>


          <div class="control-group">
            <label class="control-label">Etapa:</label>
              <div class="controls">
                <select class="span4" name="etapa" >
                    <option value="21">Primeira Etapa CBSUP 2018</option>
                </select> 
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
                    <option value="08">FUN RACE FEMININO</option>
                    <option value="11">RACE 12'6 AMADOR MASCULINO</option>
                    <option value="12">RACE 12'6 AMADOR FEMININO</option>
                    <option value="53">RACE 14 AMADOR MASCULINO</option>
                    <option value="54">RACE 14 AMADOR FEMININO</option>
                    <option value="13">RACE 12'6 PRO MASCULINO </option>
                    <option value="14">RACE 12'6 PRO FEMININO </option>
                    <option value="17">RACE 14 PRO MASCULINO</option>
                    <option value="28">RACE 14 PRO FEMININO</option>
                    <option value="19">PADDLE BOARD MASCULINO</option>
                    <option value="21">PADDLE BOARD FEMININO</option>
                    <option value="20">CANOA OC1 MASCULINO</option>
                    <option value="33">CANOA OC1 FEMININO</option>
                    <option value="41">SUP WAVE PRO MASCULINO</option>
                    <option value="63">SUP WAVE PRO MASTER MASCULINO</option>
                    <option value="64">SUP WAVE G-MASTER MASCULINO</option>
                    <option value="68">SUP WAVE PRO FEM</option>
                    <option value="66">SUP WAVE PRO MASTER FEMININO</option>
                    <option value="67">SUP WAVE G-MASTER FEMININO</option>
                    <option value="62">SUP WAVE AMADOR OPEN MASC</option>
                    <option value="65">SUP WAVE AMADOR OPEN FEM</option>
                    <option value="70">SUP WAVE JUNIOR</option>
                    <option value="69">SUP WAVE KIDS</option>
                
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