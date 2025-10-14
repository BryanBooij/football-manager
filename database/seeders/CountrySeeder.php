<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::create(['name' => 'England', 'code' => 'ENG']);
        Country::create(['name' => 'France', 'code' => 'FRA']);
        Country::create(['name' => 'Spain', 'code' => 'ESP']);
    }
}

