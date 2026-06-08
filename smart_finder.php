<?php
$baseDir = dirname(__FILE__);

// Possible paths to check
$paths = [
    'resources/views/daurulang.blade.php',
    'resources/views/beli.blade.php',
    'public/css/daurulang.css',
    'public/css/beli.css',
    '../resources/views/daurulang.blade.php',
    '../resources/views/beli.blade.php',
    './resources/views/daurulang.blade.php',
    './resources/views/beli.blade.php',
];

echo "<h2>Mencari file-file yang diminta:</h2>";

foreach ($paths as $path) {
    $fullPath = $baseDir . '\\' . $path;
    $cleanPath = str_replace('\\', '/', $path);
    
    if (file_exists($fullPath)) {
        echo "<h3>✓ FOUND: $cleanPath</h3>";
        echo "<pre style='background: #e8f5e9; border: 1px solid #4caf50; padding: 10px;'>";
        echo "Path: " . $fullPath . "\n\n";
        $content = file_get_contents($fullPath);
        // Limit to first 2000 chars untuk preview
        if (strlen($content) > 2000) {
            echo htmlspecialchars(substr($content, 0, 2000)) . "\n... (file terlalu panjang)\n";
        } else {
            echo htmlspecialchars($content);
        }
        echo "</pre>\n";
    }
}

// Also list actual files in key directories
echo "<h2>Listing direktori penting:</h2>";

$dirs = [
    'resources/views/',
    'public/css/',
];

foreach ($dirs as $dir) {
    $fullDir = $baseDir . '\\' . $dir;
    echo "<h3>Direktori: " . str_replace('\\', '/', $dir) . "</h3>";
    if (is_dir($fullDir)) {
        $files = scandir($fullDir);
        echo "<pre>";
        foreach ($files as $f) {
            if ($f !== '.' && $f !== '..') {
                echo $f . "\n";
            }
        }
        echo "</pre>";
    } else {
        echo "<p style='color: red;'>Direktori tidak ditemukan: $fullDir</p>";
    }
}
?>
