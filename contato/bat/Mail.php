<?php

	if (isset($_POST['email'])) {

		$receiver = 'contato@medleader.com.br';						//E-mail do destinatario
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$msg = $_POST['message'];		
		
		$subject = "Mensagem enviada atrav&eacute;s do site por $name";
		$break = "\r\n";
		
		$headers  = "MIME-Version: 1.1".$break;
		$headers .= "Content-type: text/plain; charset=iso-8859-1".$break;
		$headers .= "From: $email".$break; 									//E-mail do remetente
		$headers .= "Reply-To: $email".$break;
		$headers .= "Return-Path: $receiver".$break; 
		
		$message = "Visitante: $name".$break;		
		if($phone!='false'){
			$message .= "Telefone: $phone".$break;
		}
		$message .= $break;
		$message .= "$msg";
		
		if( mail($receiver, $subject, $message, $headers, "-r".$receiver) ) {
			echo 'mail sent';
		}
		else{			
			echo 'mail failed';
		}
	}
	
	else {
		header("Location: http://www.medleader.com/404");
	}
	
?>