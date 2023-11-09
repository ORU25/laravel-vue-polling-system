<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poll::create([
            'user_id' => '1',
            'question' => 'Apakah Kamu Senang ?'
        ]);

        Option::create([
            'poll_id' => '1',
            'option' => 'Iya',
        ]);

        Option::create([
            'poll_id' => '1',
            'option' => 'Tidak',
        ]);

        Vote::create([
            'poll_id' => '1',
            'option_id' => '1'
        ]);
        Vote::create([
            'poll_id' => '1',
            'option_id' => '1'
        ]);
        Vote::create([
            'poll_id' => '1',
            'option_id' => '2'
        ]);
    }
}
