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
          if (($id_categoria==61) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','76','$inscricao')");
          }
          if (($id_categoria==88) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','89','$inscricao')");
          }
          if (($id_categoria==85) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','86','$inscricao')");
          }
          if (($id_categoria==46) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','93','$inscricao')");
          }
          if (($id_categoria==45) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','95','$inscricao')");
          }
          if (($id_categoria==92) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','97','$inscricao')");
          }
          if (($id_categoria==85) and ($idade>50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','87','$inscricao')");
          }
          if (($id_categoria==46) and ($idade>50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','94','$inscricao')");
          }
          if (($id_categoria==45) and ($idade>50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','96','$inscricao')");
          }
          if (($id_categoria==92) and ($idade>50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','98','$inscricao')");
          }
          if (($id_categoria==61) and ($idade>50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','77','$inscricao')");
          }
          if (($id_categoria==82) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','83','$inscricao')");
          }
          if (($id_categoria==82) and ($idade>50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','84','$inscricao')");
          }
          if (($id_categoria==79) and ($idade>39) and ($idade<50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','80','$inscricao')");
          }
          if (($id_categoria==79) and ($idade>50) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','81','$inscricao')");
          }
          if (($id_categoria==33) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','44','$inscricao')");
          }
          if (($id_categoria==20) and ($idade>49) and ($idade<60)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','43','$inscricao')");
          }
          if (($id_categoria==20) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','74','$inscricao')");
          }  
          if (($id_categoria==05) and ($idade>49) and ($idade<60)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','07','$inscricao')");
          }
          if (($id_categoria==05) and ($idade>59)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','119','$inscricao')");
          }
          if (($id_categoria==8) and ($idade>49) and ($idade<60)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','10','$inscricao')");
          }
          if (($id_categoria==8) and ($idade>59)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','120','$inscricao')");
          }
          if (($id_categoria==11) and ($idade>49) and ($idade<60)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','25','$inscricao')");
          }
          if (($id_categoria==11) and ($idade>59)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','71','$inscricao')");
          }
          if (($id_categoria==13) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','16','$inscricao')");
          }  
          if (($id_categoria==12) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','27','$inscricao')");
          }
          if (($id_categoria==12) and ($idade>59)){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','72','$inscricao')");
          }
          if (($id_categoria==14) and ($idade>49) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','23','$inscricao')");
          }
          if (($id_categoria==17) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','30','$inscricao')");
          }
          if (($id_categoria==17) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','121','$inscricao')");
          }
          if (($id_categoria==53) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','56','$inscricao')");
          }
          if (($id_categoria==53) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','114','$inscricao')");
          }
          if (($id_categoria==54) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','58','$inscricao')");
          }
          if (($id_categoria==54) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','115','$inscricao')");
          }
          if (($id_categoria==28) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','32','$inscricao')");
          }
          if (($id_categoria==28) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','122','$inscricao')");
          }
          if (($id_categoria==52) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','60','$inscricao')");
          }
          if (($id_categoria==52) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','78','$inscricao')");
          }
          if (($id_categoria==88) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','90','$inscricao')");
          }
          if (($id_categoria==88) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','91','$inscricao')");
          }
          if (($id_categoria==104) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','105','$inscricao')");
          }
          if (($id_categoria==104) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','106','$inscricao')");
          }
          if (($id_categoria==107) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','108','$inscricao')");
          }
          if (($id_categoria==107) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','109','$inscricao')");
          }
          if (($id_categoria==110) and ($idade>49) and ($idade<60) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','111','$inscricao')");
          }
          if (($id_categoria==110) and ($idade>59) ){
            mysqli_query($con,"insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','112','$inscricao')");
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
                    <option value="63">QUARTA ETAPA CBSUP 2024</option>
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
                    <option value="04">JUNIOR FEMININO</option>
                    <option value="05">ALL BOARD MASCULINO</option>
                    <option value="08">ALL BOARD FEMININO</option>
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
                    <option value="117">PADDLE BOARD ELITE MASCULINO</option>
                    <option value="118">PADDLE BOARD ELITE FEMININO</option> 
                    <option value="49">V1R KIDS MASC</option>
                    <option value="73">V1R KIDS FEM</option>
                    <option value="20">V1R MASC</option>
                    <option value="33">V1R FEM</option>
                    <option value="79">V2R MASC</option>
                    <option value="82">V2R FEM</option>
                    <option value="85">V2R MISTA</option>
                    <option value="99">V4R MASC</option>
                    <option value="100">V4R FEM</option>
                    <option value="101">V4R MISTA</option>
                    <option value="102">V4R JUNIOR</option>
                    <option value="46">V6 MASC</option>
                    <option value="45">V6 FEM</option>
                    <option value="92">V6 MISTA</option>
                    <option value="52">SURFSKI MASCULINO</option>
                    <option value="61">SURFSKI FEMININO</option>
                    <option value="88">SURFSKI DUPLO</option>
                    <option value="75">V1 MASC</option>
                    <option value="103">V1 FEM</option>
                    <option value="104">OC6 MASC</option>
                    <option value="107">OC6 FEM</option>
                    <option value="110">OC6 MISTA</option> 
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