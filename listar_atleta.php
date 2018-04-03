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
                          <th>CPF/RG</th>
                          <th>Nome</th>
<<<<<<< HEAD
                          <th>Nasc</th>
=======
                          <th>Data de Nasc</th>
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                          <th>Sexo</th>
                          <th>UF</th>
                          <th>Action</th>
                          <th>2018</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $count=1;
<<<<<<< HEAD
                        $sql = mysqli_query($con, "select * from atleta ORDER by nome");
                        while ($row = mysqli_fetch_assoc($sql)){
=======
                        $sql = mysql_query("select * from atleta ORDER by nome limit 500");
                        while ($row = mysql_fetch_assoc($sql)){
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                                echo '<tr>';
                                echo '<td>'. $count . '</td>';
                                echo '<td>'. $row['cpf'] . '</td>';
                                echo '<td>'. $row['nome'] . '</td>';
                                echo '<td>'. $row['data_nascimento'] . '</td>';
<<<<<<< HEAD

=======
                  
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                               # $interval = $date->diff( new DateTime( '2015-12-31' ) ); // data definida
                               # echo '<td>'. $interval->format( '%Y Anos' ). '</td>'; 
                                
                                echo '<td>'. $row['sexo'] . '</td>';
                                echo '<td>'. $row['estado'] . '</td>';
<<<<<<< HEAD
                                echo '<td width=300>';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['cpf'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['cpf'].'">Delete</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="inscricao.php?id='.$row['cpf'].'">SUP</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="filiacao.php?id='.$row['cpf'].'">FILIAR</a>';
=======
                                echo '<td width=250>';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['cpf'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['cpf'].'">Delete</a>';
                                echo ' ';
                                echo '<a class="btn btn-info" href="inscricao.php?id='.$row['cpf'].'">Inscrição</a>';
>>>>>>> 78a8c1f1ce2873b7af7e23a6e004503b67184111
                                echo '</td>';
                              if ($row['filiacao_abasup_2018']) {
                                echo '<td>'. "ok" . '</td>';
                              } else {
                                echo '<td>'. "-" . '</td>';
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
