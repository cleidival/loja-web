<?php


if(isset($_POST)){	

	$to      = $_POST["to"];
	$subject = 'Contato Perola Negocio';
	$nome = $_POST["nome"];
	$email = $_POST["from"];
	$fone = $_POST["fone"];

	$message = "<h3>Mensagem enviada pelo site PEROLANEGOCIO.COM.BR</h3>";
	$message .= "<b>Nome:</b> ".$nome."<br>";
	$message .= "<b>E-mail:</b> ".$email."<br>";
	$message .= "<b>Fone:</b> ".$fone."<br>";	
	$message .= "<div style='padding: 10px; background: #f1f1f1; display: block;'><h4>Mensagem:</h4> ".$_POST["mensagem"]."</div>";
	
	
	$headers  = "MIME-Version: 1.0\r\n".
				"Content-type: text/html; charset=UTF-8\r\n".
				"From: Contato Site Perola Negocio<noreplay@perolanegocio.com.br>\r\n" .
				"X-Mailer: PHP/" . phpversion();

	if(@mail($to, $subject, $message, $headers)){
		echo "email enviado com sucesso...";
	}else{
		echo "problemas no envio envio do email: ".$to;
	}


}

?>
