<?php
header('Content-Type: text/html; charset=UTF-8');
include ('conecta.php');	//arquivo de conexão com o banco de dados
if(empty($_POST)) echo 'Impossível acessar. Ir para <a href="https://dominio.com.br">EXEMPLO</a>';	//testa se não houve envio de dados pelo método post
else{ 
	//variáveis recebem valores enviados pelo formulário
	$var1 = $_POST['valor1']; 
	$var2 = $_POST['valor2'];
	$var3 = $_POST['valor3'];
	//tratamento de imagens
	$ext = strtolower(substr($_FILES['imagem']['name'],-4)); //Pegando extensão do arquivo
 	$new_name = date("Y.m.d-H.i.s"). $frente . $ext; //Definindo um novo nome para o arquivo
 	$dir = '/diretorio/XXX/'; //Diretório para uploads
	move_uploaded_file($_FILES['imagem']['tmp_name'], $dir.$new_name);
	$mensagem = "Notificação de recebimento de formulário.";
	$enviarPara = 'email@email.com'; 
	$header = 'From: Eventos <no-reply@dominio.com.br' .  "\n"; 
	$header .= 'Content-Type: text/html; charset=utf-8'. "\r\n"; 
	$assunto= 'Cadastro de Evento'; 
	$enviaMail = mail($enviarPara,$assunto,$mensagem,$header); //método mail para envio de mensagem
	//query de inclusão de dados no banco
	$qr="INSERT INTO eventos_ageacac VALUES ('','".$frente."','".$data."','".$inicio."','".$tipo."','".$titulo."','".$palestrante."','".$local."','".$endereco."','".$cidade."','".$uf."','".$organizador."','".$info."','".$new_name."')";
	$inserir = mysqli_query($con,$qr) or die (mysqli_error($con));	//insere dados no banco
		if ($inserir){	//se não houve erro de query
			echo "<script>alert('Evento incluido com sucesso.'); window.location.href='https://dominio.com.br';</script>";
			echo '$enviaMail';	//dispara e-mail
		} else {
			echo "<script>alert('Não foi possível incluir o evento, tente novamente.'); window.location.href='https://dominio.com.br';</script>";
		}
}
?>
