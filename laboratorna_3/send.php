<?php

use PHPMailer\PHPMailer\PHPMailer;


// Переменные
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
// Настройки
$mail = new PHPMailer\PHPMailer\PHPMailer();

// Настройки вашей почты
$mail->Host       = 'smtp.gmail.com'; // SMTP сервера GMAIL
$mail->Username   = 'av1536370'; // Логин на почте
$mail->Password   = '1t2i3g4e5r'; // Пароль на почте
$mail->SMTPSecure = 'ssl';
$mail->Port       = 465;
$mail->setFrom('av1536370@gmail.com', 'Name'); // Адрес самой почты и имя отправителя

// Получатель письма
$mail->addAddress('youremail@gmail.com');

// Письмо
$mail->isHTML(true);
$mail->Subject = "Outstanding users of an outstanding system"; // Заголовок письма
$mail->Body = "Имя $name . Телефон $number . Почта $email"; // Текст письма
// Результат
if(!$mail->send()) {
    echo 'Message could not be sent.';
 echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'ok';
}
?>