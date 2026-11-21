<?php
// Defina ADMIN_PASSWORD como variável de ambiente no servidor antes de publicar.
$adminPassword = getenv('ADMIN_PASSWORD');
if ($adminPassword === false || $adminPassword === '') {
    throw new RuntimeException('Configure a variável de ambiente ADMIN_PASSWORD no servidor.');
}
define('ADMIN_PASSWORD', $adminPassword);
define('MAX_FILE_BYTES', 10 * 1024 * 1024);
define('MAX_FILES_PER_SEND', 20);
define('UPLOAD_DIR', __DIR__ . '/dados/fotos');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name('lf_album_session');
    session_set_cookie_params(['httponly'=>true, 'secure'=>!empty($_SERVER['HTTPS']), 'samesite'=>'Strict']);
    session_start();
}
function admin_ok(): bool { return !empty($_SESSION['lf_admin']); }
function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
