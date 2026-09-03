Add-Type -AssemblyName System.Drawing

$dir = "C:\Users\sande\Local Sites\tcc\app\public\wp-content\themes\tcc-theme\assets\images"
$files = @("Tcc.jpeg", "tcc-cloths.jpeg", "outfit-tcc.jpeg", "tcc-outfit.jpeg", "tcc-fashionable.jpeg", "tcc-winter.jpeg", "tcc-spring.jpeg")

foreach ($filename in $files) {
    $file = Join-Path $dir $filename
    if (Test-Path $file) {
        Write-Host "Processing $filename"
        $img = [System.Drawing.Image]::FromFile($file)
        
        $ratio = 600 / $img.Width
        if ($ratio -gt 1) { $ratio = 1 } # Don't upscale
        
        $newWidth = [math]::Round($img.Width * $ratio)
        $newHeight = [math]::Round($img.Height * $ratio)
        
        $bmp = New-Object System.Drawing.Bitmap($newWidth, $newHeight)
        $graph = [System.Drawing.Graphics]::FromImage($bmp)
        $graph.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
        $graph.DrawImage($img, 0, 0, $newWidth, $newHeight)
        
        $img.Dispose()
        
        # Save over original
        $bmp.Save($file, [System.Drawing.Imaging.ImageFormat]::Jpeg)
        $bmp.Dispose()
        $graph.Dispose()
        Write-Host "Saved $filename"
    }
}
