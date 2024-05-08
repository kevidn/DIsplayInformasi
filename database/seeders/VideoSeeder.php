<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Video::create([
            'youtubelinks' => 'https://youtube.com/embed/e-B0VKTt5_Q?si=yaG2U9hA4fqMi0M9',
        ]);
    }
}
