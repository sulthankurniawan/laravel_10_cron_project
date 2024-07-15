<?php

namespace App\Jobs;

use App\Models\DailyRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TabulateDailyRecordsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $date = now()->toDateString();
        $male_count = Redis::get('male_count') ?? 0;
        $female_count = Redis::get('female_count') ?? 0;
        Log::info("Tabulating records: male_count=$male_count, female_count=$female_count");

        DailyRecord::updateOrCreate(
            ['date' => $date],
            ['male_count' => $male_count, 'female_count' => $female_count]
        );

        Redis::del('male_count');
        Redis::del('female_count');
        Log::info("Counts reset in Redis.");
    }
}
