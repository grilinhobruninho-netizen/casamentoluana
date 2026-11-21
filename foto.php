<?php
require __DIR__ . '/config.php';
if (!admin_ok()) { http_response_code(403); exit('Acesso restrito.'); }
$f = basename((string)($_GET['f'] ?? ''));
$path = UPLOAD_DIR . '/' . $f;
if (!$f || !is_file($path)) { http_response_code(404); exit('Foto não encontrada.'); }
$mime=(new finfo(FILEINFO_MIME_TYPE))->file($path);
header('Content-Type: '.$mime);
header('X-Content-Type-Options: nosniff');
if (isset($_GET['baixar'])) header('Content-Disposition: attachment; filename="foto-'.$f.'"');
readfile($path);
