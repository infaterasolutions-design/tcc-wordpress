<?php
$dir = __DIR__;
$files = glob($dir . '/*.{jpg,jpeg,png}', GLOB_BRACE);

foreach ($files as $file) {
    $info = pathinfo($file);
    $output = $dir . '/' . $info['filename'] . '.webp';
    
    if (file_exists($output)) {
        echo "Skipping (already exists): " . basename($output) . "\n";
        continue;
    }
    
    echo "Processing: " . basename($file) . "\n";
    
    $image = null;
    if (strtolower($info['extension']) === 'png') {
        $image = imagecreatefrompng($file);
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
    } else {
        $image = imagecreatefromjpeg($file);
    }
    
    if ($image) {
        // Get original dimensions
        $width = imagesx($image);
        $height = imagesy($image);
        
        // Resize if width is greater than 800px (since these are for a grid)
        $new_width = $width;
        $new_height = $height;
        if ($width > 800) {
            $new_width = 800;
            $new_height = floor($height * (800 / $width));
            $resized = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            $image = $resized;
        }
        
        // Save as WebP with 80% quality
        imagewebp($image, $output, 80);
        imagedestroy($image);
        
        echo "Created: " . basename($output) . "\n";
    }
}
echo "Done!\n";
