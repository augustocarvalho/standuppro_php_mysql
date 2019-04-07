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
            <h3 align="center">ATLETAS CADASTRADOS</h3>
        </div>
        <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>CPF/RG</th>
                          <th>Nome</th>
                          <th>Nasc</th>
                          <th>Sexo</th>
                          <th>UF</th>
                          <th>Action</th>
                          <th>2019</th>
                          <th>CBSUP</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $count=1;
                        $sql = mysqli_query($con, "SELECT a.*, f.ano as ano from atleta a
                                                      left join filiacao f on f.atleta_cpf = a.cpf and f.ano = 2019
                                                    ORDER by nome");
                        while ($row = mysqli_fetch_assoc($sql)){
                                echo '<tr>';
                                echo '<td>'. $count . '</td>';
                                echo '<td>'. $row['cpf'] . '</td>';
                                echo '<td>'. ucwords(strtolower($row['nome'])) . '</td>';
                                echo '<td>'. $row['data_nascimento'] . '</td>';

                               # $interval = $date->diff( new DateTime( '2015-12-31' ) ); // data definida
                               # echo '<td>'. $interval->format( '%Y Anos' ). '</td>'; 
                                
                                echo '<td>'. $row['sexo'] . '</td>';
                                echo '<td>'. $row['estado'] . '</td>';
                                echo '<td width=300>';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['cpf'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['cpf'].'">Delete</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="inscricao.php?id='.$row['cpf'].'">SUP</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="filiacao.php?id='.$row['cpf'].'">FILIAR</a>';
                                echo '</td>';
                              if ($row['ano'] <> null ) {
                                echo '<td>'. "ok" . '</td>';
                              } else {
                                echo '<td>'. "-" . '</td>';
                              }
                                 echo '<td>'. $row['cod_cbsup'] . '</td>';
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
