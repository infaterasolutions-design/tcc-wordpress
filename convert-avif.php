<?php
// convert-avif.php
// Allow running via CLI OR via browser with a secret key
if (php_sapi_name() !== 'cli' && (!isset($_GET['run_avif']) || $_GET['run_avif'] !== 'yes')) {
    die('Unauthorized. Add ?run_avif=yes to the URL to run via browser.');
}

$uploads_dir = dirname(dirname(__DIR__)) . '/uploads';
$years = ['2025', '2026'];

$has_imagick = class_exists('Imagick');
$has_gd = function_exists('imagecreatefromjpeg') && function_exists('imageavif');

if (!$has_imagick && !$has_gd) {
    die("Neither Imagick nor GD (with AVIF support) is installed\n");
}

$count = 0;
$force = isset($_GET['force']) && $_GET['force'] === 'yes';

foreach ($years as $year) {
    $dir = $uploads_dir . '/' . $year;
    if (!is_dir($dir)) continue;

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $path = $file->getPathname();
                $avif_path = preg_replace('/\.(jpg|jpeg|png|webp)$/i', '.avif', $path);
                
                if (!file_exists($avif_path) || $force) {
                    try {
                        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                        
                        echo "Converting: $path\n";
                        
                        if ($force && file_exists($avif_path)) {
                            @unlink($avif_path);
                        }
                        
                        $quality = ($ext === 'png') ? 100 : 90;
                        
                        if ($has_imagick) {
                            $image = new Imagick($path);
                            $image->setImageFormat('avif');
                            if ($ext === 'png') {
                                $image->setOption('heic:lossless', 'true');
                            }
                            $image->setImageCompressionQuality($quality);
                            $image->writeImage($avif_path);
                            $image->clear();
                            $image->destroy();
                        } else if ($has_gd) {
                            if ($ext === 'jpg' || $ext === 'jpeg') {
                                $image = @imagecreatefromjpeg($path);
                            } else if ($ext === 'png') {
                                $image = @imagecreatefrompng($path);
                            } else if ($ext === 'webp') {
                                $image = @imagecreatefromwebp($path);
                            }
                            if ($image !== false) {
                                imageavif($image, $avif_path, $quality);
                                imagedestroy($image);
                            }
                        }
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
