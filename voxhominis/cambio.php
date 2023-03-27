<php
	 //função de requisição por consulta API json para cotação diária de moeda
function cotacao($moeda){	
$url = "http://economia.awesomeapi.com.br/json/last/$moeda";
$request = wp_remote_get($url);
$tudo = wp_remote_retrieve_body($request);
$arr = json_decode($tudo, true);
foreach($arr as $sub_array){
	foreach($sub_array as $chave => $item) {
                if($chave == "bid"){
                $compra = $item;}
				if($chave == "ask"){
				$venda = $item;}
	}
}
return array($compra,$venda);
}
?>
