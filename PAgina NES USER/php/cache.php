<?php
/*
 * Archivo editado por Marcos
 * Última edición: 30/04/2025
 * Cambios: Implementación de las funciones para el manejo del formulario de denuncias
 * y validación de campos incluyendo provincia
 */

class CacheSystem {
    private $cacheFile;
    private $cache;
    private $cacheExpiry = 3600; // 1 hora en segundos

    public function __construct($cacheFile = 'chat_cache.json') {
        $this->cacheFile = dirname(__FILE__) . '/' . $cacheFile;
        $this->loadCache();
    }

    private function loadCache() {
        if (file_exists($this->cacheFile)) {
            $content = file_get_contents($this->cacheFile);
            $this->cache = json_decode($content, true) ?? [];
        } else {
            $this->cache = [];
        }
    }

    private function saveCache() {
        file_put_contents($this->cacheFile, json_encode($this->cache));
    }

    public function get($key) {
        if (!isset($this->cache[$key]) || 
            (time() - $this->cache[$key]['timestamp'] > $this->cacheExpiry)) {
            return null;
        }
        return $this->cache[$key]['response'];
    }

    public function set($key, $response) {
        $this->cache[$key] = [
            'response' => $response,
            'timestamp' => time(),
            'hits' => ($this->cache[$key]['hits'] ?? 0) + 1
        ];
        $this->saveCache();
    }

    public function getPopularQueries() {
        $popular = array_filter($this->cache, function($item) {
            return ($item['hits'] ?? 0) > 5; // Consultas hechas más de 5 veces
        });
        arsort($popular);
        return array_slice($popular, 0, 10); // Retorna las 10 más populares
    }
}
?>