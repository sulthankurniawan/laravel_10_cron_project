<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Jobs\FetchUsersJob;
use App\Jobs\TabulateDailyRecordsJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new FetchUsersJob)->hourly();
        $schedule->job(new TabulateDailyRecordsJob)->dailyAt('23:59');
    }

    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->job(new FetchUsersJob)->everyMinute();
    //     $schedule->job(new TabulateDailyRecordsJob)->dailyAt('23:59');
    // }

    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->job(new FetchUsersJob)->everyTenSeconds();
    //     $schedule->job(new TabulateDailyRecordsJob)->everyMinute();
    // }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
