<?php
require __DIR__ . '/config.php';
if (isset($_GET['sair'])) { $_SESSION=[]; session_destroy(); header('Location: admin.php'); exit; }
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['senha'])) {
    if (hash_equals(ADMIN_PASSWORD, (string)$_POST['senha'])) { session_regenerate_id(true); $_SESSION['lf_admin']=true; header('Location: admin.php'); exit; }
    $error='Senha incorreta.';
}
if (!admin_ok()):
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Administração</title>
<body style="font-family:Arial;background:#f8f1e4;padding:30px"><main style="max-width:420px;margin:auto;background:white;padding:25px;border-radius:16px">
<h2>Painel — Luana e Fernando</h2><form method="post"><label>Senha de administrador</label><p><input type="password" name="senha" required style="width:100%;padding:12px"></p><button>Entrar</button></form><p style="color:#b00"><?= h($error) ?></p></main></body></html>
<?php exit; endif;
$items = is_dir(UPLOAD_DIR) ? array_values(array_filter(scandir(UPLOAD_DIR), fn($f)=>!in_array($f,['.','..']) && is_file(UPLOAD_DIR.'/'.$f))) : [];
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Painel de fotos</title><style>body{font-family:Arial;margin:24px;background:#faf6ee}img{width:100%;height:180px;object-fit:cover;border-radius:10px}.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px}.item{background:white;padding:10px;border-radius:12px}a,button{color:#8a5b00}</style>
<h1>Fotos recebidas (<?= count($items) ?>)</h1><p><a href="admin.php?sair=1">Sair do painel</a></p>
<div class="grid"><?php foreach($items as $f): ?><div class="item"><a href="foto.php?f=<?= rawurlencode($f) ?>" target="_blank"><img src="foto.php?f=<?= rawurlencode($f) ?>" alt="Foto enviada"></a><p><a download href="foto.php?f=<?= rawurlencode($f) ?>&baixar=1">Baixar foto</a></p>
<form method="post" action="excluir.php" onsubmit="return confirm('Excluir esta foto?')"><input type="hidden" name="f" value="<?= h($f) ?>"><button>Excluir</button></form></div><?php endforeach; ?></div></html>
