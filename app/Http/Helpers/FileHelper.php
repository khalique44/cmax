<?php

namespace App\Http\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class FileHelper
{
    /**
     * Handle file upload with optional WebP conversion.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folderName
     * @return string Relative URL to save in DB
     */
    public static function uploadImage($file, $folderName = 'uploads')
    {
        $fileName   = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName   = str_replace(" ", "_", $fileName);
        $timestamp  = time();
        $extension  = $file->getClientOriginalExtension();
        $fullName   = "{$fileName}-{$timestamp}.{$extension}";

        $destinationPath = public_path("uploads/{$folderName}");
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Save original
        $file->move($destinationPath, $fullName);
        $filePath = "{$destinationPath}/{$fullName}";

        // Optimize original
        $optimizer = OptimizerChainFactory::create();
        $optimizer->optimize($filePath);

        // Check size
        $fileSizeKB = filesize($filePath) / 1024;

        if ($fileSizeKB > 500) {
            // Convert to WebP
            $manager = new ImageManager(new Driver());
            $image = $manager->read($filePath);

            $webpFileName = "{$fileName}-{$timestamp}.webp";
            $webpPath = "{$destinationPath}/{$webpFileName}";

            $image->toWebp(85)->save($webpPath);

            return "uploads/{$folderName}/{$webpFileName}";
        }

        // Otherwise return original
        return "uploads/{$folderName}/{$fullName}";
    }

    /**
     * Retrieve image URL, prefers WebP if available.
     *
     * @param string $path
     * @return string
     */
    public static function getImageUrl($path)
    {
        $absolutePath = public_path($path);

        // Check if original exists
        if (!file_exists($absolutePath)) {
            return asset('images/no-image.png'); // fallback
        }

        // Try WebP alternative
        $webpPath = preg_replace('/\.[^.]+$/', '.webp', $absolutePath);
        if (file_exists($webpPath)) {
            return asset(str_replace(public_path(), '', $webpPath));
        }

        return asset($path);
    }
}
