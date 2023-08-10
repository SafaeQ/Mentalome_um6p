<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Data;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Data::truncate();

        $csvFile = fopen(__DIR__."/../../public/data/test_data.csv", "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Data::create([
                    "gene_ids" => $data['1'],
                    "value" => $data['2'],
                    "sra" => $data['3'],
                    "abbreviation" => $data['4'],
                    "experiment" => $data['5'],
                    "disease" => $data['6'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
