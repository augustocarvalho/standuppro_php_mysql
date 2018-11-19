<?php
     require_once "config.php";  
     require_once "menu.php";
?>

<!DOCTYPE html>
<html lang="en">
 
<body>
  <head>
<style>
body {
    background-image: url("stdp_atletas.jpg"), url("stdp_resultados02.jpg");
    background-repeat: no-repeat, repeat;
    background-size:100% auto;
    

}
</style>
</head>
    <div class="container">
            <div class="row">
                <br>
                <br>
                <h3 align="center">ATLETAS ABASUP 2018</h3>
            </div>
            <div class="row">
                <table cellpadding=0  border=0   style=width:700px  align=center class=table table-striped table-bordered >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nome</th>
                          <th>Sexo</th>
                          <th>Cidade</th>
                          <th>UF</th>
                          <th>Categoria</th>
                          <th>Sub-Categoria</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $count=1;
                        $sql = mysqli_query($con, "select a.*, c.descricao 
                                               FROM atleta a LEFT JOIN categoria c ON c.idcategoria = a.categoria_idcategoria
                                               WHERE filiacao_abasup_2018 ORDER by descricao, nome");
                        $year = date("Y");
                        $jrkids = array('1','2','3','4');
                        while ($row = mysqli_fetch_assoc($sql)){
                                echo '<tr>';
                                echo '<td>'. $count . '</td>';
                                echo '<td>'. ucwords(strtolower($row['nome'])) . '</td>';
                                echo '<td>'. $row['sexo'] . '</td>';
                                echo '<td>'. $row['cidade'] . '</td>';
                                echo '<td>'. $row['estado'] . '</td>';
                                echo '<td>'. $row['descricao'] . '</td>';
                                sscanf($row['data_nascimento'], '%d-%d-%d', $ano, $mes, $dia);               
                                $idade = $year - $ano;
                                
                                if (($idade>39) and ($idade<50)) {
                                  echo '<td>'. "MASTER" . '</td>';  
                                }    
                                elseif ($idade>49) {
                                  echo '<td>'. "G-MASTER" . '</td>';
                                }
                                else {
                                  if ( in_array($row['categoria_idcategoria'] , $jrkids ) ) {
                                    echo '<td>'. "-" . '</td>';  
                                  } else {
                                    echo '<td>'. 'OPEN' . '</td>';
                                  }
                                }


                                echo '</tr>';
                                $count++;
                        }
             
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
