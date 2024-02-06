<?php

// URL da API
$url = "";

// Dados do cabeçalho (headers)
$headers = array(
    "Content-Type: application/json",
    "apikey: "
);

// Abra o arquivo CSV para leitura
$csvFile = fopen("numeros.csv", "r");

// Loop para ler cada linha do arquivo CSV
while (($data = fgetcsv($csvFile)) !== FALSE) {
    // O número de telefone está na primeira coluna do CSV
    $phoneNumber = $data[0];

    // Dados do corpo da requisição (body)
    $data = array(
        "number" => $phoneNumber,
        "textMessage" => array(
            "text" => "Isso é apenas um teste"
        )
    );

    // Converte os dados em JSON
    $data_json = json_encode($data);

    // Inicializa a sessão cURL
    $ch = curl_init($url);

    // Define as opções da requisição
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Executa a requisição e obtém a resposta
    $response = curl_exec($ch);

    var_dump($response);

    // Verifica por erros
    if (curl_errno($ch)) {
        echo 'Erro na requisição cURL: ' . curl_error($ch);
    }

    // Fecha a sessão cURL
    curl_close($ch);
    sleep(rand(5,10));

}

echo "Mensagens Enviadas com Sucesso!";

// Feche o arquivo CSV
fclose($csvFile);

/*
$subject = 'Forumlário de envio';


$fields = array('name' => 'Nome', 'surname' => 'Surname', 'phone' => 'Phone','message' => 'Mensagem');

$okMessage = 'Sua mensagem foi enviada com sucesso!';

$errorMessage = 'Ocorreu um erro ao enviar o formulário.';
{
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}
*/
