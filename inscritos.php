<?php
require_once "menu.php";
include 'config.php';

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

?>

<html>
<body>
    <div class="container">
            <div class="row">
			       <?php
                $etapa = mysql_query("select local from etapa where id_etapa='$id'");
                while ($result = mysql_fetch_assoc($etapa)){
                  echo '<br>';
                  echo '<h3 align="center">' . "ATLETAS INSCRITOS - " . $result['local'] . '</h3>';
                  echo '<br>';
                  echo '<br>';
                } 
              ?>
             
            </div>
            <div class="row">
                <table class="table table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th class="col-sm-4">NOME</th>
                      <th>UF</th>
					            <th>CATEGORIA</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $count=1;
				            $sql = mysql_query("SELECT p.nome_participante, p.estado, c.nome_categoria  FROM inscricao i join participante p join categoria c 
												  WHERE id_etapa ='$id' and i.id_participante = p.id_participante and i.id_categoria = c.id_categoria order by c.nome_categoria");
                   	while ($row = mysql_fetch_assoc($sql)){
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>'. $row['nome_participante'] . '</td>';
                            echo '<td>'. $row['estado'] . '</td>';
						              	echo '<td>'. $row['nome_categoria'] . '</td>';
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


