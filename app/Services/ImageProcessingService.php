<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageProcessingService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function imageToWebp(UploadedFile $file, string $path = 'uploads', string $disk = 'public')
    {
        // create image manager with desired driver
        $manager = new ImageManager(
            new Driver()
        );

        $image = $manager->read($file);

        $encoded = $image->toWebp();

        $newImageName = time() . '.webp';

        // Define a filename with a .webp extension
        $filename = $path . '/' . $newImageName;

        // Store the image in the public disk
        $res = Storage::disk('public')->put($filename, (string) $encoded);

        return [
            'success' => true,
            'imageName' => $newImageName,
            'imageUrl' => $filename
        ];
    }
}
