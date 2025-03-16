<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class ConvertNewImagesToWebP implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $manager;
    protected $disk = 'public'; // Storage disk

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function handle()
    {
        Log::info("🚀 Job started: Converting images to WebP");

        // Fetch all tables
        $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");

        foreach ($tables as $table) {
            $tableName = $table->name;
            Log::info("🔍 Checking table: $tableName");

            // Get columns for the table
            $columns = Schema::getColumnListing($tableName);

            foreach ($columns as $column) {
                if ($this->isImageColumn($column)) {
                    Log::info("✅ Found image column: $column in table: $tableName");
                    $this->convertImagesInTable($tableName, $column);
                }
            }
        }

        Log::info("✅ Image conversion job completed.");
    }

    private function convertImagesInTable($table, $column)
    {
        Log::info("📂 Checking images in table: $table, column: $column");

        // Fetch only necessary images
        $items = DB::table($table)
            ->whereRaw("$column LIKE '%.jpg' OR $column LIKE '%.jpeg' OR $column LIKE '%.png'")
            ->where($column, 'NOT LIKE', '%.webp')
            ->get();

        Log::info("🖼 Found " . count($items) . " images to convert in $table.$column");

        foreach ($items as $item) {
            $imagePath = $item->$column;
            Log::info("🔍 Processing image: $imagePath");

            if (!$imagePath || !Storage::disk($this->disk)->exists($imagePath)) {
                Log::error("❌ File not found: $imagePath");
                continue;
            }

            $imageFullPath = Storage::disk($this->disk)->path($imagePath);
            Log::info("📂 Image full path: $imageFullPath");

            try {
                // Convert to WebP
                $imageData = $this->manager->read($imageFullPath)->toWebp();
                $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $imagePath);

                // Store new WebP image
                Storage::disk($this->disk)->put($webpPath, (string) $imageData);
                
                // Delete old image
                Storage::disk($this->disk)->delete($imagePath);

                // Update database record
                DB::table($table)->where('id', $item->id)->update([$column => $webpPath]);

                Log::info("✅ Converted: $imagePath → $webpPath");
            } catch (\Exception $e) {
                Log::error("❌ Failed to convert: $imagePath - " . $e->getMessage());
            }
        }
    }

    private function isImageColumn($column)
    {
        return preg_match('/image|photo|avatar|picture|logo|banner/i', $column);
    }
}
