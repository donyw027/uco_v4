<?php
function config_item($key) {
    global $CFG;
    return $CFG[$key] ?? null;
}
function base_url($uri = '') {
    $base = rtrim(config_item('base_url') ?: guess_base_url(), '/').'/';
    return $base . ltrim($uri, '/');
}
function site_url($uri = '') {
    $index = trim((string)config_item('index_page'));
    $base = rtrim(config_item('base_url') ?: guess_base_url(), '/');
    if ($index !== '') $base .= '/' . trim($index, '/');
    return rtrim($base, '/') . ($uri !== '' ? '/' . ltrim($uri, '/') : '/');
}
function guess_base_url() {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
    return $scheme . '://' . $host . rtrim(str_replace('\\', '/', dirname($script)), '/') . '/';
}
function redirect($uri) {
    header('Location: ' . (preg_match('~^https?://~', $uri) ? $uri : site_url($uri)));
    exit;
}
function show_404() {
    http_response_code(404);
    echo '<h1>404 Not Found</h1>';
    exit;
}
function get_instance() {
    global $CI_INSTANCE;
    return $CI_INSTANCE;
}
