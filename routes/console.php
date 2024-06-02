<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('import:units', function () {
    $this->comment('Units imported successfully');
})->purpose('Sync Wialon unit messages')->everyFiveMinutes();
