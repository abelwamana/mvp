<?php
require 'vendor/autoload.php'; // Certifique-se de que o autoload do Composer está sendo incluído

use MailchimpMarketing\ApiClient;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $mailchimp = new ApiClient();
    $mailchimp->setConfig([
        'apiKey' => '389803fdbe50ba05a915d464f0e310b2-us14',
        'server' => 'us14' // Extraído do final da sua API Key
    ]);

    try {
        $response = $mailchimp->lists->addListMember('YOUR_LIST_ID', [
            'email_address' => $email,
            'status' => 'subscribed',
        ]);

        echo 'Obrigado por se inscrever!';
    } catch (Exception $e) {
        echo 'Erro: ' . $e->getMessage();
    }
} else {
    echo 'Método de requisição inválido.';
}

