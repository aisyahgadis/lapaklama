<?php
$baseDir = __DIR__;

// Function to read and highlight file
function displayFile($path, $title) {
    if (file_exists($path)) {
        echo "<h2>$title</h2>";
        echo "<pre style='background: #f4f4f4; padding: 15px; border: 1px solid #ddd; overflow-x: auto;'>";
        echo htmlspecialchars(file_get_contents($path));
        echo "</pre><hr>";
    } else {
        echo "<h2>$title - FILE NOT FOUND</h2>";
        echo "Path: $path<hr>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>File Viewer</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        h2 { color: #333; border-bottom: 2px solid #007bff; padding-bottom: 10px; }
        pre { background: #f8f9fa; padding: 15px; border-left: 3px solid #007bff; overflow-x: auto; }
        hr { margin: 30px 0; border: none; border-top: 2px solid #eee; }
    </style>
</head>
<body>

<?php
displayFile($baseDir . '\resources\views\daurulang.blade.php', '1. daurulang.blade.php (Badge Section)');
displayFile($baseDir . '\public\css\daurulang.css', '2. daurulang.css (.hero-badge styling)');
displayFile($baseDir . '\resources\views\beli.blade.php', '3. beli.blade.php (Complete File)');
displayFile($baseDir . '\public\css\beli.css', '4. beli.css (Current File)');
?>

</body>
</html>
