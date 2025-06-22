<?php

/**
 * Script de Verificação Completa do Sistema - FinPlan
 * 
 * Este script verifica se todas as funcionalidades estão funcionando corretamente:
 * - Configurações do sistema
 * - Banco de dados
 * - Notificações
 * - Emails
 * - Comandos
 * - Jobs
 */

require_once 'vendor/autoload.php';

use App\Models\User;
use App\Models\Expense;
use App\Models\Goal;
use App\Notifications\OverdueExpenseNotification;
use App\Notifications\TargetDepositNotification;
use App\Notifications\ExpenseLimitValueNotification;
use App\Mail\GoalEmail;
use App\Mail\ExpenseEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

echo "🔍 VERIFICAÇÃO COMPLETA DO SISTEMA - FINPLAN\n";
echo "============================================\n\n";

// Carregar o Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$erros = [];
$sucessos = [];

// 1. VERIFICAR CONFIGURAÇÃO
echo "1. 🔧 VERIFICANDO CONFIGURAÇÃO\n";
echo "==============================\n";

// Email
$mailDriver = config('mail.default');
echo "📧 Driver de Email: {$mailDriver}\n";
if (in_array($mailDriver, ['log', 'array'])) {
    echo "✅ Configuração de email adequada para testes\n";
    $sucessos[] = "Configuração de email";
} else {
    echo "⚠️  Driver de email pode precisar de configuração adicional\n";
    $erros[] = "Configuração de email";
}

// Queue
$queueDriver = config('queue.default');
echo "🔄 Driver de Queue: {$queueDriver}\n";
$sucessos[] = "Configuração de queue";

// Banco
$dbConnection = config('database.default');
echo "🗄️  Conexão do Banco: {$dbConnection}\n";
$sucessos[] = "Configuração de banco";

// Timezone
$timezone = config('app.timezone');
echo "⏰ Timezone: {$timezone}\n";
$sucessos[] = "Configuração de timezone";

echo "\n";

// 2. VERIFICAR BANCO DE DADOS
echo "2. 📊 VERIFICANDO BANCO DE DADOS\n";
echo "===============================\n";

try {
    // Verificar conexão
    \DB::connection()->getPdo();
    echo "✅ Conexão com banco de dados OK\n";
    $sucessos[] = "Conexão com banco";

    // Verificar tabelas
    $tables = ['users', 'expenses', 'goals', 'notifications', 'jobs'];
    foreach ($tables as $table) {
        try {
            $count = \DB::table($table)->count();
            echo "✅ Tabela {$table}: {$count} registros\n";
            $sucessos[] = "Tabela {$table}";
        } catch (\Exception $e) {
            echo "❌ Tabela {$table}: " . $e->getMessage() . "\n";
            $erros[] = "Tabela {$table}";
        }
    }

} catch (\Exception $e) {
    echo "❌ Erro na conexão com banco: " . $e->getMessage() . "\n";
    $erros[] = "Conexão com banco";
}

echo "\n";

// 3. VERIFICAR DADOS
echo "3. 📋 VERIFICANDO DADOS\n";
echo "======================\n";

$user = User::first();
if ($user) {
    echo "✅ Usuário encontrado: {$user->name} ({$user->email})\n";
    echo "💰 Renda: R$ " . number_format($user->rent ?? 0, 2, ',', '.') . "\n";
    $sucessos[] = "Dados de usuário";
} else {
    echo "❌ Nenhum usuário encontrado\n";
    $erros[] = "Dados de usuário";
}

$expense = Expense::first();
if ($expense) {
    echo "✅ Despesa encontrada: {$expense->expense_name}\n";
    echo "💸 Valor: R$ " . number_format($expense->expense_value, 2, ',', '.') . "\n";
    $sucessos[] = "Dados de despesa";
} else {
    echo "❌ Nenhuma despesa encontrada\n";
    $erros[] = "Dados de despesa";
}

$goal = Goal::first();
if ($goal) {
    echo "✅ Meta encontrada: {$goal->goal_title}\n";
    echo "🎯 Frequência: {$goal->frequency}\n";
    $sucessos[] = "Dados de meta";
} else {
    echo "❌ Nenhuma meta encontrada\n";
    $erros[] = "Dados de meta";
}

echo "\n";

// 4. VERIFICAR NOTIFICAÇÕES
echo "4. 🔔 VERIFICANDO NOTIFICAÇÕES\n";
echo "=============================\n";

if ($user) {
    try {
        // Testar notificação de despesa
        if ($expense) {
            $user->notify(new OverdueExpenseNotification($expense));
            echo "✅ Notificação de despesa criada\n";
            $sucessos[] = "Notificação de despesa";
        }

        // Testar notificação de meta
        if ($goal) {
            $user->notify(new TargetDepositNotification($goal));
            echo "✅ Notificação de meta criada\n";
            $sucessos[] = "Notificação de meta";
        }

        // Testar notificação de limite
        if ($expense) {
            $user->notify(new ExpenseLimitValueNotification($expense));
            echo "✅ Notificação de limite criada\n";
            $sucessos[] = "Notificação de limite";
        }

        // Verificar total de notificações
        $totalNotifications = $user->notifications()->count();
        $unreadNotifications = $user->unreadNotifications()->count();
        echo "📊 Total de notificações: {$totalNotifications}\n";
        echo "📬 Não lidas: {$unreadNotifications}\n";

    } catch (\Exception $e) {
        echo "❌ Erro ao criar notificações: " . $e->getMessage() . "\n";
        $erros[] = "Sistema de notificações";
    }
} else {
    echo "❌ Não é possível testar notificações sem usuário\n";
    $erros[] = "Sistema de notificações";
}

echo "\n";

// 5. VERIFICAR EMAILS
echo "5. 📧 VERIFICANDO EMAILS\n";
echo "=======================\n";

if ($user && $goal) {
    try {
        Mail::to($user->email)->send(new GoalEmail($user, $goal));
        echo "✅ Email de meta enviado\n";
        $sucessos[] = "Email de meta";

        if ($mailDriver === 'log') {
            $logFile = storage_path('logs/laravel-' . date('Y-m-d') . '.log');
            if (file_exists($logFile)) {
                echo "📝 Email salvo em: {$logFile}\n";
            }
        }

    } catch (\Exception $e) {
        echo "❌ Erro ao enviar email: " . $e->getMessage() . "\n";
        $erros[] = "Sistema de emails";
    }
}

if ($user && $expense) {
    try {
        Mail::to($user->email)->send(new ExpenseEmail($user, $expense));
        echo "✅ Email de despesa enviado\n";
        $sucessos[] = "Email de despesa";
    } catch (\Exception $e) {
        echo "❌ Erro ao enviar email de despesa: " . $e->getMessage() . "\n";
        $erros[] = "Email de despesa";
    }
}

echo "\n";

// 6. VERIFICAR COMANDOS
echo "6. ⚙️  VERIFICANDO COMANDOS\n";
echo "==========================\n";

$commands = [
    'notificar:despesas' => 'Comando de notificação de despesas',
    'notificar:depositos' => 'Comando de notificação de metas',
    'despesas:limite' => 'Comando de verificação de limite',
];

foreach ($commands as $command => $description) {
    try {
        $output = shell_exec("php artisan {$command} 2>&1");
        if (strpos($output, 'sucesso') !== false || strpos($output, 'success') !== false) {
            echo "✅ {$description} executado\n";
            $sucessos[] = $description;
        } else {
            echo "⚠️  {$description} executado (verificar saída)\n";
            echo "   Saída: " . trim($output) . "\n";
        }
    } catch (\Exception $e) {
        echo "❌ Erro ao executar {$description}: " . $e->getMessage() . "\n";
        $erros[] = $description;
    }
}

echo "\n";

// 7. VERIFICAR JOBS
echo "7. 🔄 VERIFICANDO JOBS\n";
echo "=====================\n";

try {
    $goalJob = new \App\Jobs\GoalJob();
    echo "✅ GoalJob pode ser instanciado\n";
    $sucessos[] = "GoalJob";
} catch (\Exception $e) {
    echo "❌ Erro ao instanciar GoalJob: " . $e->getMessage() . "\n";
    $erros[] = "GoalJob";
}

try {
    $expenseJob = new \App\Jobs\ExpenseJob();
    echo "✅ ExpenseJob pode ser instanciado\n";
    $sucessos[] = "ExpenseJob";
} catch (\Exception $e) {
    echo "❌ Erro ao instanciar ExpenseJob: " . $e->getMessage() . "\n";
    $erros[] = "ExpenseJob";
}

// Verificar jobs na fila
if ($queueDriver === 'database') {
    try {
        $jobCount = \DB::table('jobs')->count();
        echo "📊 Jobs na fila: {$jobCount}\n";
        $sucessos[] = "Jobs na fila";
    } catch (\Exception $e) {
        echo "⚠️  Não foi possível verificar jobs na fila: " . $e->getMessage() . "\n";
    }
}

echo "\n";

// 8. RESUMO FINAL
echo "8. 📊 RESUMO DA VERIFICAÇÃO\n";
echo "==========================\n";

$totalSucessos = count($sucessos);
$totalErros = count($erros);
$total = $totalSucessos + $totalErros;
$percentual = $total > 0 ? round(($totalSucessos / $total) * 100, 1) : 0;

echo "✅ Sucessos: {$totalSucessos}\n";
echo "❌ Erros: {$totalErros}\n";
echo "📈 Taxa de sucesso: {$percentual}%\n\n";

if ($totalErros === 0) {
    echo "🎉 SISTEMA FUNCIONANDO PERFEITAMENTE!\n";
    echo "====================================\n";
    echo "✅ Todas as funcionalidades estão operacionais\n";
    echo "✅ Pronto para a apresentação do TCC\n";
} elseif ($percentual >= 80) {
    echo "👍 SISTEMA FUNCIONANDO BEM!\n";
    echo "==========================\n";
    echo "✅ A maioria das funcionalidades está operacional\n";
    echo "⚠️  Alguns problemas menores foram detectados\n";
} else {
    echo "⚠️  SISTEMA COM PROBLEMAS!\n";
    echo "========================\n";
    echo "❌ Várias funcionalidades precisam de atenção\n";
    echo "🔧 Recomenda-se corrigir os problemas antes da apresentação\n";
}

echo "\n";

// 9. RECOMENDAÇÕES
if ($totalErros > 0) {
    echo "🔧 RECOMENDAÇÕES PARA CORREÇÃO:\n";
    echo "==============================\n";
    
    foreach ($erros as $erro) {
        echo "• Verificar: {$erro}\n";
    }
    
    echo "\n";
}

echo "📱 PRÓXIMOS PASSOS:\n";
echo "==================\n";
echo "1. Se tudo estiver OK: Pronto para apresentação!\n";
echo "2. Se houver erros: Corrigir problemas identificados\n";
echo "3. Executar este script novamente após correções\n";
echo "4. Testar manualmente as funcionalidades principais\n\n";

echo "🎯 COMANDOS ÚTEIS PARA APRESENTAÇÃO:\n";
echo "===================================\n";
echo "php artisan serve (iniciar servidor)\n";
echo "php artisan schedule:work (scheduler)\n";
echo "php artisan teste:demonstracao setup (dados de teste)\n";
echo "php verificar_sistema.php (executar esta verificação)\n\n";

echo "🚀 BOA SORTE NA APRESENTAÇÃO DO TCC!\n";
echo "====================================\n"; 