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
            'nome' => 'Fundos Imobiliários - HGLG11',
            'descricao' => 'Investimento de baixo risco, ideal para investidores conservadores.',
            'tipo' => 'Fundos Imobiliários',
            'perfil_recomendado' => 'Conservador',
            'prazo' => 'Médio Prazo',
            'valor_recomendado' => 3000.00
        ]);

        Investiment::create([
            'nome' => 'Ações - PETR4',
            'descricao' => 'Ação de alto risco com potencial de retorno no curto prazo.',
            'tipo' => 'Ações',
            'perfil_recomendado' => 'Arrojado',
            'prazo' => 'Curto Prazo',
            'valor_recomendado' => 1500.00
        ]);

        Investiment::create([
            'nome' => 'Tesouro Direto - Tesouro Selic',
            'descricao' => 'Investimento de baixo risco, ideal para quem busca segurança.',
            'tipo' => 'Renda Fixa',
            'perfil_recomendado' => 'Conservador',
            'prazo' => 'Longo Prazo',
            'valor_recomendado' => 2000.00
        ]);
    }
}
