<?php
    require 'config.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    
    $cod = null;
    if ( !empty($_GET['cod'])) {
        $cod = $_REQUEST['cod'];
    }

    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
        $cod = $_POST['cod']; 
        // delete data
        mysql_query("DELETE FROM inscricao  WHERE etapa_idetapa='$id' and numero='$cod'");
        header("Location: inscritos.php?id=$id");
    }
?>
 
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>EXCLUIR INSCRIÇÃO</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete_inscricao.php?id=<?php echo $id?>&cod=<?php echo $cod?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                       <input type="hidden" name="cod" value="<?php echo $cod;?>"/>
                      <p class="alert alert-error">Tem certeza ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="inscritos.php?id=<?php echo $id?>">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
