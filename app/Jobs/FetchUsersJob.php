<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class FetchUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        Log::info('FetchUsersJob started.');

        try {
            $response = Http::get('https://randomuser.me/api/?results=20');
            $users = $response->json()['results'];

            foreach ($users as $user) {
                User::updateOrCreate(
                    ['uuid' => $user['login']['uuid']],
                    [
                        'gender' => $user['gender'],
                        'name' => json_encode($user['name']),
                        'location' => json_encode($user['location']),
                        'age' => $user['dob']['age']
                    ]
                );

                Redis::incr($user['gender'] === 'male' ? 'male_count' : 'female_count');
            }

            Log::info('FetchUsersJob completed successfully.');
        } catch (\Exception $e) {
            Log::error('FetchUsersJob failed: ' . $e->getMessage());
        }
    }
}
