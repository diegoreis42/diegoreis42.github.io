<?php
	print("AKI");
	print($_POST["name"]);
	print($_POST['email']);
	print($_POST['phone']);
	print($_POST['message']);
	
	$messageBody = "";
	
	if($_POST['name']!='false'){
		$messageBody .= '<p>Visitor: ' . $_POST["name"] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['email']!='false'){
		$messageBody .= '<p>Email Address: ' . $_POST['email'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}else{
		$headers = '';
	}
	if($_POST['phone']!='false'){		
		$messageBody .= '<p>Phone Number: ' . $_POST['phone'] . '</p>' . "\n";
		$messageBody .= '<br>' . "\n";
	}
	if($_POST['message']!='false'){
		$messageBody .= '<p>Message: ' . $_POST['message'] . '</p>' . "\n";
	}
	
	require_once 'Mail.php';

	$to = 'desenvolvimento@medleader.com.br';
	$subject = 'Uma mensagem do seu visitante ' . $_POST["name"];
	$headers = array (
	'From' => 'From:' . $_POST["email"] . "\r\n" . 'Content-Type: text/plain; charset=UTF-8' . "\r\n",
	'To' => $to,
	'Subject' => $subject);
	
	/*
	$headers  = "MIME-Version: 1.1".$quebra;
	$headers .= "Content-type: text/plain; charset=iso-8859-1".$quebra;
	$headers .= "From: $email".$quebra; 								//E-mail do remetente
	$headers .= "Reply-To: $email".$quebra;
	$headers .= "Return-Path: desenvolvimento@medleader.com.br".$quebra;
	*/
	
	print($headers);
	print($to);
	print($subject);
	print($messageBody);
	
	mail($to, $subject, $messageBody, $headers, "-r".$to);
	
	try{
		if(PEAR::isError($mail)){
			echo $mail->getMessage();
		}
		else {
			echo 'Email enviado com sucesso.';
		}
		}
	catch(Exception $mail){
		echo $mail->getMessage() ."\n";
	}
?>