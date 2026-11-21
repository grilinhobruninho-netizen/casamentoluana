<?php
require __DIR__ . '/config.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Casamento da Luana e Fernando</title>
<style>
*{box-sizing:border-box}body{margin:0;font-family:Arial,sans-serif;color:#342719;background:linear-gradient(#d9efff,#fff5df);min-height:100vh}
main{max-width:680px;margin:28px auto;padding:18px}
.card{background:#fffdf8;border:1px solid #e8c878;border-radius:22px;padding:28px;box-shadow:0 12px 35px #79551b22;text-align:center}
h1{font-family:Georgia,serif;color:#9a6a09;font-size:clamp(30px,7vw,46px);margin:8px 0}
p{line-height:1.55}.heart{font-size:34px;color:#c28a12}
input[type=file]{display:block;width:100%;padding:14px;border:2px dashed #d9b45e;border-radius:12px;background:#fffaf0;margin:20px 0}
button{border:0;border-radius:30px;background:#b9820b;color:white;font-weight:bold;font-size:17px;padding:15px 28px;cursor:pointer}
button:disabled{opacity:.6}.hint{font-size:13px;color:#6d6254}.status{margin-top:18px;font-weight:bold}
</style>
</head>
<body><main><section class="card">
<div class="heart">♡</div>
<h1>Casamento da<br>Luana e Fernando</h1>
<p><strong>Seja bem-vindo(a)!</strong><br>Poste suas melhores fotos aqui e ajude a guardar as lembranças desse dia especial.</p>
<form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="fotos[]" accept="image/jpeg,image/png,image/webp,image/heic" multiple required>
<p class="hint">Você pode selecionar várias fotos. Limite de 10 MB por foto.</p>
<button id="sendBtn" type="submit">Enviar minhas fotos ❤️</button>
</form>
<div class="status" id="status"></div>
<p class="hint">Obrigado por fazer parte desse momento!</p>
</section></main>
<script>
document.getElementById('uploadForm').addEventListener('submit',function(){
 const b=document.getElementById('sendBtn');b.disabled=true;b.textContent='Enviando...';
});
</script></body></html>
