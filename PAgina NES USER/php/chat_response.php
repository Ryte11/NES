<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Configuración de logs
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');
error_reporting(E_ALL);

error_log("Nueva petición recibida");

// Cargar variables de entorno desde .env
require_once __DIR__ . '/vendor/autoload.php';
if (class_exists('Dotenv\\Dotenv')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

$input = json_decode(file_get_contents('php://input'), true);
error_log("Input recibido: " . print_r($input, true));

if (!isset($input['message'])) {
    echo json_encode(['error' => 'No se proporcionó ningún mensaje']);
    error_log("Error: No se proporcionó mensaje");
    exit;
}

$message = $input['message'];
$apiKey = getenv('OPENAI_API_KEY');

$system_prompt = "Eres NESBot, el asistente virtual de NES (Noise Environment System). NES es un sistema dedicado a monitorear, controlar y reducir la contaminación sonora en comunidades de República Dominicana. Tu misión es ayudar a los usuarios a entender cómo funciona NES, cómo registrar denuncias por ruido, cómo consultar el mapa de zonas ruidosas, y cómo solicitar dispositivos sensoriales auditivos. También puedes explicar la misión, visión y valores de NES, y dar consejos sobre convivencia y reducción de ruido. Responde siempre de forma clara, empática y profesional, orientando al usuario a mejorar su calidad de vida y la de su comunidad. Si la pregunta no está relacionada con NES, responde de manera general, amigable y profesional.";

if (!preg_match('/^AIza[0-9A-Za-z-_]{35}$/', $apiKey)) {
    error_log("Error: Invalid API key format");
    echo json_encode([
        'error' => 'Configuration Error',
        'response' => 'Lo siento, hay un problema con la configuración del servidor.'
    ]);
    exit;
}

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $apiKey;

$data = [
    'contents' => [
        [
            'parts' => [
                [ 'text' => $system_prompt ],
                [ 'text' => $message ]
            ]
        ]
    ]
];

error_log("Datos a enviar: " . json_encode($data));

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json'
    ],
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_TIMEOUT => 30
]);

$response = curl_exec($ch);
error_log("Respuesta cruda de la API: " . $response);

if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    error_log("cURL error: $error_msg");
    echo json_encode([
        'error' => 'cURL Error',
        'response' => 'Lo siento, ocurrió un error de red.'
    ]);
    curl_close($ch);
    exit;
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    $result = json_decode($response, true);
    if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
        echo json_encode([
            'response' => $result['candidates'][0]['content']['parts'][0]['text']
        ]);
    } else {
        error_log("Respuesta inesperada: " . $response);
        echo json_encode([
            'error' => 'Respuesta inesperada',
            'response' => 'Lo siento, recibí una respuesta inesperada del servidor.'
        ]);
    }
} else {
    error_log("Error HTTP: $httpCode - Respuesta: $response");
    echo json_encode([
        'error' => 'Error en la API',
        'response' => 'Lo siento, el servidor respondió con un error. Código: ' . $httpCode
    ]);
}
?>
