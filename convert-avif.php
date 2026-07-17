<?php
// convert-avif.php
if (php_sapi_name() !== 'cli') {
    die('CLI only');
}

$uploads_dir = __DIR__ . '/wp-content/uploads';
$years = ['2025', '2026'];

if (!class_exists('Imagick')) {
    die("Imagick not installed\n");
}

$count = 0;
foreach ($years as $year) {
    $dir = $uploads_dir . '/' . $year;
    if (!is_dir($dir)) continue;

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $path = $file->getPathname();
                $avif_path = preg_replace('/\.[a-zA-Z0-9]+$/', '.avif', $path);
                if (!file_exists($avif_path)) {
                    try {
                        echo "Converting: $path\n";
                        $image = new Imagick($path);
                        $image->setImageFormat('avif');
                        $image->setImageCompressionQuality(80);
                        $image->writeImage($avif_path);
                        $image->clear();
                        $image->destroy();
                        $count++;
                    } catch (Exception $e) {
                        echo "Failed: $path - " . $e->getMessage() . "\n";
                    }
                }
            }
        }
    }
}

echo "Converted $count images to AVIF.\n";
