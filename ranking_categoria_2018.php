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
        .nav > li > a > img {
          height: 80px;
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
                    <option value="11">RACE 12'6 AMADOR MASCULINO</option>
                    <option value="24">RACE 12'6 AMADOR MASCULINO MASTER</option>
                    <option value="25">RACE 12'6 AMADOR MASCULINO G-MASTER</option>
                    <option value="12">RACE 12'6 AMADOR FEMININO</option>
                    <option value="26">RACE 12'6 AMADOR FEMININO MASTER</option>
                    <option value="27">RACE 12'6 AMADOR FEMININO G-MASTER</option>                    
                    <option value="13">RACE 12'6 PRO MASCULINO </option>
                    <option value="14">RACE 12'6 PRO FEMININO </option>
                    <option value="15">RACE 12'6 PRO MASTER MASC</option>
                    <option value="22">RACE 12'6 PRO MASTER FEMININO</option>
                    <option value="16">RACE 12'6 PRO G-MASTER MASC</option>
                    <option value="23">RACE 12'6 PRO G-MASTER FEMININO</option>
                    <option value="17">RACE 14 PRO MASC</option>
                    <option value="29">RACE 14 PRO MASC MASTER</option>
                    <option value="30">RACE 14 PRO MASC G_MASTER</option>
                    <option value="28">RACE 14 PRO FEM</option>
                    <option value="31">RACE 14 PRO FEM MASTER</option>
                    <option value="32">RACE 14 PRO FEM G-MASTER</option>
                    <option value="53">RACE 14 AMADOR MASC</option>
                    <option value="55">RACE 14 AMADOR MASC MASTER</option>
                    <option value="56">RACE 14 AMADOR MASC G_MASTER</option>
                    <option value="54">RACE 14 AMADOR FEM</option>
                    <option value="57">RACE 14 AMADOR FEM MASTER</option>
                    <option value="58">RACE 14 AMADOR FEM G-MASTER</option>
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
                     echo '<h2 align="center">' . "RANKING ABASUP 2018 " .  '</h2>';
                     echo '<h3 align="center">' .  $result2['descricao'] . '</h3>';
                     echo '<br>';
                    };
                 
                  
              $count=1;
              if ( $id_categoria <> 0) {
                   echo" <div style=margin-left:-20px>
                   <table id='myTable' cellpadding=0  border=0   style=width:700  align=center class='table'>
                   <thead>
                    <tr>
                     <th> #</th>        
                     <th>ATLETA</th>
                     <th>1ª*</th>
                     <th>Pts1</th>
                     <th>2ª</th>
                     <th>Pts2</th>
                     <th>3ª</th>
                     <th>Pts3</th>
                     <th>4ª</th>
                     <th>Pts4</th>
                     <th>Total</th>
                     </tr>
                   </thead>
                   <tbody> ";
                      $sql = mysqli_query($con,"SELECT nome, cpf, categoria_idcategoria, col_etapa1, pontos1, (pontos1) as total
                             FROM (
SELECT a.cpf, a.nome as nome, r.categoria_idcategoria 
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 20 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa1  
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 20 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos1 
FROM ranking r
JOIN atleta a ON a.cpf = r.atleta_cpf
WHERE etapa_idetapa in (20)
) as resul
WHERE categoria_idcategoria = $id_categoria
GROUP by 1 order by total desc");
                       while ($row = mysqli_fetch_assoc($sql)){
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $row['nome'] . '</td>';
                            echo '<td>'. $row['col_etapa1'] . '</td>';
                            echo '<td>'. $row['pontos1'] . '</td>';
                            echo '<td>'. '-' . '</td>';
                            echo '<td>'. '-' . '</td>';
                            echo '<td>'. '-' . '</td>';
                            echo '<td>'. '-' . '</td>';
                            echo '<td>'. '-' . '</td>';
                            echo '<td>'. '-' . '</td>';
                            echo '<td>'. $row['total'] . '</td>';
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
