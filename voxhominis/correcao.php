<?php
if(isset($_POST['enviar'])){		//testa se o form foi enviado
	 //obtenção dos campos do form
	$c1 = str_replace(',','.',($_POST["campo1"]));	//campo valor a ser corrigido
    $c2 = $_POST["campo2"];	//campo data inicial de referência do período
    $c3 = $_POST["campo3"];	//campo data final de referência do período
	//formatação do período conforme url de requisição no banco central
	$inicial = date('01/m/Y',strtotime($c2));
	$final = date('01/m/Y',strtotime($c3));
 	 //criação da url de consulta
	$url = "https://api.bcb.gov.br/dados/serie/bcdata.sgs.433/dados?formato=json&dataInicial=$inicial&dataFinal=$final";
	$request = wp_remote_get($url);		
	$tudo = wp_remote_retrieve_body($request); //resposta à requisição
	$arr = json_decode($tudo, true);			//decode da requisição json
	 //laço para consultar subarray
	foreach($arr as $sub_array){
  		foreach($sub_array as $chave => $item) {
   			if($chave == "valor") {
      			$valor1[] = ($item/100+1);	//cria vetor com valores de interesse
	}	}	}
	$produto = array_product($valor1);	//produtório dos valores da consulta
	$c4 = ($produto-1)*100;	//cálculo da inflação acumulada
	if($c4 != 0){	//testa se inflação é diferente de 0
		$c4 = $c4;
		$c4p = $c4;}	//retorna inflação acumulada no período
	else{
		$c4 = 1;	//se a inflação é igual a 0
		$c4p = 0;}	//inflação acumulada igual a 0
	$correcao = $c1*($c4/100+1);	//calcula correção monetária
}
?>
