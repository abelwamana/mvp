<?php

require __DIR__ . '/vendor/autoload.php';

use MailchimpMarketing\ApiClient;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $mailchimp = new ApiClient();
    $mailchimp->setConfig([
        'apiKey' => 'APIkEY',
        'server' => 'us14' // Extraído do final da sua API Key
    ]);

    try {
        $response = $mailchimp->lists->addListMember('30419b1c82', [
            'email_address' => $email,
            'status' => 'subscribed',
        ]);

        echo 'Obrigado por se inscrever!';
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        if (strpos($error_message, 'Member Exists') !== false) {
            echo 'Seu email já está subscrito.';
        }
        elseif (strpos($error_message, 'Forgotten Email Not Subscribed') !== false) {
            echo 'A subscrição do seu email está barrada';

            
        } else {
            echo 'Erro: ' . $error_message;
        }
    }
} else {
    echo 'Método de requisição inválido.';
}
