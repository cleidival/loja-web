<?php


//if(isset($_POST)){	

	$to      = 'cleidivalf@gmail.com';
	$subject = 'Contato Perola Negocio';
	$message = 'Mensagem teste';
	$headers = 'From: contato@perolanegocio.com' . "\r\n" .
	    'Reply-To: cleidivalf@yahoo.com.br' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);

//}

?>