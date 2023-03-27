<?php
header('Content-Type: text/html; charset=UTF-8');
include ("conecta.php");	//arquivo de conexão com o banco de dados
//query de consulta ao banco de dados ordenado por data mais recente
$pega_recado = mysqli_query($con, "SELECT * FROM tabela RIGHT 
OUTER JOIN eventos ON tabela.frente = 
eventos.frente ORDER BY eventos.data DESC") or die
(mysqli_error($con));
//laço para busca dos dados dos campos
while($recado = mysqli_fetch_array($pega_recado)) {
    $id = $recado["id"];
    $var1 = $recado["valor1"];
    $var2 = $recado["valor2"];
    $data = date('d/m/Y',strtotime($dat));
    $var3 = $recado["valor3"];
    $hora = date('H:i',strtotime($inicio));    
//exemplo de impressão em loop dos dados dos eventos registrados no banco de dados   
echo "<p><spam style='border:1px solid #ccc;'>&nbsp;&nbsp;".$var1."&nbsp;&nbsp;</spam><br>
<img src='/evento/imagem/".$var2."' style='float:left; max-height:300px; max-width:400px; min-height:200px;min-width:250px; object-fit:cover;object-position:left; padding-right:2%;'> 
<spam style='font-size:150%;margin-bottom:1%;padding-bottom:1%;'><b>".$var3."</b></spam><br><br>
<b>Data</b><br><spam style='font-size:110%;margin-bottom:1%;padding-bottom:1%;'>".$data." às ".$hora."h</spam><br></p>";
echo "<br>";
}
?>
