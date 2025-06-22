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
        $allInvestments = [
            [
                'investiment_name' => 'Fundo Imobiliário (FII) – HGLG11',
                'investiment_description' => 'Fundo imobiliário focado em imóveis logísticos.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 100.00
            ],
            [
                'investiment_name' => 'Ação – Petrobras (PETR4)',
                'investiment_description' => 'Ações da Petrobras, líder no setor de petróleo.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 30.00
            ],
            [
                'investiment_name' => 'Tesouro Direto – Tesouro Selic',
                'investiment_description' => 'Título público atrelado à taxa Selic.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2027-03-01',
                'minimum_value' => 30.00
            ],
            [
                'investiment_name' => 'CDB – Banco do Brasil (CDB Pós-Fixado)',
                'investiment_description' => 'CDB pós-fixado atrelado ao CDI.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador a moderado',
                'expiration_date' => '2028-04-15',
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Ação – Magazine Luiza (MGLU3)',
                'investiment_description' => 'Ações da Magazine Luiza, varejo no Brasil.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 20.00
            ],
            [
                'investiment_name' => 'LCI/LCA – Banco Santander',
                'investiment_description' => 'Letras de Crédito Imobiliário e do Agronegócio.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2029-06-12',
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Fundos de Ações – Caixa Ações',
                'investiment_description' => 'Fundo de ações com carteira diversificada.',
                'investiment_type' => 'Fundos de Investimento',
                'recommended_profile' => 'moderado a arrojado',
                'expiration_date' => null,
                'minimum_value' => 500.00
            ],
            [
                'investiment_name' => 'Fundos Multimercado – BB Multimercado',
                'investiment_description' => 'Fundo que mescla ações, renda fixa e outros ativos.',
                'investiment_type' => 'Fundos de Investimento',
                'recommended_profile' => 'moderado a arrojado',
                'expiration_date' => null,
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'BDRs (Tesla – TSLA34)',
                'investiment_description' => 'BDRs para exposição à Tesla.',
                'investiment_type' => 'Ações (Internacional)',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 50.00
            ],
            [
                'investiment_name' => 'Poupança',
                'investiment_description' => 'A caderneta de poupança tradicional.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => null,
                'minimum_value' => 50.00
            ],
            [
                'investiment_name' => 'Fundo Imobiliário (FII) – VISC11',
                'investiment_description' => 'FII focado em imóveis comerciais.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 100.00
            ],
            [
                'investiment_name' => 'Ação – Vale (VALE3)',
                'investiment_description' => 'Ações da Vale, gigante da mineração.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 70.00
            ],
            [
                'investiment_name' => 'Tesouro Direto – Tesouro Prefixado 2025',
                'investiment_description' => 'Título público com taxa fixa.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador a moderado',
                'expiration_date' => '2025-01-01',
                'minimum_value' => 30.00
            ],
            [
                'investiment_name' => 'CDB – Itaú (CDB Pós-Fixado)',
                'investiment_description' => 'CDB com rentabilidade atrelada ao CDI.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador a moderado',
                'expiration_date' => '2028-05-10',
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Fundo Imobiliário (FII) – MXRF11',
                'investiment_description' => 'FII com imóveis diversos.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 100.00
            ],
            [
                'investiment_name' => 'Ação – Ambev (ABEV3)',
                'investiment_description' => 'Ações da Ambev, setor de bebidas.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 15.00
            ],
            [
                'investiment_name' => 'LCI/LCA – Banco Bradesco',
                'investiment_description' => 'Letras de Crédito Imobiliário e Agronegócio.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2029-09-01',
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Fundos de Ações – Itaú Ações',
                'investiment_description' => 'Fundo de ações diversificado.',
                'investiment_type' => 'Fundos de Investimento',
                'recommended_profile' => 'moderado a arrojado',
                'expiration_date' => null,
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Ação – Itaú (ITUB4)',
                'investiment_description' => 'Ações do Itaú Unibanco.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 30.00
            ],
            [
                'investiment_name' => 'Fundo Imobiliário (FII) – KNRI11',
                'investiment_description' => 'Imóveis comerciais e logísticos.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 100.00
            ],
            [
                'investiment_name' => 'Tesouro IPCA+ 2035',
                'investiment_description' => 'Título público atrelado à inflação (IPCA) + taxa fixa.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'moderado',
                'expiration_date' => '2035-05-15',
                'minimum_value' => 30.00
            ],
            [
                'investiment_name' => 'CDB – Inter (CDB com Liquidez Diária)',
                'investiment_description' => 'CDB com resgate a qualquer momento.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => null,
                'minimum_value' => 100.00
            ],
            [
                'investiment_name' => 'Ação – Localiza (RENT3)',
                'investiment_description' => 'Ações da maior locadora de veículos da América Latina.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 70.00
            ],
            [
                'investiment_name' => 'ETF – BOVA11',
                'investiment_description' => 'Fundo que replica o Ibovespa.',
                'investiment_type' => 'ETF',
                'recommended_profile' => 'moderado a arrojado',
                'expiration_date' => null,
                'minimum_value' => 120.00
            ],
            [
                'investiment_name' => 'ETF – IVVB11',
                'investiment_description' => 'Fundo que replica o S&P 500.',
                'investiment_type' => 'ETF',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 250.00
            ],
            [
                'investiment_name' => 'Debêntures – Eletrobras',
                'investiment_description' => 'Títulos de dívida emitidos pela Eletrobras.',
                'investiment_type' => 'Renda Fixa Privada',
                'recommended_profile' => 'moderado',
                'expiration_date' => '2030-08-15',
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Previdência Privada – PGBL Itaú',
                'investiment_description' => 'Previdência complementar com benefício fiscal.',
                'investiment_type' => 'Previdência',
                'recommended_profile' => 'conservador a moderado',
                'expiration_date' => null,
                'minimum_value' => 100.00
            ],
            [
                'investiment_name' => 'Fundo Cambial – Dólar',
                'investiment_description' => 'Fundo que acompanha a variação do dólar.',
                'investiment_type' => 'Fundo Cambial',
                'recommended_profile' => 'moderado a arrojado',
                'expiration_date' => null,
                'minimum_value' => 500.00
            ],
            [
                'investiment_name' => 'Fundos Imobiliários – BTLG11',
                'investiment_description' => 'Foco em galpões logísticos.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 110.00
            ],
            [
                'investiment_name' => 'Criptomoeda – Bitcoin (via corretora)',
                'investiment_description' => 'Principal criptoativo do mundo.',
                'investiment_type' => 'Criptoativo',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 50.00
            ],
            [
                'investiment_name' => 'Criptomoeda – Ethereum',
                'investiment_description' => 'Plataforma descentralizada para contratos inteligentes.',
                'investiment_type' => 'Criptoativo',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 50.00
            ],
            [
                'investiment_name' => 'COE – Crédito Estruturado',
                'investiment_description' => 'Produto com proteção parcial e retorno atrelado a índices.',
                'investiment_type' => 'Investimento Estruturado',
                'recommended_profile' => 'moderado a arrojado',
                'expiration_date' => '2027-10-10',
                'minimum_value' => 5000.00
            ],
            [
                'investiment_name' => 'Fundo Internacional – BlackRock Global',
                'investiment_description' => 'Acesso a ativos globais via fundo.',
                'investiment_type' => 'Fundos Internacionais',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'FII – HGRE11',
                'investiment_description' => 'Fundo imobiliário focado em lajes corporativas.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 120.00
            ],
            [
                'investiment_name' => 'Ação – Weg (WEGE3)',
                'investiment_description' => 'Indústria de motores e tecnologia.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 35.00
            ],
            [
                'investiment_name' => 'Tesouro RendA+ 2065',
                'investiment_description' => 'Aposentadoria pública complementar.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2065-12-15',
                'minimum_value' => 30.00
            ],
            [
                'investiment_name' => 'FII – XPML11',
                'investiment_description' => 'Foco em shoppings centers.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 100.00
            ],
            [
                'investiment_name' => 'ETF – SMAL11',
                'investiment_description' => 'Fundo que replica índice de small caps.',
                'investiment_type' => 'ETF',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 120.00
            ],
            [
                'investiment_name' => 'LCI – Banco Inter',
                'investiment_description' => 'Letra de Crédito Imobiliário com isenção de IR.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2027-06-22',
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Ação – Raia Drogasil (RADL3)',
                'investiment_description' => 'Setor farmacêutico e varejo.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 30.00
            ],
            [
                'investiment_name' => 'Fundo de Ações – Alaska Black FIC FIA',
                'investiment_description' => 'Fundo de ações com gestão ativa.',
                'investiment_type' => 'Fundo de Investimento',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 500.00
            ],
            [
                'investiment_name' => 'LCA – Banco do Brasil',
                'investiment_description' => 'Letra de Crédito do Agronegócio com isenção de IR.',
                'investiment_type' => 'Renda Fixa',
                'recommended_profile' => 'conservador',
                'expiration_date' => '2027-07-03',
                'minimum_value' => 1000.00
            ],
            [
                'investiment_name' => 'Fundo Multimercado – Kinea Prev FIM',
                'investiment_description' => 'Fundo que combina ativos diversos, ideal para previdência.',
                'investiment_type' => 'Multimercado',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 500.00
            ],
            [
                'investiment_name' => 'BDR – Apple (AAPL34)',
                'investiment_description' => 'Recibo de ações da Apple negociado no Brasil.',
                'investiment_type' => 'BDR',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 60.00
            ],
            [
                'investiment_name' => 'BDR – Microsoft (MSFT34)',
                'investiment_description' => 'Recibo de ações da Microsoft.',
                'investiment_type' => 'BDR',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 70.00
            ],
            [
                'investiment_name' => 'Ação – Petrobras (PETR4)',
                'investiment_description' => 'Ações preferenciais da Petrobras.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'moderado a arrojado',
                'expiration_date' => null,
                'minimum_value' => 40.00
            ],
            [
                'investiment_name' => 'FII – HGLG11',
                'investiment_description' => 'Fundo de logística com bons pagadores de dividendos.',
                'investiment_type' => 'Fundos Imobiliários',
                'recommended_profile' => 'moderado',
                'expiration_date' => null,
                'minimum_value' => 150.00
            ],
            [
                'investiment_name' => 'ETF – HASH11',
                'investiment_description' => 'ETF que replica um índice de criptomoedas.',
                'investiment_type' => 'ETF',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 50.00
            ],
            [
                'investiment_name' => 'Ação – Magazine Luiza (MGLU3)',
                'investiment_description' => 'Varejo digital com forte crescimento no passado recente.',
                'investiment_type' => 'Ações',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 15.00
            ],
            [
                'investiment_name' => 'Fundo Quantitativo – Giant Zarathustra',
                'investiment_description' => 'Fundo baseado em algoritmos e análise quantitativa.',
                'investiment_type' => 'Fundo de Investimento',
                'recommended_profile' => 'arrojado',
                'expiration_date' => null,
                'minimum_value' => 1000.00
            ],
        ];

        foreach ($allInvestments as $investment) {
            if (empty($investment['expiration_date'])) {
                $investment['expiration_date'] = '2099-12-31';
            }
            Investiment::create($investment);
        }
    }
}
