<?php
require_once "config.php";
require_once "menu.php";
?>



<html>
<div class="container" id="cadastro">
  <div class="row">  
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
    <table id="form_selecao">
  <form  method="post" > 
   <tr>
    <td style="font-weight:bold"> CATEGORIA: </td>
      <td> <select name="categoria" id="categoria" class="selectpicker" onchange="form.submit()">
                    <option value="">Escolha uma abaixo</option>
                    <option value="01"> KIDS MASCULINO</option>
                    <option value="02">KIDS FEMININO</option>
                    <option value="03">JUNIOR MASCULINO</option>
                    <option value="04"> JUNIOR FEMININO</option>
                    <option value="05">FUN RACE MASCULINO</option>
                    <option value="08">FUN RACE FEMININO</option>
                    <option value="06">FUN RACE MASCULINO MASTER</option>
                    <option value="07"> FUN RACE MASCULINO GRAN MASTER</option>
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
                    <option value="30">RACE 14 MASC G_MASTER</option>
                    <option value="28">RACE 14 FEM</option>
                    <option value="31">RACE 14 FEM MASTER</option>
                    <option value="32">RACE 14 FEM G-MASTER</option>
                    <option value="19">PADDLE BOARD MASCULINO</option>
                    <option value="21">PADDLE BOARD FEMININO</option>
              <!--  <option value="19">PADDLE BOARD</option>
                    <option value="30">RACE 14 MASC G_MASTER</option>
                    <option value="32">RACE 14 FEM G-MASTER</option>
                    <option value="18">UNLIMIT</option>
                    <option value="34">CANOA HAVAIANA OC3 MASC</option> 
                    <option value="40">CANOA HAVAIANA OC1 FEM MASTER</option>
                    <option value="35">CANOA HAVAIANA OC3 FEM</option> 
                    <option value="20">CANOA HAVAIANA OC1 MASC</option>
                    <option value="39">CANOA HAVAIANA OC1 MASC MASTER</option>
                    <option value="43">CANOA HAVAIANA OC1 MASC G-MASTER</option>
                    <option value="33">CANOA HAVAIANA OC1 FEM</option>
                    <option value="40">CANOA HAVAIANA OC1 FEM MASTER</option>
                    <option value="44">CANOA HAVAIANA OC1 FEM G-MASTER</option>
                    <option value="36">CANOA HAVAIANA OC6 MISTA</option>
                    <option value="42">MILITAR</option>-->
      </select> </td>
     </tr>
<!--    <td>
        <input type="submit" name="action" value="PÓDIO" style="font-weight:bold" class="btn" id="btnCad">
    </td>   -->
    
   </form>
   </table>
  </body>
</div>  
</html>


<?php
if (@$_POST['categoria'] !== null) {
  $id_categoria = $_POST['categoria'];
  $coluna = 1;


echo " <div class=row> 
            <br>
            <br>
            <br>";

                    $categoria = mysqli_query($con,"select * from categoria where idcategoria='$id_categoria'");
                    while ($result2 = mysqli_fetch_assoc($categoria)){
                     echo '<h2 align="center">' . "RANKING ABASUP 2017 " .  '</h2>';
                     echo '<h3 align="center">' .  $result2['descricao'] . '</h3>';
                    };
                 
                  
              $count=1;
              if ( $id_categoria <> 0) {
                   echo" <div style=margin-left:-20px>
                   <table id='myTable' cellpadding=0  border=0   style=width:400  align=center class='table'>
                   <thead>
                    <tr>
                     <th> #</th>        
                     <th>ATLETA</th>
                     <th>1ª**</th>
                     <th>Pts1</th>
                     <th>2ª*</th>
                     <th>Pts2</th>
                     <th>3ª*</th>
                     <th>Pts3</th>
                     <th>4ª*</th>
                     <th>Pts4</th>
                     <th>5ª*</th>
                     <th>Pts5</th>
                     <th>6ª**</th>
                     <th>Pts6</th>
                     <th>7ª*</th>
                     <th>Pts7</th>
                     <th>SOMA</th>
                     <th>Dct 1</th>
                     <th>Dct 2</th>
                     <th>Pts FINAL</th>
                    </tr>
                   </thead>
                   <tbody> ";
                      $sql = mysqli_query($con,"SELECT nome, cpf, categoria_idcategoria, col_etapa1, pontos1, col_etapa2, pontos2 , col_etapa3, pontos3, col_etapa4, pontos4, col_etapa5, pontos5,col_etapa6, pontos6,col_etapa7, pontos7
                            , (pontos1+pontos2+pontos3+pontos4+pontos5+pontos6+pontos7) as soma
                            ,  discarte1 
                            ,  discarte2
                            , ((pontos1+pontos2+pontos3+pontos4+pontos5+pontos6+pontos7) - discarte1) - discarte2 as total
                            , (Select count(*) FROM ranking WHERE atleta_cpf = cpf AND etapa_idetapa in (10,11,12,13,14,17,19) AND colocacao = 1) as primeiros
                            ,(Select count(*) FROM ranking WHERE atleta_cpf = cpf AND etapa_idetapa in (10,11,12,13,14,17,19) AND colocacao = 2) as segundos
                            , (Select count(*) FROM ranking WHERE atleta_cpf = cpf AND etapa_idetapa in (10,11,12,13,14,17,19) AND colocacao = 3) as terceiros    
                             FROM (
SELECT a.cpf, a.nome as nome, r.categoria_idcategoria 
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 10 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa1  
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 10 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos1 
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 11 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa2  
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 11 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos2
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 12 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa3  
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 12 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos3
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 13 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa4  
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 13 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos4
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 14 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa5  
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 14 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos5
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 17 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa6  
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 17 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos6
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 19 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa7  
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 19 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos7
, d.discarte1
, d.discarte2
FROM ranking r
JOIN atleta a ON a.cpf = r.atleta_cpf
LEFT JOIN discartes d ON d.atleta_cpf = r.atleta_cpf and d.categoria_idcategoria = r.categoria_idcategoria
WHERE etapa_idetapa in (10,11,12,13,14,17,19)
) as resul
WHERE categoria_idcategoria = $id_categoria
GROUP by 1
ORDER BY total desc, primeiros desc, segundos desc, terceiros desc");
                       while ($row = mysqli_fetch_assoc($sql)){
                            echo '<tr>';
                            $menor = array($row['pontos1'], $row['pontos2'], $row['pontos3'], $row['pontos4'], $row['pontos5'], $row['pontos6'], $row['pontos7'] );
                            sort($menor);
                            #mysqli_query($con,"update discartes SET discarte1 = $menor[0], discarte2 = $menor[1] WHERE atleta_cpf = $row[cpf] and $row[categoria_idcategoria] = $id_categoria");
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $row['nome'] . '</td>';
                            echo '<td>'. $row['col_etapa1'] . '</td>';
                            echo '<td>'. $row['pontos1'] . '</td>';
                            echo '<td>'. $row['col_etapa2'] . '</td>';
                            echo '<td>'. $row['pontos2'] . '</td>';
                            echo '<td>'. $row['col_etapa3'] . '</td>';
                            echo '<td>'. $row['pontos3'] . '</td>';
                            echo '<td>'. $row['col_etapa4'] . '</td>';
                            echo '<td>'. $row['pontos4'] . '</td>';
                            echo '<td>'. $row['col_etapa5'] . '</td>';
                            echo '<td>'. $row['pontos5'] . '</td>';
                            echo '<td>'. $row['col_etapa6'] . '</td>';
                            echo '<td>'. $row['pontos6'] . '</td>';
                            echo '<td>'. $row['col_etapa7'] . '</td>';
                            echo '<td>'. $row['pontos7'] . '</td>';
                            echo '<td>'. $row['soma'] . '</td>';
                            echo '<td>'. $row['discarte1'] . '</td>';
                            echo '<td>'. $row['discarte2'] . '</td>';
                            echo '<td>'. $row['total'] . '</td>';
                        #    echo '<td>'. $menor[0] . '</td>';
                        #    echo '<td>'. $menor[1] . '</td>';
                        #    $total_final = $row['total'] - $menor[0] -  $menor[1];
                        #    echo '<td>'. $total_final . '</td>';
                            echo '</tr>';
                            $count++;
                        } 

                    };
                 
            echo"  </tbody>
            </table>
          </div>

</div>";



}
?>

