<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ImportCsvData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-csv-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from a CSV file using League CSV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = '1000017947.csv';

        if (Storage::disk('public')->exists($filename)) {
            $this->info("File found in public storage. Reading...");

            $localFilePath = storage_path('app/public/' . $filename);
            // $records = iterator_to_array($csv->getRecords(), false);
            // array_shift($records);
            // foreach ($records as $index => $record) {
            //     dd($record);
            // }

            try {
                $csv = Reader::createFromPath($localFilePath, 'r');
                $csv->setDelimiter("\t"); 
                $csv->setHeaderOffset(0);
                $records = $csv->getRecords();
                // $records = iterator_to_array($csv->getRecords());
                // array_shift($records);
                foreach ($records as $index => $record) {
                    dd($record);
                }

                $this->info("CSV file import complete.");
            } catch (\Exception $e) {
                $this->error("Error reading CSV file: " . $e->getMessage());
            }
        } else {
            $this->error("File not found in public storage.");
        }
    }
}
