<?php

namespace App\Console\Commands;

use App\Models\Unit;
use Illuminate\Console\Command;
use Punksolid\Wialon\Unit as WialonUnit;
use Illuminate\Support\Str;

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
        $wialonUnits = WialonUnit::all();

        // start the progress bar
        $bar = $this->output->createProgressBar(count($wialonUnits));

        foreach ($wialonUnits as $wialonUnit) {
            // find the unit
            $unit = Unit::where('wialon_id', $wialonUnit->id)->first();
            $mileageCalibrationFactor = 0.001;
            $fuelCalibrationFactor = 0.1;

            if($unit) {
                $mileageSensor = $unit->wialon_mileage_sensor_id;
                $mileageCalibrationFactor = $unit->wialon_mileage_sensor_calibration_factor;

                $fuelSensor = $unit->wialon_fuel_consumption_sensor_id;
                $fuelCalibrationFactor = $unit->wialon_fuel_consumption_sensor_calibration_factor;
            } else {
                // determine the sensor ids

                $sensors = collect($wialonUnit->sens);

                $mileageSensor = $sensors->where('n', 'Dash Mileage')->first()?->p ?? null;

                if(!$mileageSensor) {
                    $mileageSensor = $sensors->where('n', 'Dash Mileage Counter')->first()?->p ?? null;
                }

                if(Str::contains($mileageSensor, '*'))
                {
                    $mileageSensor = explode('*', $mileageSensor)[0];
                }

                if(!$mileageSensor)
                {
                    $mileageSensor = 'io_107';
                }

                $fuelSensor = $sensors->where('n', 'Fuel Consumed')->first()?->p ?? null;

                if(!$fuelSensor) {
                    $fuelSensor = $sensors->where('n', 'Fuel Consumed (counted)')->first()?->p ?? null;
                }

                if(Str::contains($fuelSensor, '*'))
                {
                    $fuelSensor = explode('*', $fuelSensor)[0];
                }

                if(!$fuelSensor)
                {
                    $fuelSensor = 'io_83';
                }
            }


            /* if (!isset($wialonUnit?->lmsg?->p?->$fuelSensor)) {
                //dd('fuelsensor', $wialonUnit->nm, $fuelSensor, $wialonUnit->lmsg->p);
                continue;
            }

            if (!isset($wialonUnit?->lmsg?->p?->$mileageSensor)) {
                //dd('mileagesensor', $wialonUnit->nm, $mileageSensor, $wialonUnit->lmsg->p);
                continue;
            } */

            if ($unit) {
                $unit->update([
                    'wialon_nm' => $wialonUnit->nm,
                    'fuel_consumed_litres' => intval($wialonUnit->lmsg->p->$fuelSensor * $fuelCalibrationFactor),
                    'mileage_km' => intval($wialonUnit->lmsg->p->$mileageSensor * $mileageCalibrationFactor),
                    'data' => $wialonUnit,
                ]);

                $bar->advance();
                continue;
            }

            // create the unit if it does not exist
            Unit::create([
                    'wialon_id' => $wialonUnit->id,
                    'wialon_nm' => $wialonUnit->nm,
                    'wialon_mileage_sensor_id' => $mileageSensor,
                    'wialon_mileage_sensor_calibration_factor' => $mileageCalibrationFactor,
                    'wialon_fuel_consumption_sensor_id' => $fuelSensor,
                    'wialon_fuel_consumption_sensor_calibration_factor' => $fuelCalibrationFactor,
                    'fuel_consumed_litres' => intval($wialonUnit->lmsg->p->$fuelSensor ?? 0 * $fuelCalibrationFactor),
                    'mileage_km' => intval($wialonUnit->lmsg->p->$mileageSensor ?? 0 * $mileageCalibrationFactor),
                    'data' => $wialonUnit,
                ]
            );

            $bar->advance();
        }

        $bar->finish();
    }
}
