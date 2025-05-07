<?php
// Este archivo es para probar la API de Gemini directamente

// Función para registro de errores
function logError($message)
{
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message\n";
    echo $logMessage;
}

// Configuración de la API de Gemini
$apiKey = 'AIzaSyCb3iURuulygRq3aa9yzECBqofNg1HfxpM'; // Tu API key de Gemini

// Mensaje de prueba
$message = "¿Qué es NES?";

// Contexto del sistema NES
$system_prompt = "Eres NESBot, el asistente virtual de NES (Noise Environment System).";

// URL de la API
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $apiKey;

// Datos para la solicitud
$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => $system_prompt],
                ['text' => $message]
            ]
        ]
    ],
    'generationConfig' => [
        'temperature' => 0.7,
        'topK' => 40,
        'topP' => 0.95,
        'maxOutputTokens' => 1024,
    ]
];

echo "<pre>";
echo "Enviando solicitud a Gemini API...\n";
echo "URL: " . $url . "\n";
echo "Datos: " . json_encode($data, JSON_PRETTY_PRINT) . "\n\n";

// Configurar cURL
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_VERBOSE => true
]);

// Capturar detalles de cURL para depuración
$curlVerboseLog = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $curlVerboseLog);

// Ejecutar la solicitud
$response = curl_exec($ch);

// Verificar errores
if (curl_errno($ch)) {
    rewind($curlVerboseLog);
    $verboseLog = stream_get_contents($curlVerboseLog);

    echo "ERROR DE CURL: " . curl_error($ch) . "\n";
    echo "DETALLES DE CURL: \n" . $verboseLog . "\n";
} else {
    // Obtener código de respuesta HTTP
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    echo "Código de respuesta HTTP: " . $httpCode . "\n\n";

    if ($httpCode === 200) {
        echo "RESPUESTA EXITOSA:\n";
        $result = json_decode($response, true);

        if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
            $aiResponse = $result['candidates'][0]['content']['parts'][0]['text'];
            echo "RESPUESTA DE LA IA:\n" . $aiResponse . "\n";
        } else {
            echo "FORMATO DE RESPUESTA INESPERADO:\n";
            echo json_encode($result, JSON_PRETTY_PRINT) . "\n";
        }
    } else {
        echo "ERROR EN LA RESPUESTA:\n";
        echo $response . "\n";
    }

    // Mostrar detalles de la solicitud
    rewind($curlVerboseLog);
    $verboseLog = stream_get_contents($curlVerboseLog);
    echo "\nDETALLES DE CURL: \n" . $verboseLog . "\n";
}

curl_close($ch);
fclose($curlVerboseLog);
echo "</pre>";