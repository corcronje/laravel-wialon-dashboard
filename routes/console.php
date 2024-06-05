<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// shedule the import:units command to run every five minutes
Artisan::command('import:units', function () {
    $this->comment('Importing units...');
    Artisan::call('import:units');
})->purpose('Syncronize units from Wialon to the local database.')->everyFiveMinutes();
