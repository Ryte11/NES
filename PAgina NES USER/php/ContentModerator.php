<?php
/*
 * Archivo editado por Marcos
 * Última edición: 30/04/2025
 * Cambios: Implementación de las funciones para el manejo del formulario de denuncias
 * y validación de campos incluyendo provincia
 */

class ContentModerator {
    private $blockedWords;
    private $spamPatterns;

    public function __construct() {
        $this->blockedWords = [
            'spam', 'scam', 'hack', 'crack', 'pirate',
            // Palabras ofensivas en español
            'idiota', 'estupido', 'imbecil', 'maldito',
            // Añade más palabras según sea necesario
        ];

        $this->spamPatterns = [
            '/\b(?:https?:\/\/)?(?:www\.)?[a-z0-9-]+(?:\.[a-z]{2,})+(?:\/[^\s]*)?/i', // URLs
            '/([A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,})/', // Emails
            '/\b\d{10,}\b/', // Números largos (teléfonos, etc)
            '/(.)\1{4,}/' // Caracteres repetidos (ejemplo: "holaaaaaaa")
        ];
    }

    public function moderateContent($text) {
        $result = [
            'isClean' => true,
            'moderatedText' => $text,
            'flags' => []
        ];

        // Verificar palabras bloqueadas
        foreach ($this->blockedWords as $word) {
            if (stripos($text, $word) !== false) {
                $result['isClean'] = false;
                $result['flags'][] = "Contenido inapropiado detectado";
                $result['moderatedText'] = str_ireplace($word, '[***]', $result['moderatedText']);
            }
        }

        // Verificar patrones de spam
        foreach ($this->spamPatterns as $pattern) {
            if (preg_match($pattern, $text)) {
                $result['flags'][] = "Posible spam detectado";
                // Solo marcamos spam pero no bloqueamos completamente
                if (count($result['flags']) > 2) {
                    $result['isClean'] = false;
                }
            }
        }

        // Verificar longitud excesiva
        if (strlen($text) > 1000) {
            $result['flags'][] = "Mensaje demasiado largo";
            $result['moderatedText'] = substr($text, 0, 1000) . '...';
        }

        return $result;
    }

    public function shouldBlock($flags) {
        // Bloquear si hay demasiadas flags o contenido inapropiado
        return count($flags) > 3 || in_array("Contenido inapropiado detectado", $flags);
    }
}
?>