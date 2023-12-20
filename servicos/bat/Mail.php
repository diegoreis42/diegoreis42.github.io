<?php

	$name 	    = $_POST['name'];
	$email   = $_POST['email'];
	$phone   = $_POST["phone"];
	$message  = $_POST['message'];
	 
	$corpoMSG = "<strong>Nome:</strong> $name<br> <strong>Email:</strong> $email<br> <strong>Telefone:</strong> $phone<br> <strong><br>Mensagem:</strong> $message";
	
	// chamada da classe		
	require_once('class.phpmailer.php');
	
	// instanciando a classe
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->IsHTML(true);
	$mailer->CharSet = 'utf-8';
	$mailer->SMTPDebug = 1;
	$mailer->Port = 587;
	$mailer->Host = 'plesk12l0025.hospedagemdesites.ws';
	$mailer->SMTPAuth = true;
	$mailer->SMTPSecure = 'tls'; // SSL REQUERIDO pelo PLESK 11.5 LINUX, PLESK 12.5 e cPanel é opcional
	
	// email do remetente
	$mailer->Username = 'web@medleader.com.br'; // seu email
	$mailer->Password = 'Web@1033';
	$mailer->From = 'web@medleader.com.br'; // seu email
	$mailer->Sender = 'web@medleader.com.br'; // seu email
	$mailer->FromName = $name; // Seu nome
	
	// email do destinatario
	$address = "web@medleader.com.br";
	$mailer->AddAddress($address, "Medleader");
	// assunto da mensagem
	$mailer->Subject = 'Solicitação de Orçamento';
	// corpo da mensagem
	$mailer->MsgHTML($corpoMSG);
	 
	if(!$mailer->Send()) {
		echo "Erro: " . $mailer->ErrorInfo;
	} else {
		
		// instanciando a classe
		$mailer2 = new PHPMailer();
		$mailer2->IsSMTP();
		$mailer2->IsHTML(true);
		$mailer2->CharSet = 'utf-8';
		$mailer2->SMTPDebug = 1;
		$mailer2->Port = 587;
		$mailer2->Host = 'plesk12l0025.hospedagemdesites.ws';
		$mailer2->SMTPAuth = true;
		$mailer2->SMTPSecure = 'tls'; // SSL REQUERIDO pelo PLESK 11.5 LINUX, PLESK 12.5 e cPanel é opcional
		
		// email do remetente
		$mailer2->Username = 'web@medleader.com.br'; // seu email
		$mailer2->Password = 'Web@1033';
		$mailer2->From = 'web@medleader.com.br'; 		// seu email
		$mailer2->Sender = 'web@medleader.com.br'; 		// seu email
		$mailer2->FromName = 'Residencial Medleader'; 	// Seu nome
		
		// email do destinatario
		$mailer2->AddAddress($email, "Resposta automática");
		// assunto da mensagem
		$mailer2->Subject = 'Confirmação de recebimento';
		// corpo da mensagem
		$corpoMSG2 = "Informamos que recebemos sua solitação de orçamento. Responderemos o quanto antes. <br><br> Caso queira entrar em contato conosco: (35) 98898-3527 / (35) 3012-2222 <br> Teremos o maior prazer em lhe atender!";
		$mailer2->MsgHTML($corpoMSG2);
		
		$mailer2->Send();
		
		echo "Orçamento enviado com sucesso! Em breve responderemos.";
	}
		
?>