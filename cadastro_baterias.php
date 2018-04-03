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
        $bateria = $_POST['bateria'];
        $round = $_POST['round'];
        $lycra = $_POST['lycra'];
        $year = date("Y");
        $sql = mysql_query("SELECT * FROM atleta where cpf=$id");
        while ($data=mysql_fetch_assoc($sql)){ 
           sscanf($data['data_nascimento'], '%d-%d-%d', $ano, $mes, $dia);               
           $idade = $year - $ano;   
         }
        // validate input

                  
        $verifica = mysql_query("select * from heat where atleta_cpf=$id and etapa_idetapa=$id_etapa and bateria_round=$round and categoria_idcategoria=$id_categoria");
        if (mysql_num_rows($verifica) > 0) {
          echo "<script>alert('ATLETA JÁ INSCRITO NESSE ROUND DA CATEGORIA!!!');</script>";
          echo "<meta http-equiv='refresh' content='0, url=./cadastro_baterias.php?id=$id'>";
        }      
        else{
          $verifica_bateria = mysql_query("select * from heat where etapa_idetapa=$id_etapa and bateria_idbateria=$bateria and bateria_round=$round and categoria_idcategoria=$id_categoria");
           if (mysql_num_rows($verifica_bateria) == 4) {
              echo "<script>alert('ESSA BATERIA JÁ ESTÁ COMPLETA!!!');</script>";
              echo "<meta http-equiv='refresh' content='0, url=./cadastro_baterias.php?id=$id'>";
           } else{
             $verifica_cor = mysql_query("select lycra from heat where etapa_idetapa=$id_etapa and bateria_idbateria=$bateria and bateria_round=$round and categoria_idcategoria=$id_categoria");
              $sql_return = false;
              while ($cor=mysql_fetch_assoc($verifica_cor)){ 
                  if ($cor['lycra'] == $lycra) {
                    $sql_return = true;
                  }
              }     
              if ($sql_return) {
                echo "<script>alert('OUTRO ATLETA NESSA BATERIA COM ESSA LYCRA!!!');</script>";
                echo "<meta http-equiv='refresh' content='0, url=./cadastro_baterias.php?id=$id'>";
              } else {  
                  mysql_query("insert into heat (bateria_idbateria, bateria_round, etapa_idetapa, atleta_cpf, categoria_idcategoria,lycra) values('$bateria','$round','$id_etapa','$id','$id_categoria','$lycra')");
                  echo "<script>alert('CADASTRO REALIZADO COM SUCESSO!!!');</script>";
                  echo "<meta http-equiv='refresh' content='0, url=./listar_atleta.php'>";
                }
           }
        }
    }
         else {
            $sql = mysql_query("SELECT * FROM atleta where cpf=$id");
            $year = date("Y");
            while ($data=mysql_fetch_assoc($sql)){ 
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

      

        <form class="form-horizontal" action="cadastro_baterias.php?id=<?php echo $id?>" method="post">  
        
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
            <label class="control-label">Etapa:</label>
              <div class="controls">
                <select class="span4" name="etapa" >
                    <option value="08">WSL - 2016</option>
                </select> 
               </div>   
          </div>        

          <div class="control-group">
            <label class="control-label">Categoria:</label>
              <div class="controls">
                <select class="span4" name="categoria" >S
                    <option value="41">SURF</option>
                  </select> 
               </div>   
          </div>    

          <div class="control-group">
            <label class="control-label">ROUND:</label>
              <div class="controls">
                <select class="span4" name="round" >S
                    <option value="1">PRIMEIRO ROUND</option>
                    <option value="2">SEGUNDO ROUND</option>
                    <option value="3">TERCEIRO ROUND</option>
                    <option value="4">QUARTO ROUND</option>
                    <option value="5">QUINTO ROUND</option>
                    <option value="6">SEXTO ROUND</option>
                    <option value="7">SETIMO ROUND</option>
                    <option value="8">OITAVO ROUND</option>
                </select> 
               </div>   
          </div>       
          
          <div class="control-group">
            <label class="control-label">BATERIA:</label>
              <div class="controls">
                <select class="span4" name="bateria" >S
                    <option value="1">BATERIA 1</option>
                    <option value="2">BATERIA 2</option>
                    <option value="3">BATERIA 3</option>
                    <option value="4">BATERIA 4</option>
                    <option value="5">BATERIA 5</option>
                    <option value="6">BATERIA 6</option>
                    <option value="7">BATERIA 7</option>
                    <option value="8">BATERIA 8</option>
                </select> 
               </div>   
          </div>    


          <div class="control-group">
            <label class="control-label">COR DA LYCRA:</label>
              <div class="controls">
                <select class="span4" name="lycra" >S
                    <option value="1" style="background-color:white;">BRANCA</option>
                    <option value="2" style="background-color:red;">VERMELHO</option>
                    <option value="3" style="background-color:blue;">AZUL</option>
                    <option value="4" style="background-color:green;">VERDE</option>
                    <option value="5" style="background-color:yellow;">AMARELO</option>
                    <option value="6" style="background-color:black;">PRETO</option>
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