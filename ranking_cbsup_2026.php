<?php
require_once "config.php";
require_once "menu.php";

$categorias = mysqli_query($con, "SELECT DISTINCT c.idcategoria, TRIM(c.descricao) AS descricao
  FROM categoria c
  JOIN ranking_circuito r ON r.categoria_idcategoria = c.idcategoria
  WHERE r.circuito_idcircuito = 2
  AND r.etapa_idetapa IN (74, 76, 78)
  ORDER BY descricao");
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
<?php while ($categoriaOpcao = mysqli_fetch_assoc($categorias)) { ?>
                    <option value="<?= $categoriaOpcao['idcategoria'] ?>"<?= (isset($_POST['categoria']) && $_POST['categoria'] == $categoriaOpcao['idcategoria']) ? ' selected' : '' ?>><?= htmlspecialchars($categoriaOpcao['descricao']) ?></option>
<?php } ?>
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
                     echo '<h2 align="center">' . "RANKING CBSUP 2026 " .  '</h2>';
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
                     <th>SOMA</th>                    
                     </tr>
                   </thead>
                   <tbody> ";
                      $sql = mysqli_query($con,"SELECT nome, cpf, categoria_idcategoria, col_etapa1, pontos1, col_etapa2, pontos2, col_etapa3, pontos3
                      , (pontos1+pontos2+pontos3)  as soma
                      -- , discarte1
                      -- , discarte2
                      -- , ((pontos1+pontos2+pontos3+pontos4+pontos5+pontos6+pontos7) - discarte1) - discarte2 as total        
                      -- , (Select count(*) FROM ranking_circuito rr WHERE atleta_cpf = cpf AND etapa_idetapa in (74) AND colocacao = 1 and rr.categoria_idcategoria = resul.categoria_idcategoria) as primeiros
                      -- , (Select count(*) FROM ranking_circuito rr WHERE atleta_cpf = cpf AND etapa_idetapa in (74) AND colocacao = 2 and rr.categoria_idcategoria = resul.categoria_idcategoria) as segundos
                      -- , (Select count(*) FROM ranking_circuito rr WHERE atleta_cpf = cpf AND etapa_idetapa in (74) AND colocacao = 3 and rr.categoria_idcategoria = resul.categoria_idcategoria) as terceiros                                                                 
                             FROM (
SELECT a.cpf, a.nome as nome, r.categoria_idcategoria 
,ifnull((SELECT colocacao FROM ranking_circuito WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 74 and categoria_idcategoria = r.categoria_idcategoria and circuito_idcircuito = 2), '-') as col_etapa1 
,ifnull((SELECT pontos FROM ranking_circuito WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 74 and categoria_idcategoria = r.categoria_idcategoria and circuito_idcircuito = 2), 0) as pontos1
,ifnull((SELECT colocacao FROM ranking_circuito WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 76 and categoria_idcategoria = r.categoria_idcategoria and circuito_idcircuito = 2), '-') as col_etapa2 
,ifnull((SELECT pontos FROM ranking_circuito WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 76 and categoria_idcategoria = r.categoria_idcategoria and circuito_idcircuito = 2), 0) as pontos2   
,ifnull((SELECT colocacao FROM ranking_circuito WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 78 and categoria_idcategoria = r.categoria_idcategoria and circuito_idcircuito = 2), '-') as col_etapa3
,ifnull((SELECT pontos FROM ranking_circuito WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 78 and categoria_idcategoria = r.categoria_idcategoria and circuito_idcircuito = 2), 0) as pontos3
-- , d.discarte1
-- , d.discarte2
FROM ranking_circuito r
JOIN atleta a ON a.cpf = r.atleta_cpf
-- LEFT JOIN discartes d ON d.atleta_cpf = r.atleta_cpf and d.categoria_idcategoria = r.categoria_idcategoria and ano = 2026 and circuito_idcircuito = 1
WHERE etapa_idetapa in (74,76,78)
and circuito_idcircuito = 2 -- cbsup
) as resul
WHERE categoria_idcategoria = $id_categoria
GROUP by 1
ORDER BY soma desc");
                       while ($row = mysqli_fetch_assoc($sql)){
                            echo '<tr>';
                            // $menor = array($row['pontos1'], $row['pontos2'], $row['pontos3'], $row['pontos4'], $row['pontos5'], $row['pontos6'], $row['pontos7']  );
                            // sort($menor);
                            // mysqli_query($con,"update discartes SET discarte1 = $menor[0], discarte2 = $menor[1] WHERE atleta_cpf = $row[cpf] and categoria_idcategoria = $id_categoria and ano = 2025 and circuito_idcircuito = 1");
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . ucwords(strtolower($row['nome'])) . '</td>';
                            echo '<td>'. $row['col_etapa1'] . '</td>';
                            echo '<td>'. $row['pontos1'] . '</td>';
                            echo '<td>'. $row['col_etapa2'] . '</td>';
                            echo '<td>'. $row['pontos2'] . '</td>';
                            echo '<td>'. $row['col_etapa3'] . '</td>';
                            echo '<td>'. $row['pontos3'] . '</td>';
                            echo '<td>'. $row['soma'] . '</td>';                            
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

