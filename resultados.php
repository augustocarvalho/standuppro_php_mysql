<?php
  require_once "config.php";
  require_once "menu.php";
 
    $id = null;
    $id_etapa=1;
        
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $estadoError = null;

        // keep track post values
        $id_etapa = $_POST['etapa'];
        $id_categoria = $_POST['categoria'];
        $inscricao = $_POST['inscricao'];
        $sql = mysql_query("SELECT * FROM atleta where cpf=$id");
        while ($data=mysql_fetch_assoc($sql)){ 
           sscanf($data['data_nascimento'], '%d-%d-%d', $ano, $mes, $dia);               
           $idade = 2015 - $ano;   
         }
        // validate input
        $valid = true;
       # if (empty($nome_participante)) {
       #     $nameError = 'Please enter Name';
        #    $valid = false;
        #}
                  
               
                      
        // update data
        if ($valid) {
          $existe=mysql_query("select * from ranking where atleta_cpf='$id' and categoria_idcategoria='$id_categoria'");
          if (mysql_num_rows($existe)==0) {
            mysql_query("insert into ranking (atleta_cpf, categoria_idcategoria, pontos) values('$id','$id_categoria','0')");
          }
          mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','$id_categoria','$inscricao')");
          if (($id_categoria==11) and ($idade>40) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','15','$inscricao')");
          }  
          if (($id_categoria==12) and ($idade>40) and ($idade<50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','22','$inscricao')");
          }  
          if (($id_categoria==11) and ($idade>50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','16','$inscricao')");
          }  
          if (($id_categoria==12) and ($idade>50) ){
            mysql_query("insert into inscricao (etapa_idetapa, atleta_cpf, categoria_idcategoria, numero) values('$id_etapa','$id','23','$inscricao')");
          }  
          header("Location: listar_atleta.php");
        } 
    }
        else {
            $sql = mysql_query("SELECT * FROM atleta where cpf=$id");
            while ($data=mysql_fetch_assoc($sql)){ 
                $cpf = $data['cpf'];
                $nome_participante = $data['nome'];
                $data_nascimento = $data['data_nascimento'];  
                sscanf($data_nascimento, '%d-%d-%d', $ano, $mes, $dia);               
                $idade = 2015 - $ano;         
            }
          }
         
        

 
?>

<html>
<body>
   <div class="container">
     
        <div class="span10 offset1">
           <div class="row">
            <h3 align="center">RESULTADO</h3>
            <br>
            <br>
        </div>

      

        <form class="form-horizontal" action="inscricao.php?id=<?php echo $id?>" method="post">  
        
          <div class="control-group">
            <label class="control-label">Etapa:</label>
              <div class="controls">
                <select class="span4" name="etapa" >
                    <option value="01">ITACIMIRIM</option>
                    <option value="02">SAUIPE</option>
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
                    <option value="13"> RACE MASCULINO PROFISSIONAL</option>
                    <option value="14">RACE FEMININO PROFISSIONAL</option>
                    <option value="15">RACE MASTER</option>
                    <option value="22">RACE MASTER FEMININO</option>
                    <option value="16">RACE GRAN MASTER</option>
                    <option value="23">RACE G-MASTER FEMININO</option>
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