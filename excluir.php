<?php
require __DIR__ . '/config.php';
if (!admin_ok()) { http_response_code(403); exit('Acesso restrito.'); }
if ($_SERVER['REQUEST_METHOD']!=='POST') { http_response_code(405); exit('Método não permitido.'); }
$f=basename((string)($_POST['f'] ?? ''));
$p=UPLOAD_DIR.'/'.$f;
if ($f && is_file($p)) unlink($p);
header('Location: admin.php'); exit;
