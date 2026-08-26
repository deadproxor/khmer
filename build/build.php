<?php
// Запустить в браузере: http://localhost/khmer/build/build.php
// Обновляет версию кэша в sw.js на основе md5 от index.html

$root    = dirname(__DIR__);
$index   = $root . '/index.html';
$sw      = $root . '/sw.js';

if (!file_exists($index)) {
    die('❌ index.html не найден: ' . $index);
}
if (!file_exists($sw)) {
    die('❌ sw.js не найден: ' . $sw);
}

$hash    = substr(md5_file($index), 0, 8);
$version = 'khmer-' . $hash;

$sw_content = file_get_contents($sw);
$sw_new     = preg_replace("/const CACHE = 'khmer-[^']*'/", "const CACHE = '$version'", $sw_content);

if ($sw_content === $sw_new) {
    echo "✅ Версия не изменилась: <strong>$version</strong> — sw.js не тронут.";
} else {
    file_put_contents($sw, $sw_new);
    echo "✅ sw.js обновлён: <strong>$version</strong>";
}
?>
