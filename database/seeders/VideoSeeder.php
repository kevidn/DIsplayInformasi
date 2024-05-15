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
            'youtubelinks' => 'https://www.youtube.com/watch?v=tSviQ4BR1YQ',
        ]);
    }
}
