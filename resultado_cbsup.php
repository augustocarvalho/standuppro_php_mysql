<?php
require_once "config.php";
require_once "menu.php";
?>



<html>
<div id="cadastro">
  <body>
     <head>
        <style>
        body {
            background-image: url("stdp_resultados01logo.jpg"), url("stdp_resultados02.jpg");
            background-repeat: no-repeat, repeat;
            background-size:100% auto;
        }
        </style>
      </head>    
    <table id="form_selecao" style="margin-left:100px">
	<form  method="post" > 
	<tr>
 	  <td style="font-weight:bold"> MODALIDADE: </td>
      <td> <select name="modalidade" id="modalidade" class="selectpicker" > 
       <option value="00">GERAL</option>
       <option value="01">PROVA LONGA</option>
       <option value="02">PROVA TECNICA</option>  
      </td>
	</tr> 
    <tr>
	  <td style="font-weight:bold"> CATEGORIA: </td>
      <td> <select name="categoria" id="categoria" class="selectpicker" onchange="form.submit()">
        			      <option value="">Escolha uma abaixo</option>
                    <!--<option value="00"> GERAL</option>-->
                    <option value="01">KIDS MASCULINO</option>
                    <option value="02">KIDS FEMININO</option>
                    <option value="03">JUNIOR MASCULINO</option>
                    <option value="04">JUNIOR FEMININO</option>
                    <option value="05">FUN RACE MASCULINO</option>
                    <option value="08">FUN RACE FEMININO</option>
                    <option value="06">FUN RACE MASCULINO MASTER</option>
                    <option value="07">FUN RACE MASCULINO GRAN MASTER</option>
                    <option value="09">FUN RACE FEMININO MASTER</option>
                    <option value="10">FUN RACE FEMININO GRAN MASTER</option>
                    <option value="11">RACE 12'6 AMADOR MASCULINO</option>
                    <option value="24">RACE 12'6 AMADOR MASCULINO MASTER</option>
                    <option value="25">RACE 12'6 AMADOR MASCULINO G-MASTER</option>
                    <option value="12">RACE 12'6 AMADOR FEMININO</option>
                    <option value="26">RACE 12'6 AMADOR FEMININO MASTER</option>
                    <option value="27">RACE 12'6 AMADOR FEMININO G-MASTER</option>
                    <option value="53">RACE 14 AMADOR MASCULINO</option>
                    <option value="55">RACE 14 AMADOR MASCULINO MASTER</option>
                    <option value="56">RACE 14 AMADOR MASCULINO G-MASTER</option>
                    <option value="54">RACE 14 AMADOR FEMININO</option>
                    <option value="57">RACE 14 AMADOR FEMININO MASTER</option>
                    <option value="58">RACE 14 AMADOR FEMININO G-MASTER</option>
                    <option value="13">RACE 12'6 PRO MASCULINO </option>
                    <option value="14">RACE 12'6 PRO FEMININO </option>
                    <option value="15">RACE 12'6 PRO MASTER MASC</option>
                    <option value="22">RACE 12'6 PRO MASTER FEMININO</option>
                    <option value="16">RACE 12'6 PRO G-MASTER MASC</option>
                    <option value="23">RACE 12'6 PRO G-MASTER FEMININO</option>
                    <option value="17">RACE 14 PRO MASC</option>
                    <option value="29">RACE 14 PRO MASC MASTER</option>
                    <option value="30">RACE 14 PRO MASC G-MASTER</option>
                    <option value="28">RACE 14 PRO FEM</option>
                    <option value="31">RACE 14 PRO FEM MASTER</option>
                    <option value="32">RACE 14 PRO FEM G-MASTER</option>
                    <option value="19">PADDLE BOARD MASCULINO</option>
                    <option value="21">PADDLE BOARD FEMININO</option>
              <!--  <option value="19">PADDLE BOARD</option>
                    <option value="18">UNLIMIT</option>
                    <option value="34">CANOA HAVAIANA OC3 MASC</option> 
                    <option value="40">CANOA HAVAIANA OC1 FEM MASTER</option>
                    <option value="35">CANOA HAVAIANA OC3 FEM</option> 
                    <option value="20">CANOA HAVAIANA OC1 MASC</option>
                    <option value="39">CANOA HAVAIANA OC1 MASC MASTER</option>
                    <option value="33">CANOA HAVAIANA OC1 FEM</option>
                    <option value="36">CANOA HAVAIANA OC6 MISTA</option>-->
      </select> </td>
     </tr>
<!--	  <td>
	      <input type="submit" name="action" value="PÓDIO" style="font-weight:bold" class="btn" id="btnCad">
	  </td>	  -->
	  
	 </form>
	 </table>
		    <br></br>
        <br></br>
        <br></br>
	</body>
</div>	
</html>


<?php
if (@$_POST['categoria'] !== null) {
  $id_etapa = 20;    
  $id_modalidade = $_POST['modalidade'];
  $id_categoria = $_POST['categoria'];
  $coluna = 1;


echo "<div class=container>
            <div class=row> ";
                $etapa = mysqli_query($con,"select * from etapa where idetapa=$id_etapa");
                while ($result = mysqli_fetch_assoc($etapa)){
                  echo '<br>';
                  echo '<h3 align="center">' . $result['nome_etapa'] . "  -  " . $result['local_etapa'] . '</h3>';
                  echo '<br>';
                    $categoria = mysqli_query($con,"select * from categoria where idcategoria='$id_categoria'");
                    while ($result2 = mysqli_fetch_assoc($categoria)){
                     if ($id_modalidade <> 0) {
                       if ($id_modalidade == 01) {
                        echo '<br>';
                        echo '<h3 align="center">' . "RESULTADO PROVA LONGA  " . '</h3>';
                        echo '<h4 align="center">' . $result2['descricao']  . '</h4>';
                        echo '<br>';
                       }else{
                        echo '<br>';
                        echo '<h3 align="center">' . "RESULTADO PROVA TECNICA  " . '</h3>';
                        echo '<h4 align="center">' . $result2['descricao']  . '</h4>';
                        echo '<br>';
                       }   
                    }else {
                      echo '<br>';
                      echo '<h3 align="center">' . "RESULTADO GERAL  " . '</h3>';
                      echo '<h4 align="center">' . $result2['descricao']  . '</h4>';
                      echo '<br>';
                    } 
                   } 
                } 
                 
              
 echo" </div>";
              $count=1;
              if ($id_modalidade <> 00) { 
               if ( $id_modalidade == 01) {
                 echo" <div class=row>
                  <table cellpadding=0  border=0   style=width:700px  align=center class=table table-striped table-bordered >
                  <thead>
                  <tr>
                   <th>RESULTADO</th>        
                   <th>NUMERO</th>
                   <th>NOME</th>
                   <th>CIDADE</th>
                   <th>TEMPO</th>
                  </tr>
                  </thead>
                  <tbody> ";
                    $sql = mysqli_query($con,"SELECT
                              a.nome, a.estado, a.cidade, i.numero, tempo, podio_longa
                              FROM inscricao i JOIN atleta a ON a.cpf = i.atleta_cpf
                              WHERE true 
                              and etapa_idetapa = $id_etapa
                              and i.categoria_idcategoria = $id_categoria
                              and (podio_longa > 0 )
                              order by podio_longa"); 
                          while ($row = mysqli_fetch_assoc($sql)){
                                echo '<tr>';
                                echo '<td>'. $row['podio_longa'] . '</td>';
                                echo '<td>'. $row['numero'] . '</td>';
                                echo '<td>'. $row['nome'] . '</td>';
                                echo '<td>'. $row['cidade'] . '</td>';
                                echo '<td>'. $row['tempo'] . '</td>';
                                echo '</tr>';
                                $count++;
                          }                       

                }else {

                echo" <div class=row>
                  <table cellpadding=0  border=0   style=width:700px  align=center class=table table-striped table-bordered >
                  <thead>
                  <tr>
                   <th>RESULTADO</th>        
                   <th>NUMERO</th>
                   <th>NOME</th>
                   <th>CIDADE</th>
                  </tr>
                  </thead>
                  <tbody> ";
                      $sql = mysqli_query($con,"SELECT
                                a.nome, a.estado, a.cidade, i.numero, i.podio_tecnica
                                FROM inscricao i JOIN atleta a ON a.cpf = i.atleta_cpf
                                WHERE true 
                                and etapa_idetapa = $id_etapa
                                and i.categoria_idcategoria = $id_categoria
                                and podio_tecnica <> 0
                                order by podio_tecnica"); 
                            while ($row = mysqli_fetch_assoc($sql)){
                                  echo '<tr>';
                                  echo '<td>'. $row['podio_tecnica'] . '</td>';
                                  echo '<td>'. $row['numero'] . '</td>';
                                  echo '<td>'. $row['nome'] . '</td>';
                                  echo '<td>'. $row['cidade'] . '</td>';
								  echo '</tr>';
                                  $count++;
                            }           
               }                 
           }else{				      
               echo" <div class=row>
                  <table cellpadding=0  border=0   style=width:500px  align=center class=table table-striped table-bordered >
                  <thead>
                  <tr>
                   <th>#</th>        
                   <th>PONTOS</th> 
                   <th>LONGA</th>
                   <th>TECNICA</th>
                   <th>NUMERO</th>
                   <th>NOME</th>
                   <th>CIDADE</th>
                   <th>TEMPO LONGA</th>
                  </tr>
                  </thead>
                  <tbody> ";
                    $sql = mysqli_query($con,"SELECT
                              podio_longa + podio_tecnica as total_pontos 
                              , a.nome, a.estado,a.cidade, a.cod_cbsup, i.numero , tempo, podio_longa, tempo_t, podio_tecnica
                              FROM inscricao i JOIN atleta a ON a.cpf = i.atleta_cpf
                              WHERE true 
                              and etapa_idetapa = $id_etapa
                              and i.categoria_idcategoria = $id_categoria
                              and (podio_longa > 0)
                              and podio_tecnica <> 0
                              order by 1, podio_longa"); 
                          while ($row = mysqli_fetch_assoc($sql)){
                                echo '<tr>';
                                echo '<td>'. $count . '</td>';
                                echo '<td>'. $row['total_pontos'] . '</td>';
                                echo '<td>'. $row['podio_longa'] . '</td>';
                                echo '<td>'. $row['podio_tecnica'] . '</td>';
                                echo '<td>'. $row['numero'] . '</td>';
                                echo '<td>'. $row['nome'] . '</td>';
                                echo '<td>'. $row['cidade'] . '</td>';
                                echo '<td>'. $row['tempo'] . '</td>';
                                echo '</tr>';
                                $count++;
                           }
                 }      
              
                      
            echo"  </tbody>
            </table>
          </div>

</div>";


}
?>

