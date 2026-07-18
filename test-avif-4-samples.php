<?php
require_once dirname(__DIR__, 3) . '/wp-load.php';

$uploads_dir = wp_get_upload_dir()['basedir'];

$samples = [
    '/2026/04/image-195-820x1024.jpeg', // Featured/Standard
    '/2026/04/image-47-768x960.jpeg',   // Portrait
    '/2026/04/image-109-150x150.jpeg',  // Thumbnail
    '/2026/04/THECOMBOCLOSET.COM-5.png' // PNG Graphic
];

$has_imagick = class_exists('Imagick');
$has_gd = function_exists('imageavif');

echo "<pre>";
echo "Testing AVIF conversion on 4 samples...\n\n";

foreach ($samples as $relative_path) {
    $path = $uploads_dir . $relative_path;
    if (!file_exists($path)) {
        echo "Source file missing: $path\n";
        continue;
    }
    
    $avif_path = preg_replace('/\.(jpg|jpeg|png)$/i', '.avif', $path);
    
    // Delete existing AVIF if it exists
    if (file_exists($avif_path)) {
        unlink($avif_path);
        echo "Deleted old low-quality AVIF: $avif_path\n";
    }
    
    // Convert
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $quality = ($ext === 'png') ? 100 : 90;
    
    echo "Converting $relative_path at quality $quality...\n";
    
    $success = false;
    
    if ($has_imagick) {
        try {
            $image = new Imagick($path);
            $image->setImageFormat('avif');
            $image->setImageCompressionQuality($quality);
            $image->writeImage($avif_path);
            $image->clear();
            $image->destroy();
            $success = true;
        } catch (Exception $e) {
            echo "Imagick error: " . $e->getMessage() . "\n";
        }
    }
    
    if (!$success && $has_gd) {
        if (in_array($ext, ['jpg', 'jpeg'])) {
            $image = @imagecreatefromjpeg($path);
        } elseif ($ext === 'png') {
            $image = @imagecreatefrompng($path);
        }
        
        if (isset($image) && $image !== false) {
            if (imageavif($image, $avif_path, $quality)) {
                $success = true;
            }
            imagedestroy($image);
        }
    }
    
    if ($success) {
        echo "SUCCESS: Saved AVIF to $avif_path\n";
    } else {
        echo "FAILED to convert $relative_path\n";
    }
    echo "--------------------------\n";
}

echo "Done!</pre>";
