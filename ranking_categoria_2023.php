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
                    <option value="05">ALL BOARD MASCULINO</option>
                    <option value="08">ALL BOARD FEMININO</option>
                    <option value="06">ALL BOARD MASCULINO MASTER</option>
                    <option value="07">ALL BOARD MASCULINO GRAN MASTER</option>
                    <option value="119">ALL BOARD MASCULINO KAHUNA</option>
                    <option value="09">ALL BOARD FEMININO MASTER</option>
                    <option value="10">ALL BOARD FEMININO GRAN MASTER</option>
                    <option value="120">ALL BOARD FEMININO KAHUNA</option>
                    <option value="53">RACE AMADOR MASC</option>
                    <option value="55">RACE AMADOR MASC MASTER</option>
                    <option value="56">RACE AMADOR MASC G_MASTER</option>
                    <option value="114">RACE KAHUNA MASC</option>
                    <option value="54">RACE AMADOR FEM</option>
                    <option value="57">RACE AMADOR FEM MASTER</option>
                    <option value="58">RACE AMADOR FEM G-MASTER</option>
                    <option value="115">RACE KAHUNA FEM</option>
                    <option value="113">RACE LEGEND MASC</option>
                    <option value="116">RACE LEGEND FEM</option>
                    <option value="17">RACE PRO MASC</option>
                    <option value="29">RACE PRO MASC MASTER</option>
                    <option value="30">RACE PRO MASC G_MASTER</option>
                    <option value="28">RACE PRO FEM</option>
                    <option value="31">RACE PRO FEM MASTER</option>
                    <option value="32">RACE PRO FEM G-MASTER</option>
                    <option value="19">PADDLE BOARD MASCULINO</option>
                    <option value="21">PADDLE BOARD FEMININO</option>
                    <option value="117">PADDLE BOARD ELITE MASCULINO</option>
                    <option value="118">PADDLE BOARD ELITE FEMININO</option>
                    <option value="110">OC6 MISTA</option> 
                    <option value="111">OC6 MISTA 40+</option>
                    <option value="112">OC6 MISTA 50+</option>
                    <option value="52">SURFSKI MASCULINO</option>
                    <option value="59">SURFSKI MASC 40+</option>
                    <option value="60">SURFSKI MASC 50+</option>
                    <option value="78">SURFSKI MASC 60+</option>
                    <option value="61">SURFSKI FEMININO</option>
                    <option value="76">SURFSKI FEM 40+</option>
                    <option value="77">SURFSKI FEM 50+</option>
                    <option value="88">SURFSKI DUPLO</option>
                    <option value="89">SURFSKI DUPLO 40+</option>
                    <option value="90">SURFSKI DUPLO 50+</option>
                    <option value="90">SURFSKI DUPLO 60+</option>
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
                     echo '<h2 align="center">' . "RANKING ABASUP 2023 " .  '</h2>';
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
                     <th>1ª</th>
                     <th>Pts1</th>
                     <th>2ª</th>
                     <th>Pts2</th>
                     <th>3ª</th>
                     <th>Pts3</th>
                     <th>4ª</th>
                     <th>Pts4</th>                      
                     <th>SOMA</th>
                     <th>Dct 1</th>
                     <th>Pts FINAL</th>

                     </tr>
                   </thead>
                   <tbody> ";
                      $sql = mysqli_query($con,"SELECT nome, cpf, categoria_idcategoria, col_etapa1, pontos1, col_etapa2, pontos2, col_etapa3, pontos3,col_etapa4, pontos4, (pontos1+pontos2+pontos3+pontos4)  as soma
                        ,  discarte1 , ((pontos1+pontos2+pontos3+pontos4) - discarte1) as total
                            , (Select count(*) FROM ranking rr WHERE atleta_cpf = cpf AND etapa_idetapa in (51,52,55,56) AND colocacao = 1 and rr.categoria_idcategoria = resul.categoria_idcategoria) as primeiros
                            ,(Select count(*) FROM ranking rr WHERE atleta_cpf = cpf AND etapa_idetapa in  (51,52,55,56) AND colocacao = 2 and rr.categoria_idcategoria = resul.categoria_idcategoria) as segundos
                            , (Select count(*) FROM ranking rr WHERE atleta_cpf = cpf AND etapa_idetapa in (51,52,55,56) AND colocacao = 3 and rr.categoria_idcategoria = resul.categoria_idcategoria) as terceiros 
                             FROM (
SELECT a.cpf, a.nome as nome, r.categoria_idcategoria 
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 51 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa1 
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 51 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos1  
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 52 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa2 
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 52 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos2  
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 55 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa3 
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 55 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos3  
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 56 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa4 
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 56 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos4  
, d.discarte1
FROM ranking r
JOIN atleta a ON a.cpf = r.atleta_cpf
LEFT JOIN discartes d ON d.atleta_cpf = r.atleta_cpf and d.categoria_idcategoria = r.categoria_idcategoria and ano = 2023 and id_circuito = 1
WHERE etapa_idetapa in (51,52,55,56)
) as resul
WHERE categoria_idcategoria = $id_categoria
GROUP by 1
ORDER BY total desc, primeiros desc, segundos desc, terceiros desc");
                       while ($row = mysqli_fetch_assoc($sql)){
                            echo '<tr>';
                            // $menor = array($row['pontos1'], $row['pontos2'], $row['pontos3'], $row['pontos4'] );
                            // sort($menor);
                            // mysqli_query($con,"update discartes SET discarte1 = $menor[0] WHERE atleta_cpf = $row[cpf] and categoria_idcategoria = $id_categoria and ano = 2023 and id_circuito = 1");
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . ucwords(strtolower($row['nome'])) . '</td>';
                            echo '<td>'. $row['col_etapa1'] . '</td>';
                            echo '<td>'. $row['pontos1'] . '</td>';
                            echo '<td>'. $row['col_etapa2'] . '</td>';
                            echo '<td>'. $row['pontos2'] . '</td>';
                            echo '<td>'. $row['col_etapa3'] . '</td>';
                            echo '<td>'. $row['pontos3'] . '</td>';
                            echo '<td>'. $row['col_etapa4'] . '</td>';
                            echo '<td>'. $row['pontos4'] . '</td>';
                            echo '<td>'. $row['soma'] . '</td>';
                            echo '<td>'. $row['discarte1'] . '</td>';
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

