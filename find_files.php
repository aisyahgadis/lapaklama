<?php
$baseDir = __DIR__;

echo "<h1>Direktori Structure</h1>";
echo "<p>Base: " . $baseDir . "</p>";

// List all files and directories
echo "<h2>Files dalam direktori utama:</h2>";
$files = scandir($baseDir);
echo "<pre>";
foreach ($files as $f) {
    if ($f !== '.' && $f !== '..') {
        echo $f . "\n";
    }
}
echo "</pre>";

// Cari file .blade.php
echo "<h2>Searching untuk .blade.php files:</h2>";
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$bladeFiles = [];
foreach ($iterator as $file) {
    if (strpos($file->getPathname(), '.blade.php') !== false) {
        $bladeFiles[] = $file->getPathname();
    }
}

echo "<pre>";
foreach ($bladeFiles as $f) {
    echo $f . "\n";
}
echo "</pre>";

// Cari file CSS
echo "<h2>Searching untuk CSS files:</h2>";
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$cssFiles = [];
foreach ($iterator as $file) {
    if (strpos($file->getPathname(), '.css') !== false) {
        $cssFiles[] = $file->getPathname();
    }
}

echo "<pre>";
foreach ($cssFiles as $f) {
    echo $f . "\n";
}
echo "</pre>";
?>
