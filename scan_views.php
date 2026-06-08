<?php
$baseDir = dirname(__FILE__);
$viewsDir = $baseDir . '/resources/views';

// Scan all subdirectories
function scanDirectory($dir, $level = 0) {
    $indent = str_repeat("  ", $level);
    $files = [];
    
    if (!is_dir($dir)) {
        return "Direktori tidak ditemukan: $dir";
    }
    
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        
        $fullPath = $dir . '\\' . $item;
        if (is_file($fullPath)) {
            $files[] = $indent . "FILE: " . $item;
        } elseif (is_dir($fullPath)) {
            $files[] = $indent . "DIR: " . $item . "/";
            $files = array_merge($files, explode("\n", scanDirectory($fullPath, $level + 1)));
        }
    }
    
    return implode("\n", $files);
}

echo "<h2>Complete Directory Structure</h2>";
echo "<pre>";
echo scanDirectory($viewsDir);
echo "</pre>";
?>
