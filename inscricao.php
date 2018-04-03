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
<<<<<<< HEAD
        $year = date("Y");
        $sql = mysqli_query($con,"SELECT * FROM atleta where cpf=$id");
        while ($data=mysqli_fetch_assoc($sql)){ 
           sscanf($data['data_nascimento'], '%d-%d-%d', $ano, $mes, $dia);               
           $idade = $year - $ano;   
=======
        $sql = mysql_query("SELECT * FROM atleta where cpf=$id");
        while ($data=mysql_fetch_assoc($sql)){ 
           sscanf($data['data_nascimento'], '%d-%d-%d', $ano, $mes, $dia);               
           $idade = 2016 - $ano;   
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
         }
        // validate input

                  
<<<<<<< HEAD
        $verifica = mysqli_query($con, "select * from inscricao where numero=$inscricao and etapa_idetapa=$id_etapa");
        if (mysqli_num_rows($verifica) > 0) {
=======
        $verifica = mysql_query("select * from inscricao where numero=$inscricao and etapa_idetapa=$id_etapa");
        if (mysql_num_rows($verifica) > 0) {
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
          echo "<script>alert('INSCRIÇÃO JÁ CADASTRADA!!!');</script>";
          echo "<meta http-equiv='refresh' content='0, url=./inscricao.php?id=$id'>";
        }      
        else{
<<<<<<< HEAD
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
          if (($id_categoria==28) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','31','$inscricao')");
          }
          if (($id_categoria==20) and ($idade>39) and ($idade<50)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','39','$inscricao')");
          }  
          if (($id_categoria==33) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','40','$inscricao')");
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
          if (($id_categoria==28) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','32','$inscricao')");
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
=======
          $existe=mysql_query("select * from ranking where atleta_cpf='$id' and categoria_idcategoria='$id_categoria'");
          if (mysql_num_rows($existe)==0) {
            mysql_query("insert into ranking (atleta_cpf, categoria_idcategoria, pontos) values('$id','$id_categoria','0')");
          }
          mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','$id_categoria','$inscricao')");
          if (($id_categoria==05) and ($idade>39) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','06','$inscricao')");
          } 
          if (($id_categoria==8) and ($idade>39) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','09','$inscricao')");
          }  
          if (($id_categoria==11) and ($idade>39) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','24','$inscricao')");
          }  
          if (($id_categoria==13) and ($idade>39) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','15','$inscricao')");
          } 
          if (($id_categoria==12) and ($idade>39) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','26','$inscricao')");
          }
          if (($id_categoria==14) and ($idade>39) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','22','$inscricao')");
          }
          if (($id_categoria==17) and ($idade>39) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','29','$inscricao')");
          }
          if (($id_categoria==28) and ($idade>39) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','31','$inscricao')");
          }
          if (($id_categoria==20) and ($idade>39) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','39','$inscricao')");
          }  
          if (($id_categoria==33) and ($idade>39) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','40','$inscricao')");
          }  
          if (($id_categoria==05) and ($idade>49) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','07','$inscricao')");
          }
          if (($id_categoria==8) and ($idade>49) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','10','$inscricao')");
          }
          if (($id_categoria==11) and ($idade>49) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','25','$inscricao')");
          }
          if (($id_categoria==13) and ($idade>49) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','16','$inscricao')");
          }  
          if (($id_categoria==12) and ($idade>49) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','27','$inscricao')");
          }
          if (($id_categoria==14) and ($idade>49) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','23','$inscricao')");
          }
          if (($id_categoria==17) and ($idade>49) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','30','$inscricao')");
          }
          if (($id_categoria==28) and ($idade>49) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','32','$inscricao')");
          }
          header("Location: listar_atleta.php");
        }
    }
        else {
            $sql = mysql_query("SELECT * FROM atleta where cpf=$id");
            while ($data=mysql_fetch_assoc($sql)){ 
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                $cpf = $data['cpf'];
                $nome_participante = $data['nome'];
                $data_nascimento = $data['data_nascimento'];  
                sscanf($data_nascimento, '%d-%d-%d', $ano, $mes, $dia);               
<<<<<<< HEAD
                $idade = $year - $ano;         
=======
                $idade = 2016 - $ano;         
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
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
<<<<<<< HEAD
                        <label class="control-label">Idade esse ano</label>
=======
                        <label class="control-label">Idade em 2016</label>
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                         <div class="controls">
          <input class="input-xlarge uneditable-input" name="idade" type="text" value="<?php echo !empty($idade)?$idade:'';?>">
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


          <div class="control-group">
            <label class="control-label">Etapa:</label>
              <div class="controls">
                <select class="span4" name="etapa" >
<<<<<<< HEAD
                    <option value="19">YACHT RACE PRO 2017</option>
=======
                    <option value="05">BAHIA SUP ECO 2016</option>
              <!-- <option value="04">CIRCUITO NAUTICO SSA-IOS</option>
                    <option value="03">REGATA MARCILIO DIAS</option>   
                    <option value="02">MAX FORCE</option>
                    <option value="01">DESAFIO DOS FORTES</option> -->
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
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
                    <option value="06">FUN RACE MASCULINO MASTER</option>
                    <option value="07"> FUN RACE MASCULINO GRAN MASTER</option>
                    <option value="08">FUN RACE FEMININO</option>
                    <option value="09">FUN RACE FEMININO MASTER</option>
                    <option value="10"> FUN RACE FEMININO GRAN MASTER</option>
                    <option value="11">RACE AMADOR MASCULINO</option>
                    <option value="24">RACE AMADOR MASCULINO MASTER</option>
                    <option value="25">RACE AMADOR MASCULINO G-MASTER</option>
                    <option value="12">RACE AMADOR FEMININO</option>
                    <option value="26">RACE AMADOR FEMININO MASTER</option>
                    <option value="27">RACE AMADOR FEMININO G-MASTER</option>                    
                    <option value="13">RACE 12'6 MASCULINO </option>
                    <option value="14">RACE 12'6 FEMININO </option>
                    <option value="15">RACE 12'6 MASTER MASC</option>
                    <option value="22">RACE 12'6 MASTER FEMININO</option>
                    <option value="16">RACE 12'6 G-MASTER MASC</option>
                    <option value="23">RACE 12'6 G-MASTER FEMININO</option>
                    <option value="17">RACE 14 MASC</option>
                    <option value="29">RACE 14 MASC MASTER</option>
                    <option value="30">RACE 14 MASC G-MASTER</option>
                    <option value="28">RACE 14 FEM</option>
                    <option value="31">RACE 14 FEM MASTER</option>
                    <option value="31">RACE 14 FEM G-MASTER</option>
                    <option value="19">PADDLE BOARD MASCULINO</option>
                    <option value="21">PADDLE BOARD FEMININO</option>
              <!--  <option value="19">PADDLE BOARD</option>
                    <option value="30">RACE 14 MASC G_MASTER</option>
                    <option value="32">RACE 14 FEM G-MASTER</option>
                    <option value="18">UNLIMIT</option>
                    <option value="34">CANOA HAVAIANA OC3 MASC</option> 
                    <option value="40">CANOA HAVAIANA OC1 FEM MASTER</option>
                    <option value="35">CANOA HAVAIANA OC3 FEM</option> -->
                    <option value="20">CANOA HAVAIANA OC1 MASC</option>
                    <option value="39">CANOA HAVAIANA OC1 MASC MASTER</option>
<<<<<<< HEAD
                    <option value="43">CANOA HAVAIANA OC1 MASC G-MASTER</option>
                    <option value="33">CANOA HAVAIANA OC1 FEM</option>
                    <option value="40">CANOA HAVAIANA OC1 FEM MASTER</option>
                    <option value="44">CANOA HAVAIANA OC1 FEM G-MASTER</option>
                    <option value="49">CANOA HAVAIANA OC1 KIDS</option>
                    <option value="36">CANOA HAVAIANA OC6 MISTA</option>
                    <option value="45">CANOA HAVAIANA OC6 FEM</option>
                    <option value="46">CANOA HAVAIANA OC6 MASC</option>
                    <option value="47">ESTREANTE MASCULINO</option>
                    <option value="48">ESTREANTE FEMININO</option>
                    <option value="50">ESTREANTE RACE MASCULINO</option>
                    <option value="51">ESTREANTE RACE FEMININO</option>
                    <option value="41">SUPWAVE</option>
                    <option value="42">MILITAR</option>
=======
                    <option value="33">CANOA HAVAIANA OC1 FEM</option>
                    <option value="36">CANOA HAVAIANA OC6 MISTA</option>
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
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