<?php

// use Illuminate\Support\Facades\Schedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

app(Schedule::class)->command('subscription:update-status')->everyMinute()->then(function () {
    Artisan::call('queue:work --once');
});
