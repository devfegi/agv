<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->IsHTML(true);

//От кого письмо
$mail->setFrom('devfegi@gmail.com', 'Заявка');
//Кому отправить
$mail->addAddress('devfegi@gmail.com');
//Тема письма
$mail->Subject = 'Обсудим ваш проект';

//Тело письма
$body = "";

if (trim(!empty($_POST['name']))) {
	$body .= "Имя клиента: " . $_POST['name'] . '***';
}

if (trim(!empty($_POST['phone']))) {
	$body .= "Номер телефона: " . $_POST['phone'] . '***';
}

if (trim(!empty($_POST['email']))) {
	$body .= "Email: " . $_POST['email'] . '***';
}

if (trim(!empty($_POST['comments']))) {
	$body .= "Комментарии:" . $_POST['comments'];
}

$mail->Body = $body;

//Отправляем
if (!$mail->send()) {
	$message = 'Ошибка';
} else {
	$message = '<div class="popup-form__text"><h4>Спасибо! Ваша заявка принята.</h4> <p>В ближайшее время с Вами свяжется наш менеджер.</p></div><span class="popup-form__close"><span><img src="img/svg/close.svg" alt="icon" /></span></span><button type="submit" class="popup-form__accept btn"><span>OK</span></button>';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
