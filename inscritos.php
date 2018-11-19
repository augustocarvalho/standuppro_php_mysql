<?php
require_once "config.php";
require_once "menu.php";

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
?>

<html>
<body>
       <head>
        <style>
        body {
            background-image: url("stdp_resultados01logo.jpg"), url("stdp_resultados02.jpg");
            background-repeat: no-repeat, repeat;
            background-size:100% auto;
        }

       .nav > li > a > img {
          height: 80px;
        }
        </style>
      </head> 
  <div class=container>  
  <div class="row">
  <table id="form_selecao"">
  <form method="post"> 
    <tr>
    <td style="font-weight:bold" > CATEGORIA: </td>
      <td> <select name='categoria' id="categoria" class="selectpicker" onchange="form.submit()" >
                    <option value="">Escolha uma abaixo</option>
                    <option value="00">GERAL</option>
                    <option value="01">KIDS MASCULINO</option>
                    <option value="02">KIDS FEMININO</option>
                    <option value="03">JUNIOR MASCULINO</option>
                    <option value="04">JUNIOR FEMININO</option>
                    <option value="05">FUN RACE MASCULINO</option>
                    <option value="06">FUN RACE MASCULINO MASTER</option>
                    <option value="07">FUN RACE MASCULINO GRAN MASTER</option>
                    <option value="08">FUN RACE FEMININO</option>
                    <option value="09">FUN RACE FEMININO MASTER</option>
                    <option value="10">FUN RACE FEMININO GRAN MASTER</option>
                    <option value="11">RACE 12'6 AMADOR MASCULINO</option>
                    <option value="24">RACE 12'6 AMADOR MASCULINO MASTER</option>
                    <option value="25">RACE 12'6 AMADOR MASCULINO G-MASTER</option>
                    <option value="71">RACE 12'6 AMADOR MASCULINO LEGEND</option>
                    <option value="12">RACE 12'6 AMADOR FEMININO</option>
                    <option value="26">RACE 12'6 AMADOR FEMININO MASTER</option>
                    <option value="27">RACE 12'6 AMADOR FEMININO G-MASTER</option>
                    <option value="72">RACE 12'6 AMADOR FEMININO LEGEND</option>
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
                    <option value="20">CANOA OC1 MASCULINO</option>
                    <option value="39">CANOA OC1 MASCULINO MASTER</option>
                    <option value="43">CANOA OC1 MASCULINO G-MASTER</option>
                    <option value="33">CANOA OC1 FEMININO</option>
                    <option value="40">CANOA OC1 FEMININO MASTER</option>
                    <option value="44">CANOA OC1 FEMININO G-MASTER</option>    
                    <option value="46">CANOA OC6 MASCULINO</option>
                    <option value="45">CANOA OC6 FEMININO</option> 
                    <option value="49">CANOA OC1 KIDS</option>
                    <option value="73">CANOA OC1 KIDS FEMININO</option>
          </select> </td>
     </tr>
   
  <!-- <td>
       <input type="submit" name="action"  value="LISTAR INSCRITOS" style="font-weight:bold" class="btn" id="btnCad">
    </td> -->   
   </form>
   </table>
   </div>
   <div class="row">
      <br>
      <br>
      <br>
<?php
if (@$_POST['categoria'] !== null) {
  $id_categoria = $_POST['categoria'];
  $coluna = 1;
                $etapa = mysqli_query($con,"select * from etapa where idetapa='$id'");
                while ($result = mysqli_fetch_assoc($etapa)){
                  echo '<h3 align="center">' . $result['nome_etapa'] . "  -  " . $result['local_etapa'] . '</h3>';
                  echo '<br>';
                  if ($id_categoria <> 0) {
                    $categoria = mysqli_query($con,"select * from categoria where idcategoria='$id_categoria'");
                    while ($result2 = mysqli_fetch_assoc($categoria)){
                     echo '<br>';
                     echo '<h3 align="center">' . "CATEGORIA: " . $result2['descricao'] . '</h3>';
                    }
                  } else {
                      echo '<br>';
                      echo '<h3 align="center">' . "TODOS ATLETAS INSCRITOS " . '</h3>';
                      echo '<br>';
                  } 
                } 
                  
                
echo"             
                <table cellpadding=0  border=0   style=width:800px  align=center class=table table-striped table-bordered >
                  <thead>
                    <tr>
					 
                 	    <th>Número</th>
					            <th class=col-sm-4>NOME</th>
                      <th>Cidade</th>
                      <th>UF</th>";
                     if ($id_categoria == 0) {
                       echo"<th>Categoria</th>";
                      }
					    echo"</tr>
                  </thead>
                  <tbody>";
                    $count=1;
				            if ( $id_categoria <> 0) {
                      $sql = mysqli_query($con,"SELECT i.numero, p.nome, p.estado, p.cidade, c.descricao
                        , CASE WHEN count(*) = 2 THEN (SELECT c1.descricao FROM categoria c1 WHERE c1.idcategoria = max(i.categoria_idcategoria)) 
                              ELSE c.descricao END as descricao ,
                             CASE WHEN (p.filiacao_abasup_2018 and p.categoria_idcategoria = i.categoria_idcategoria) THEN 'OK'
                                  ELSE ' - ' END as filiacao_2018
                          , p.cod_cbsup  
                          FROM inscricao i join atleta p join categoria c 
                          WHERE i.etapa_idetapa ='$id' and i.categoria_idcategoria = '$id_categoria' and i.atleta_cpf = p.cpf and i.categoria_idcategoria = c.idcategoria GROUP by i.numero
                            order by i.numero");
                    }else {
                      $sql = mysqli_query($con,"SELECT i.numero, p.nome, p.cidade, p.estado, p.cod_cbsup, 
                            CASE WHEN count(*) = 2 THEN (SELECT c1.descricao FROM categoria c1 WHERE c1.idcategoria = max(i.categoria_idcategoria)) 
                              ELSE c.descricao END as descricao ,
                             CASE WHEN (p.filiacao_abasup_2018 and p.categoria_idcategoria = i.categoria_idcategoria) THEN 'OK'
                                  ELSE ' - ' END as filiacao_2018
                              FROM inscricao i 
                              join atleta p ON i.atleta_cpf = p.cpf 
                              join categoria c ON c.idcategoria = i.categoria_idcategoria
                              WHERE i.etapa_idetapa = '$id'
                              and i.atleta_cpf = p.cpf 
                              and i.categoria_idcategoria = c.idcategoria 
                              GROUP by i.numero
                              order by i.numero");  
                    }
                   	while ($row = mysqli_fetch_assoc($sql)){
                            echo '<tr>';
                            echo '<td>' . $row['numero'] . '</td>';
                            echo '<td>'.  ucwords(strtolower($row['nome'])) . '</td>';
                            echo '<td>'. $row['cidade'] . '</td>';
                            echo '<td>'. $row['estado'] . '</td>';
                            if ($id_categoria == 0) {
                              echo '<td>'. $row['descricao'] . '</td>';
                            }
                            echo '<td width=150>';
                            echo '<a class="btn btn-success" href="update_inscritos.php?id='.$id.'&cod='.$row['numero'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete_inscricao.php?id='.$id.'&cod='.$row['numero'].'">Delete</a>';
                            echo '</tr>';
                            $count++;
                    }
  
  echo"  
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->";

}
else {
  $id_categoria = 00;
  $coluna = 1;
            
                $etapa = mysqli_query($con,"select * from etapa where idetapa='$id'");
                while ($result = mysqli_fetch_assoc($etapa)){
                  echo '<h3 align="center">' . $result['nome_etapa'] . "  -  " . $result['local_etapa'] . '</h3>';
                  echo '<br>';
                  if ($id_categoria <> 0) {
                    $categoria = mysqli_query($con,"select * from categoria where idcategoria='$id_categoria'");
                    while ($result2 = mysqli_fetch_assoc($categoria)){
                     echo '<br>';
                     echo '<h3 align="center">' . "CATEGORIA: " . $result2['descricao'] . '</h3>';
                     echo '<br>';
                    }
                  } else {
                      echo '<br>';
                      echo '<h3 align="center">' . "TODOS ATLETAS INSCRITOS " . '</h3>';
                      echo '<br>';
                  } 
                } 
                  
                
echo"             
                <table cellpadding=0  border=0   style=width:800px  align=center class=table table-striped table-bordered >
                  <thead>
                    <tr>
           
                      <th>Número</th>
                      <th class=col-sm-4>NOME</th>
                      <th>CIDADE</th>
                      <th>UF</th>
                      <th>CATEGORIA</th>
                      <th>ABASUP 2018</th>
                    </tr>
                  </thead>
                  <tbody>";
                    $count=1;
                    if ( $id_categoria <> 0) {
                      $sql = mysqli_query($con,"SELECT i.numero, p.nome, p.cidade, p.estado, c.descricao  FROM inscricao i join atleta p join categoria c 
                          WHERE i.etapa_idetapa ='$id' and i.categoria_idcategoria = '$id_categoria' and i.atleta_cpf = p.cpf and i.categoria_idcategoria = c.idcategoria order by i.numero");
                    }else {
                      $sql = mysqli_query($con,"SELECT i.numero, p.nome, p.cidade, p.estado, p.cod_cbsup, 
                            CASE WHEN count(*) = 2 THEN (SELECT c1.descricao FROM categoria c1 WHERE c1.idcategoria = max(i.categoria_idcategoria)) 
                              ELSE c.descricao END as descricao ,
                             CASE WHEN (p.filiacao_abasup_2018 and p.categoria_idcategoria = i.categoria_idcategoria) THEN 'OK'
                                  ELSE ' - ' END as filiacao_2018
                              FROM inscricao i 
                              join atleta p ON i.atleta_cpf = p.cpf 
                              join categoria c ON c.idcategoria = i.categoria_idcategoria
                              WHERE i.etapa_idetapa = '$id'
                              and i.atleta_cpf = p.cpf 
                              and i.categoria_idcategoria = c.idcategoria 
                              GROUP by i.numero
                              order by p.nome");  
                    }
                    while ($row = mysqli_fetch_assoc($sql)){
                            echo '<tr>';
                            echo '<td>' . $row['numero'] . '</td>';
                            echo '<td>'. ucwords(strtolower($row['nome'])) . '</td>';
                            echo '<td>'. $row['cidade'] . '</td>';
                            echo '<td>'. $row['estado'] . '</td>';
                            echo '<td>'. $row['descricao'] . '</td>';
                            echo '<td>'. $row['filiacao_2018'] . '</td>';
                          /*  if ($row['filiacao_abasup_2018']) {
                              echo '<td>'. "ok" . '</td>';
                            } else {
                              echo '<td>'. "-" . '</td>';
                            }
                            echo '<td>'. $row['cod_cbsup'] . '</td>'; */
                            echo '</tr>';
                            $count++;
                    }
  
  echo"  
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->";
}    

?>    
  </body>
</html> 



