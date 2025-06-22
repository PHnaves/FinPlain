<?php

/**
 * Script de Teste para Demonstração do TCC - FinPlan
 * 
 * Este script cria dados de teste e executa os comandos de notificação
 * para facilitar a demonstração durante a apresentação.
 */

require_once 'vendor/autoload.php';

use App\Models\User;
use App\Models\Expense;
use App\Models\Goal;
use Carbon\Carbon;

echo "🎯 SCRIPT DE TESTE PARA DEMONSTRAÇÃO DO TCC - FINPLAN\n";
echo "==================================================\n\n";

// 1. Criar usuário de teste
echo "1. Criando usuário de teste...\n";
$user = User::firstOrCreate(
    ['email' => 'teste@finplan.com'],
    [
        'name' => 'Usuário Teste TCC',
        'password' => bcrypt('123456'),
        'rent' => 1000.00,
        'monthly_income' => 1000.00,
        'payment_frequency' => 'mensal',
        'payment_day' => 5
    ]
);
echo "✅ Usuário criado: {$user->name} ({$user->email})\n\n";

// 2. Criar despesa que vence amanhã
echo "2. Criando despesa que vence amanhã...\n";
$expense = Expense::firstOrCreate(
    [
        'user_id' => $user->id,
        'expense_name' => 'Teste de Notificação - Despesa'
    ],
    [
        'expense_description' => 'Despesa criada para teste de notificação',
        'expense_value' => 150.00,
        'due_date' => Carbon::tomorrow(),
        'recurrence' => 'a vista',
        'installments' => 1,
        'status' => 'pendente'
    ]
);
echo "✅ Despesa criada: {$expense->expense_name} - Vence: " . Carbon::parse($expense->due_date)->format('d/m/Y') . "\n\n";

// 3. Criar meta semanal (criada há 7 dias)
echo "3. Criando meta semanal...\n";
$goal = Goal::firstOrCreate(
    [
        'user_id' => $user->id,
        'goal_title' => 'Teste de Notificação - Meta'
    ],
    [
        'goal_description' => 'Meta criada para teste de notificação',
        'goal_target_value' => 1000.00,
        'goal_current_value' => 0.00,
        'frequency' => 'semanal',
        'recurring_value' => 100.00,
        'status' => 'andamento',
        'created_at' => Carbon::now()->subDays(7) // 7 dias atrás
    ]
);
echo "✅ Meta criada: {$goal->goal_title} - Frequência: {$goal->frequency}\n\n";

// 4. Criar despesa que excede 50% da renda
echo "4. Criando despesa que excede 50% da renda...\n";
$expenseLimit = Expense::firstOrCreate(
    [
        'user_id' => $user->id,
        'expense_name' => 'Teste de Limite - Despesa'
    ],
    [
        'expense_description' => 'Despesa que excede 50% da renda para teste',
        'expense_value' => 600.00, // 60% da renda de R$ 1000
        'due_date' => Carbon::now()->addDays(10),
        'recurrence' => 'a vista',
        'installments' => 1,
        'status' => 'pendente'
    ]
);
echo "✅ Despesa de limite criada: {$expenseLimit->expense_name} - Valor: R$ " . number_format($expenseLimit->expense_value, 2, ',', '.') . "\n\n";

echo "🎉 DADOS DE TESTE CRIADOS COM SUCESSO!\n";
echo "=====================================\n\n";

echo "📋 COMANDOS PARA EXECUTAR DURANTE A APRESENTAÇÃO:\n";
echo "================================================\n\n";

echo "1. Para testar notificação de despesas vencendo:\n";
echo "   php artisan notificar:despesas\n\n";

echo "2. Para testar notificação de depósitos de metas:\n";
echo "   php artisan notificar:depositos\n\n";

echo "3. Para testar notificação de limite de despesas:\n";
echo "   php artisan despesas:limite\n\n";

echo "4. Para testar envio de emails (se configurado):\n";
echo "   php artisan queue:work --once\n\n";

echo "5. Para verificar notificações no banco:\n";
echo "   php artisan tinker\n";
echo "   App\Models\User::first()->notifications()->get();\n\n";

echo "🔧 CONFIGURAÇÃO DE EMAIL PARA DEMONSTRAÇÃO:\n";
echo "==========================================\n\n";

echo "No arquivo .env, configure:\n";
echo "MAIL_MAILER=log\n";
echo "MAIL_LOG_CHANNEL=daily\n\n";

echo "Isso salvará os emails em: storage/logs/laravel-YYYY-MM-DD.log\n\n";

echo "📱 PASSOS PARA DEMONSTRAÇÃO:\n";
echo "===========================\n\n";

echo "1. Faça login com: teste@finplan.com / 123456\n";
echo "2. Vá para a página de notificações\n";
echo "3. Execute um dos comandos acima\n";
echo "4. Recarregue a página para ver a nova notificação\n";
echo "5. Demonstre os filtros por tipo\n";
echo "6. Marque uma notificação como lida\n\n";

echo "🚨 EM CASO DE PROBLEMAS:\n";
echo "=======================\n\n";

echo "- Verifique se o Laravel está rodando: php artisan serve\n";
echo "- Verifique se o scheduler está rodando: php artisan schedule:work\n";
echo "- Verifique os logs: tail -f storage/logs/laravel.log\n";
echo "- Verifique o banco de dados: php artisan migrate:status\n\n";

echo "✅ TUDO PRONTO PARA A APRESENTAÇÃO!\n";
echo "==================================\n"; 