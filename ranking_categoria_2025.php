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
                    <option value="17">RACE 14 PRO MASC</option>
                    <option value="29">RACE 14 PRO MASC MASTER</option>
                    <option value="30">RACE 14 PRO MASC G-MASTER</option>
                    <option value="121">RACE 14 PRO MASC KAHUNA</option>
                    <option value="28">RACE 14 PRO FEM</option>
                    <option value="31">RACE 14 PRO FEM MASTER</option>
                    <option value="32">RACE 14 PRO FEM G-MASTER</option>
                    <option value="122">RACE 14 PRO FEM KAHUNA</option>
                    <option value="19">PADDLE BOARD MASCULINO</option>
                    <option value="21">PADDLE BOARD FEMININO</option>
                    <option value="117">PADDLE BOARD ELITE MASCULINO</option>
                    <option value="118">PADDLE BOARD ELITE FEMININO</option>
                    <option value="49">V1R KIDS MASC</option>
                    <option value="73">V1R KIDS FEM</option>
                    <option value="20">V1R MASC</option>
                    <option value="39">V1R MASC 40+</option>
                    <option value="43">V1R MASC 50+</option>
                    <option value="74">V1R MASC 60+</option>
                    <option value="33">V1R FEM</option>
                    <option value="40">V1R FEM 40+</option>
                    <option value="44">V1R FEM 50+</option>
                    <option value="79">V2R MASC</option>
                    <option value="80">V2R MASC 40+</option>
                    <option value="81">V2R MASC 50+</option>
                    <option value="82">V2R FEM</option>
                    <option value="83">V2R FEM 40+</option>
                    <option value="84">V2R FEM 50+</option>
                    <option value="85">V2R MISTA</option>
                    <option value="86">V2R MISTA 40+</option>
                    <option value="87">V2R MISTA 50+</option>
                    <option value="99">V4R MASC</option>
                    <option value="100">V4R FEM</option>
                    <option value="101">V4R MISTA</option>
                    <option value="102">V4R JUNIOR</option>
                    <option value="46">V6 MASC</option>
                    <option value="93">V6 MASC 40+</option>
                    <option value="94">V6 MASC 50+</option>
                    <option value="45">V6 FEM</option>
                    <option value="95">V6 FEM 40+</option>
                    <option value="96">V6 FEM 50+</option>
                    <option value="92">V6 MISTA</option>
                    <option value="97">V6 MISTA 40+</option>
                    <option value="98">V6 MISTA 50+</option>
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
                    <option value="75">V1 MASC</option>
                    <option value="103">V1 FEM</option>
                    <option value="104">OC6 MASC</option>
                    <option value="105">OC6 MASC 40+</option>
                    <option value="106">OC6 MASC 50+</option>
                    <option value="107">OC6 FEM</option>
                    <option value="108">OC6 FEM 40+</option>
                    <option value="109">OC6 FEM 50+</option>
                    <option value="110">OC6 MISTA</option> 
                    <option value="111">OC6 MISTA 40+</option>
                    <option value="112">OC6 MISTA 50+</option>
                    
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
                     echo '<h2 align="center">' . "RANKING ABASUP 2025 " .  '</h2>';
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
                     <th>TOTAL</th>                     
                     </tr>
                   </thead>
                   <tbody> ";
                      $sql = mysqli_query($con,"SELECT nome, cpf, categoria_idcategoria, col_etapa1, pontos1, (pontos1)  as total                                                
                             FROM (
SELECT a.cpf, a.nome as nome, r.categoria_idcategoria 
,ifnull((SELECT colocacao FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 65 and categoria_idcategoria = r.categoria_idcategoria), '-') as col_etapa1 
,ifnull((SELECT pontos FROM ranking WHERE atleta_cpf = r.atleta_cpf and etapa_idetapa = 65 and categoria_idcategoria = r.categoria_idcategoria), 0) as pontos1  
FROM ranking r
JOIN atleta a ON a.cpf = r.atleta_cpf
WHERE etapa_idetapa in (65)
) as resul
WHERE categoria_idcategoria = $id_categoria
GROUP by 1
ORDER BY total DESC");
                       while ($row = mysqli_fetch_assoc($sql)){
                            echo '<tr>';
                            // $menor = array($row['pontos1'], $row['pontos2'], $row['pontos3'], $row['pontos4'] );
                            // sort($menor);
                            // mysqli_query($con,"update discartes SET discarte1 = $menor[0] WHERE atleta_cpf = $row[cpf] and categoria_idcategoria = $id_categoria and ano = 2024 and id_circuito = 1");
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . ucwords(strtolower($row['nome'])) . '</td>';
                            echo '<td>'. $row['col_etapa1'] . '</td>';
                            echo '<td>'. $row['pontos1'] . '</td>';
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

