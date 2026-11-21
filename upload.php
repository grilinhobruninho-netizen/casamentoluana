<?php
require __DIR__ . '/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['fotos'])) { http_response_code(400); exit('Nenhuma foto recebida.'); }
if (!is_dir(UPLOAD_DIR) && !mkdir(UPLOAD_DIR, 0750, true)) { http_response_code(500); exit('Não foi possível preparar a pasta de fotos.'); }
$files = $_FILES['fotos'];
$count = count($files['name']);
if ($count > MAX_FILES_PER_SEND) { http_response_code(400); exit('Envie no máximo 20 fotos por vez.'); }
$finfo = new finfo(FILEINFO_MIME_TYPE);
$allowed = ['image/jpeg'=>'jpg', 'image/png'=>'png', 'image/webp'=>'webp', 'image/heic'=>'heic'];
$saved = 0; $errors = [];
for ($i=0; $i<$count; $i++) {
    if ($files['error'][$i] === UPLOAD_ERR_NO_FILE) continue;
    if ($files['error'][$i] !== UPLOAD_ERR_OK) { $errors[]='Uma das fotos não foi enviada corretamente.'; continue; }
    if ($files['size'][$i] > MAX_FILE_BYTES) { $errors[]='Uma foto ultrapassou 10 MB.'; continue; }
    $mime = $finfo->file($files['tmp_name'][$i]);
    if (!isset($allowed[$mime])) { $errors[]='Formato não permitido. Use JPG, PNG ou WEBP.'; continue; }
    $name = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
    if (move_uploaded_file($files['tmp_name'][$i], UPLOAD_DIR . '/' . $name)) $saved++;
}
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Envio concluído</title><body style="font-family:Arial;text-align:center;background:#fff5df;padding:40px">
<h1>❤️ Obrigado!</h1><p><?= $saved ?> foto(s) enviada(s) com sucesso.</p>
<?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?>
<p><a href="index.php">Enviar mais fotos</a></p></body></html>
