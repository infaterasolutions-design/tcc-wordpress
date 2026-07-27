<?php
\ = dirname(__DIR__) . '/uploads/test-samples';
\ = class_exists('Imagick');
\ = function_exists('imagecreatefromjpeg') && function_exists('imageavif');

\ = glob(\ . '/*.{jpg,jpeg,png}', GLOB_BRACE);
foreach (\ as \) {
    \ = preg_replace('/\.(jpg|jpeg|png)$/i', '.avif', \);
    echo "Converting: \\n";
    \ = strtolower(pathinfo(\, PATHINFO_EXTENSION));
    \ = (\ === 'png') ? 100 : 90;
    
    if (\) {
        \ = new Imagick(\);
        \->setImageFormat('avif');
        \->setImageCompressionQuality(\);
        \->writeImage(\);
        \->clear();
        \->destroy();
    } elseif (\) {
        if (strpos(\, '.jpg') !== false || strpos(\, '.jpeg') !== false) {
            \ = @imagecreatefromjpeg(\);
        } elseif (strpos(\, '.png') !== false) {
            \ = @imagecreatefrompng(\);
        }
        if (isset(\) && \ !== false) {
            imageavif(\, \, \);
            imagedestroy(\);
        }
    }
}
