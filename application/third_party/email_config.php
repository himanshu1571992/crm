<?php

$this->load->library('email');
		$this->email->initialize(array(		
		'protocol'  => 'smtp',
		'smtp_host' => 'smtp.sendgrid.net',
		'smtp_user' => 'apikey',
		'smtp_pass' => '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',
		'smtp_port' => 587,
		'mailtype'  => 'html', 
		'charset'   => 'iso-8859-1',
		'crlf' 		=> "\r\n",
		'newline'   => "\r\n"
		));
//$this->email->from('info@onlineexam.com', 'Online Exam');

?>