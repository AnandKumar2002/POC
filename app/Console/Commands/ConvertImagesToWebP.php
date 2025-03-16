<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ConvertImagesToWebP extends Command
{
    protected $signature = 'app:convert-images-to-webp {table} {column} {disk=public}';
    protected $description = 'Convert images to WebP, update database paths, and delete original images';

    protected ImageManager $manager;

    public function __construct()
    {
        parent::__construct();
        $this->manager = new ImageManager(new Driver());
    }

    public function handle()
    {
        $table = $this->argument('table');
        $column = $this->argument('column');
        $disk = $this->argument('disk');

        if (!$this->validateTableAndColumn($table, $column)) {
            return;
        }

        $items = DB::table($table)->where($column, 'NOT LIKE', '%.webp')->get();
        foreach ($items as $item) {
            $this->processImage($item, $table, $column, $disk);
        }

        $this->info("🎉 Image conversion and database update completed!");
    }

    private function validateTableAndColumn($table, $column): bool
    {
        if (!Schema::hasTable($table)) {
            $this->error("❌ Table '$table' does not exist.");
            return false;
        }
        if (!Schema::hasColumn($table, $column)) {
            $this->error("❌ Column '$column' does not exist in table '$table'.");
            return false;
        }
        return true;
    }

    private function processImage($item, $table, $column, $disk)
    {
        $imagePath = $item->$column;

        // Ensure correct storage disk
        if (!Storage::disk($disk)->exists($imagePath)) {
            $this->warn("⚠ File not found: $imagePath");
            return;
        }

        $imageExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        if (!in_array($imageExtension, ['jpg', 'jpeg', 'png'])) {
            $this->warn("⚠ Skipping non-image file: $imagePath");
            return;
        }

        $this->info("🖼 Processing: $imagePath...");

        try {
            $imageData = $this->manager->read(Storage::disk($disk)->path($imagePath))->toWebp();
            $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $imagePath);

            Storage::disk($disk)->put($webpPath, (string) $imageData);
            Storage::disk($disk)->delete($imagePath);

            DB::table($table)->where('id', $item->id)->update([$column => $webpPath]);

            $this->info("✅ Converted & Updated in DB: $imagePath → $webpPath");
        } catch (\Exception $e) {
            $this->error("❌ Failed to convert: $imagePath - Error: " . $e->getMessage());
        }
    }
}