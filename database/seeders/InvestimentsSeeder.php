<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Investiment;

class InvestimentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Investimentos para perfil conservador
        $conservadorInvestments = [
            [
                'investiment_name' => 'Fundos Imobiliários - HGLG11',
                'investiment_description' => 'Investimento de baixo risco, ideal para investidores conservadores. Renda mensal através de aluguéis.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2026-04-25',
                'minimum_value' => 3000.00
            ],
            [
                'investiment_name' => 'Tesouro Direto - IPCA+',
                'investiment_description' => 'Título público indexado à inflação, oferecendo proteção contra a desvalorização do dinheiro.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2026-12-31',
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'CDB Banco Inter',
                'investiment_description' => 'Certificado de Depósito Bancário com rendimento acima da poupança e proteção do FGC.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2025-12-31',
                'minimum_value' => 500.00
            ]
        ];

        // Investimentos para perfil moderado
        $moderadoInvestments = [
            [
                'investiment_name' => 'Ações - Petrobras (PETR4)',
                'investiment_description' => 'Ações preferenciais da Petrobras, empresa estatal com forte presença no setor de energia.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 2000.00
            ],
            [
                'investiment_name' => 'ETF BOVA11',
                'investiment_description' => 'ETF que replica o índice Bovespa, oferecendo diversificação em ações brasileiras.',
                'investiment_type' => 'ETF',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 1500.00
            ],
            [
                'investiment_name' => 'Debêntures - Energia',
                'investiment_description' => 'Títulos de dívida de empresas do setor elétrico com rendimento atrativo.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'moderado',
                'expiration_date' => '2027-06-30',
                'minimum_value' => 5000.00
            ]
        ];

        // Investimentos para perfil arrojado
        $arrojadoInvestments = [
            [
                'investiment_name' => 'Ações - Magazine Luiza (MGLU3)',
                'investiment_description' => 'Ações ordinárias de empresa de varejo digital com alto potencial de crescimento.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Criptomoedas - Bitcoin',
                'investiment_description' => 'Investimento em Bitcoin, a principal criptomoeda do mercado, com alta volatilidade.',
                'investiment_type' => 'Criptomoedas',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 500.00
            ],
            [
                'investiment_name' => 'Startups - FIIs de TICs',
                'investiment_description' => 'Fundos Imobiliários especializados em Tecnologia da Informação e Comunicação.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 2000.00
            ]
        ];

        // Criar todos os investimentos
        foreach (array_merge($conservadorInvestments, $moderadoInvestments, $arrojadoInvestments) as $investment) {
            if (empty($investment['expiration_date'])) {
                $investment['expiration_date'] = now()->addYears(5)->format('Y-m-d');
            }
            Investiment::create($investment);
        }
    }
}
