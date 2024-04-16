<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            'Reading',
            'Hiking',
            'Cooking',
            'Traveling',
            'Photography',
            'Painting',
            'Swimming',
            'Coding',
            'Gardening',
            'Yoga',
            'Singing',
            'Dancing',
            'Meditation',
            'Gaming',
            'Running',
            'Cycling',
            'Fishing',
            'Movies',
            'Music',
            'Art',
            'Fashion',
            'Sports',
            'Crafts',
            'Animals',
            'Fitness',
        ];

        foreach ($interests as $interest) {
            // Use firstOrCreate to avoid duplicates
            Interest::firstOrCreate([
                'name' => $interest,
            ]);
        }
    }
}
