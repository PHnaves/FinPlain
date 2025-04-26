<?php

namespace Database\Seeders;

use App\Models\Investiment;
use Illuminate\Database\Seeder;

class InvestimentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Investiment::create([
            'investment_name' => 'Fundos Imobiliários - HGLG11',
            'investment_description' => 'Investimento de baixo risco, ideal para investidores conservadores.',
            'investment_type' => 'Fundos Imobiliários',
            'recommended_profile' => 'Conservador',
            'expiration_date' => '25/04/2026',
            'minimum_value' => 3000.00
        ]);
    }
}
