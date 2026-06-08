<?php
$baseDir = dirname(__FILE__);
$viewsDir = $baseDir . '/resources/views';

echo "<h1>Searching for relevant Blade files...</h1>";

// Recursive search for blade files
function findBladeFiles($dir) {
    $files = [];
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        
        $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_file($fullPath) && strpos($fullPath, '.blade.php') !== false) {
            $content = file_get_contents($fullPath);
            if (strpos($content, 'Kampanye') !== false || 
                strpos($content, 'Koleksi Fashion') !== false ||
                strpos($content, 'hero-badge') !== false) {
                $files[] = $fullPath;
            }
        } elseif (is_dir($fullPath)) {
            $files = array_merge($files, findBladeFiles($fullPath));
        }
    }
    return $files;
}

$relevantFiles = findBladeFiles($viewsDir);

if (empty($relevantFiles)) {
    echo "<p>Tidak ada blade file yang ditemukan dengan keyword tersebut.</p>";
    echo "<p>Mari kita lihat semua blade files:</p>";
    
    function findAllBladeFiles($dir) {
        $files = [];
        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            
            $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_file($fullPath) && strpos($fullPath, '.blade.php') !== false) {
                $files[] = $fullPath;
            } elseif (is_dir($fullPath)) {
                $files = array_merge($files, findAllBladeFiles($fullPath));
            }
        }
        return $files;
    }
    
    $allBladeFiles = findAllBladeFiles($viewsDir);
    echo "<h2>All Blade Files Found:</h2>";
    echo "<pre>";
    foreach ($allBladeFiles as $f) {
        echo str_replace($baseDir, '', $f) . "\n";
    }
    echo "</pre>";
} else {
    echo "<h2>Relevant files found:</h2>";
    foreach ($relevantFiles as $file) {
        echo "<h3>" . str_replace($baseDir, '', $file) . "</h3>";
        echo "<pre style='background: #f5f5f5; border: 1px solid #ddd; padding: 10px; max-height: 500px; overflow-y: auto;'>";
        echo htmlspecialchars(file_get_contents($file));
        echo "</pre><hr>";
    }
}
?>
