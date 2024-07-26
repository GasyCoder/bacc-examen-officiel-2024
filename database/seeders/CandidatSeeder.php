<?php

namespace Database\Seeders;

use App\Models\Candidat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidat::factory()->count(10)->create();
    }
}
