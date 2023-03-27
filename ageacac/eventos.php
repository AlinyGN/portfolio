<?php
header('Content-Type: text/html; charset=UTF-8');
include ("conecta.php");	//arquivo de conexão com o banco de dados
//query de consulta ao banco de dados
$pega_recado = mysqli_query($con, "SELECT * FROM organizadores RIGHT 
OUTER JOIN eventos_ageacac ON organizadores.frente = 
eventos_ageacac.frente ORDER BY eventos_ageacac.data DESC") or die
(mysqli_error($con));
//laço para busca dos dados dos campos
while($recado = mysqli_fetch_array($pega_recado)) {
    $id = $recado["id"];
    $frente = $recado["frente"];
    $dat = $recado["data"];
    $data = date('d/m/Y',strtotime($dat));
    $inicio = $recado["inicio"];
    $hora = date('H:i',strtotime($inicio));
    $tipo = $recado["tipo"];
    $titulo = $recado["titulo"];
    $palestrante = $recado["palestrante"];
    $local = $recado["local"];
    $endereco = $recado["endereco"];
    $cidade = $recado["cidade"];
    $uf = $recado["uf"];
    $info = $recado["info"];
    $orga = $recado["organizador"];
    $nome = $recado["nome"];
    $formulario = $recado["formulario"];
//impressão dos dados dos eventos registrados no banco de dados    
echo "<p><spam style='border:1px solid #ccc;'>&nbsp;&nbsp;".$tipo."&nbsp;&nbsp;</spam><br>
<img src='/evento/imagem/".$nome."' style='float:left; max-height:300px; max-width:400px; min-height:200px;min-width:250px; object-fit:cover;object-position:left; padding-right:2%;'> 
<spam style='font-size:150%;margin-bottom:1%;padding-bottom:1%;'><b>".$titulo."</b></spam><br><br>
<b>Data</b><br><spam style='font-size:110%;margin-bottom:1%;padding-bottom:1%;'>".$data." às ".$hora."h</spam><br>
<b>Local</b><br><spam style='font-size:110%;'>".$endereco." ".$cidade."/".$uf."</spam></p>
<p>".nl2br($info)."<br><br>
<b>Organização</b><br>AGEACAC ".$cidade."</p>";
echo"
<!--<a href='https://ageacac.org.br/detalhes/local/".$id."' target='_blank'><button class='bot-event-a'>VER DETALHES</button><a>-->
<a href='".$formulario."' target='_blank'><button class='bot-event-b'>INSCREVER-SE</button></a><br>
<br><br>
";
echo "<br>";
}
?>
