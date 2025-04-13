<?php
// Crea un endpoint PHP que reciba un mensaje y devuelva un JSON de ChatGPT.

// Asegúrate de que tu API Key esté en el entorno o en el código.
$apiKey = 'TU_API_KEY_DE_OPENAI'; // PON TU API KEY AQUÍ

// Verifica que haya un mensaje en la solicitud
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];

    // Inicializa la solicitud a la API de OpenAI
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);

    // Prepara los datos en formato JSON para enviar a OpenAI
    $data = array(
        "model" => "gpt-3.5-turbo",
        "messages" => array(
            array("role" => "user", "content" => $mensaje)
        )
    );

    // Convierte a JSON
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Establece los headers (como la API Key)
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ));

    // Ejecuta la solicitud y cierra la conexión
    $result = curl_exec($ch);
    curl_close($ch);

    // Decodifica la respuesta y devuélvela como JSON
    $response = json_decode($result, true);
    echo json_encode($response); // Aquí está tu JSON
} else {
    echo json_encode(array("error" => "Mensaje no recibido"));
}
?>
