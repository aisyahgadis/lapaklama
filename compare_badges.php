<?php
$baseDir = dirname(__FILE__);

function findFileByName($dir, $name) {
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        
        $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_file($fullPath) && $item === $name) {
            return $fullPath;
        } elseif (is_dir($fullPath)) {
            $result = findFileByName($fullPath, $name);
            if ($result) return $result;
        }
    }
    return null;
}

$beliPath = findFileByName($baseDir . '/resources/views', 'beli.blade.php');
$daurulangPath = findFileByName($baseDir . '/resources/views', 'daurulang.blade.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Comparison Badge Format</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f9f9f9; }
        .container { max-width: 1400px; margin: 0 auto; }
        h1 { color: #333; border-bottom: 3px solid #0b5f75; padding-bottom: 10px; }
        .section { background: white; padding: 20px; margin: 20px 0; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { color: #0b5f75; margin-top: 0; }
        pre { background: #f5f5f5; border-left: 4px solid #0b5f75; padding: 15px; overflow-x: auto; font-size: 12px; line-height: 1.5; }
        .found { color: #2ecc71; font-weight: bold; }
        .notfound { color: #e74c3c; font-weight: bold; }
        .comparison { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .file-path { color: #666; font-size: 0.9rem; margin: 10px 0; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>📋 Perbandingan Format Badge</h1>
    
    <div class="comparison">
        <!-- BELI FILE -->
        <div class="section">
            <h2>1️⃣ BELI BLADE FILE</h2>
            <?php if ($beliPath): ?>
                <p class="file-path"><span class="found">✓ FOUND</span>: <?php echo str_replace($baseDir, '', $beliPath); ?></p>
                <h3>Hero Badge Section:</h3>
                <?php
                    $content = file_get_contents($beliPath);
                    // Extract hero section
                    preg_match('/<header class="hero-search">.*?<\/header>/is', $content, $matches);
                    if ($matches) {
                        $heroSection = substr($matches[0], 0, 1000);
                        echo '<pre>' . htmlspecialchars($heroSection) . '...</pre>';
                    }
                ?>
            <?php else: ?>
                <p class="notfound">✗ FILE NOT FOUND</p>
            <?php endif; ?>
        </div>

        <!-- DAURULANG FILE -->
        <div class="section">
            <h2>2️⃣ DAURULANG BLADE FILE</h2>
            <?php if ($daurulangPath): ?>
                <p class="file-path"><span class="found">✓ FOUND</span>: <?php echo str_replace($baseDir, '', $daurulangPath); ?></p>
                <h3>Hero Badge Section:</h3>
                <?php
                    $content = file_get_contents($daurulangPath);
                    // Extract hero section
                    preg_match('/<div class="recycle-hero">.*?<\/div>/is', $content, $matches);
                    if (!$matches) {
                        preg_match('/<header.*?>.*?<\/header>/is', $content, $matches);
                    }
                    if ($matches) {
                        $heroSection = substr($matches[0], 0, 1000);
                        echo '<pre>' . htmlspecialchars($heroSection) . '...</pre>';
                    }
                ?>
            <?php else: ?>
                <p class="notfound">✗ FILE NOT FOUND</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- CSS STYLES -->
    <div class="section">
        <h2>3️⃣ CSS STYLING - .hero-badge</h2>
        <div class="comparison">
            <div>
                <h3>BELI.CSS</h3>
                <pre><?php 
                    $cssContent = file_get_contents($baseDir . '/public/css/beli.css');
                    preg_match('/\.hero-badge\s*\{[^}]+\}/is', $cssContent, $matches);
                    if ($matches) {
                        echo htmlspecialchars($matches[0]);
                    } else {
                        echo "tidak ditemukan";
                    }
                ?></pre>
            </div>
            <div>
                <h3>DAURULANG.CSS</h3>
                <pre><?php 
                    $cssContent = file_get_contents($baseDir . '/public/css/daurulang.css');
                    preg_match('/\.hero-badge\s*\{[^}]+\}/is', $cssContent, $matches);
                    if ($matches) {
                        echo htmlspecialchars($matches[0]);
                    } else {
                        echo "tidak ditemukan";
                    }
                ?></pre>
            </div>
        </div>
    </div>

    <!-- FULL FILE CONTENT BELI -->
    <div class="section">
        <h2>4️⃣ FULL beli.blade.php</h2>
        <?php if ($beliPath): ?>
            <pre><?php echo htmlspecialchars(file_get_contents($beliPath)); ?></pre>
        <?php endif; ?>
    </div>

    <!-- FULL FILE CONTENT DAURULANG -->
    <div class="section">
        <h2>5️⃣ FULL daurulang.blade.php</h2>
        <?php if ($daurulangPath): ?>
            <pre><?php echo htmlspecialchars(file_get_contents($daurulangPath)); ?></pre>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
