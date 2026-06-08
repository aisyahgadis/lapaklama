<?php
$baseDir = dirname(__FILE__);

// Try different possible locations
$possiblePaths = [
    'resources/views/penjual/daurulang.blade.php',
    'resources/views/daurulang.blade.php',
    'resources/views/admin/daurulang.blade.php',
    'resources/views/sesi/daurulang.blade.php',
];

$daurulangPath = null;
foreach ($possiblePaths as $path) {
    $fullPath = $baseDir . '/' . str_replace('/', '\\', $path);
    if (file_exists($fullPath)) {
        $daurulangPath = $fullPath;
        echo "Found at: $path\n\n";
        break;
    }
}

if (!$daurulangPath) {
    echo "Daurulang file not found at expected locations. Searching...\n\n";
    
    function searchFile($dir, $needle) {
        if (!is_dir($dir)) return null;
        $items = scandir($dir);
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;
            $fullPath = $dir . '\\' . $item;
            if (is_file($fullPath) && strpos($item, $needle) !== false && strpos($item, '.blade.php') !== false) {
                return $fullPath;
            } elseif (is_dir($fullPath)) {
                $found = searchFile($fullPath, $needle);
                if ($found) return $found;
            }
        }
        return null;
    }
    
    $daurulangPath = searchFile($baseDir . '/resources/views', 'daurulang');
}

if ($daurulangPath) {
    echo "=== DAURULANG.BLADE.PHP ===\n";
    echo file_get_contents($daurulangPath);
} else {
    echo "DAURULANG FILE NOT FOUND!\n";
}

echo "\n\n=== BELI.BLADE.PHP ===\n";
$beliPath = $baseDir . '/resources/views/penjual/beli.blade.php';
echo file_get_contents($beliPath);
?>
