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
        $units = WialonUnit::all();

        foreach ($units as $unit) {
            if (!($unit?->lmsg?->p?->io_107 ?? false)) {
                continue;
            }

            Unit::updateOrCreate(
                ['wialon_id' => $unit->id],
                [
                    'wialon_id' => $unit->id,
                    'wialon_nm' => $unit->nm,
                    'fuel_consumed_litres' => $unit->lmsg->p->io_107,
                    'mileage_km' => intval($unit->lmsg->p->io_87 * 0.001),
                ]
            );
        }
    }
}
