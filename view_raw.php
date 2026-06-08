<?php
header('Content-Type: text/plain; charset=utf-8');

$baseDir = dirname(__FILE__);
$beliPath = $baseDir . '/resources/views/penjual/beli.blade.php';
$daurulangPath = $baseDir . '/resources/views/penjual/daurulang.blade.php';

echo "==============================================================\n";
echo "1. DAURULANG.BLADE.PHP - Hero Section\n";
echo "==============================================================\n";
$content = file_get_contents($daurulangPath);
preg_match('/<div class="recycle-hero">(.*?)<\/div>/is', $content, $matches);
if ($matches) {
    echo substr($matches[0], 0, 1500);
    echo "\n...truncated\n";
} else {
    echo "Hero section not found\n";
}

echo "\n\n";
echo "==============================================================\n";
echo "2. BELI.BLADE.PHP - Hero Section\n";
echo "==============================================================\n";
$content = file_get_contents($beliPath);
preg_match('/<header class="hero-search">(.*?)<\/header>/is', $content, $matches);
if ($matches) {
    echo substr($matches[0], 0, 1500);
    echo "\n...truncated\n";
} else {
    echo "Hero section not found\n";
}

echo "\n\n";
echo "==============================================================\n";
echo "3. DAURULANG.CSS - .hero-badge styling\n";
echo "==============================================================\n";
$cssContent = file_get_contents($baseDir . '/public/css/daurulang.css');
preg_match('/\.hero-badge\s*\{[^}]+\}/is', $cssContent, $matches);
if ($matches) {
    echo $matches[0];
} else {
    echo "Not found\n";
}

echo "\n\n";
echo "==============================================================\n";
echo "4. BELI.CSS - .hero-badge styling\n";
echo "==============================================================\n";
$cssContent = file_get_contents($baseDir . '/public/css/beli.css');
preg_match('/\.hero-badge\s*\{[^}]+\}/is', $cssContent, $matches);
if ($matches) {
    echo $matches[0];
} else {
    echo "Not found\n";
}

echo "\n\n";
echo "==============================================================\n";
echo "5. COMPLETE DAURULANG.BLADE.PHP\n";
echo "==============================================================\n";
echo file_get_contents($daurulangPath);

echo "\n\n";
echo "==============================================================\n";
echo "6. COMPLETE BELI.BLADE.PHP\n";
echo "==============================================================\n";
echo file_get_contents($beliPath);
?>
