<?php

namespace Database\Seeders;

use App\Models\Entry;
use Illuminate\Database\Seeder;

class EntrySeed extends Seeder
{
    public function run(): void
    {
        Entry::withoutEvents(function () {
            Entry::factory()->count(100)->create();
        });
    }
}
