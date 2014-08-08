<?php
     require_once "config.php";  
     require_once "menu.php";
?>

<!DOCTYPE html>
<html lang="en">
 
<body>
    <div class="container">
            <div class="row">
                <h3 align="center">ATLETAS CADASTRADOS</h3>
            </div>
            <div class="row">
                
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>CPF</th>
                          <th>Nome</th>
                          <th>UF</th>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $count=1;
                        $sql = mysql_query("select * from participante ORDER by id_participante limit 500");
                        while ($row = mysql_fetch_assoc($sql)){
                                echo '<tr>';
                                echo '<td>'. $count . '</td>';
                                echo '<td>'. $row['id_participante'] . '</td>';
                                echo '<td>'. $row['nome_participante'] . '</td>';
                                echo '<td>'. $row['estado'] . '</td>';
                                echo '<td>'. $row['email'] . '</td>';
                                echo '<td width=150>';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id_participante'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id_participante'].'">Delete</a>';
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
