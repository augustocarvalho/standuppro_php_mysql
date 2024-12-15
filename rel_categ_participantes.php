<?php
require_once "menu.php";
include 'config.php';

    $id = 1;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
	
	
	$id_categoria = $_GET['idc'];
	

?>

<html>
<body>
    <div class="container">
            <div class="row">
			       <?php
				$categ = mysql_query(" select * from categoria where id_categoria='$id_categoria'");  
                $etapa = mysql_query("select local from etapa where id_etapa='$id'");
					while ($result_categ = mysql_fetch_assoc($categ)){	
							while ($result = mysql_fetch_assoc($etapa)){
							  echo '<br>';
							  echo '<h3 align="center">' . $result['local'] .  '</h3>';
							  echo '<h4 align="center">' . $result_categ['nome_categoria'] .  '</h4>';
							 echo '<br>';
							  echo '<br>';
							}
                    }
              ?>
             
            </div>
            <div class="row">
                <table cellpadding="0" cellspacing="0" border="0"   style="width: 600px"  align="center" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>INSCRIÇÃO</th>
                      <th>NOME</th>
                      <th>UF</th>
					  <th>TEMPO</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
						
						$count=1;
					    $sql = mysql_query("SELECT p.nome_participante, p.estado, i.tempo, i.cod_inscricao FROM inscricao i join participante p  
												  WHERE id_etapa='$id' and  i.id_categoria='$id_categoria' and i.id_participante=p.id_participante order by tempo");
                   	while ($row = mysql_fetch_assoc($sql)){
                            echo '<tr>';
                            echo '<td>' . $row['cod_inscricao'] . '</td>';
                            echo '<td>'. $row['nome_participante'] . '</td>';
                            echo '<td class="span1">'. $row['estado'] . '</td>';
						              	echo '<td>'. $row['tempo'] . '</td>';
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