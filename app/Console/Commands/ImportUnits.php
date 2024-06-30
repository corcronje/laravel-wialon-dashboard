<?php

namespace App\Console\Commands;

use App\Models\Unit;
use Illuminate\Console\Command;
use Punksolid\Wialon\Unit as WialonUnit;

class ImportUnits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:units';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncronize units from Wialon to the local database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mileageSensor = 'io_87';
        $mileageCalibrationFactor = 0.001;

        $fuelSensor = 'io_83';
        $fuelCalibrationFactor = 0.1;


        $wialonUnits = WialonUnit::all();

        // start the progress bar
        $bar = $this->output->createProgressBar(count($wialonUnits));

        foreach ($wialonUnits as $wialonUnit) {
            if (!($wialonUnit?->lmsg?->p?->$fuelSensor ?? false)) {
                continue;
            }

            if (!($wialonUnit?->lmsg?->p?->$mileageSensor ?? false)) {
                continue;
            }

            Unit::updateOrCreate(
                ['wialon_id' => $wialonUnit->id],
                [
                    'wialon_id' => $wialonUnit->id,
                    'wialon_nm' => $wialonUnit->nm,
                    'wialon_mileage_sensor_id' => $mileageSensor,
                    'wialon_mileage_sensor_calibration_factor' => $mileageCalibrationFactor,
                    'wialon_fuel_consumption_sensor_id' => $fuelSensor,
                    'wialon_fuel_consumption_sensor_calibration_factor' => $fuelCalibrationFactor,
                    'fuel_consumed_litres' => intval($wialonUnit->lmsg->p->$fuelSensor * $fuelCalibrationFactor),
                    'mileage_km' => intval($wialonUnit->lmsg->p->$mileageSensor * $mileageCalibrationFactor),
                    'data' => $wialonUnit,
                ]
            );

            $bar->advance();
        }

        $bar->finish();
    }
}
