<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // open the csv file for reading
        $file = fopen(storage_path('app/drivers.csv'), 'r');

        // read the first row of the csv file
        $headers = fgetcsv($file);

        // loop through the rest of the csv file
        while ($row = fgetcsv($file)) {
            // combine the headers and the row into an associative array
            $data = array_combine($headers, $row);

            // create a new driver record
            Driver::updateOrCreate([
                'employee_number' => $data['employee_number'],
            ],[
                'name' => Str::title($data['firstname']),
                'lastname' => Str::title(Str::title($data['lastname'])),
                'said_number' => $data['said_number'] ?? $data['employee_number'], // we may not have the SAID number yet
            ]);
        }
    }
}
