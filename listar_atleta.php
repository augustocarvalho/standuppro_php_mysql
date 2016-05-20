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
                <h3 align="center">ATLETAS CADASTRADOS</h3>
            </div>
             <br></br>

            <div class="row">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>CPF</th>
                          <th>Nome</th>
                          <th>Data de Nasc</th>
                          <th>Sexo</th>
                          <th>UF</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $count=1;
                        $sql = mysql_query("select * from atleta ORDER by nome limit 500");
                        while ($row = mysql_fetch_assoc($sql)){
                                echo '<tr>';
                                echo '<td>'. $count . '</td>';
                                echo '<td>'. $row['cpf'] . '</td>';
                                echo '<td>'. $row['nome'] . '</td>';
                                echo '<td>'. $row['data_nascimento'] . '</td>';
                  
                               # $interval = $date->diff( new DateTime( '2015-12-31' ) ); // data definida
                               # echo '<td>'. $interval->format( '%Y Anos' ). '</td>'; 
                                
                                echo '<td>'. $row['sexo'] . '</td>';
                                echo '<td>'. $row['estado'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['cpf'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['cpf'].'">Delete</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="inscricao.php?id='.$row['cpf'].'">Inscrição</a>';
                                echo '</td>';
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
