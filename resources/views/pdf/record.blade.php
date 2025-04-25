<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Gastos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 14px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .periodo {
            margin-bottom: 20px;
            color: #666;
            text-align: center;
        }
        .resumo {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Gastos</h1>
        <p>Gerado em: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="resumo">
        <h3>Resumo</h3>
        <p>Total de Gastos: R$ {{ number_format($total, 2, ',', '.') }}</p>
        <p>Quantidade de Gastos: {{ $expenses->count() }}</p>
        <p>Média por Gasto: R$ {{ number_format($expenses->count() > 0 ? $total / $expenses->count() : 0, 2, ',', '.') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Data de Vencimento</th>
                <th>Data de Pagamento</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th>Recorrência</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ \Carbon\Carbon::parse($expense->due_date)->format('d/m/Y') }}</td>
                <td>{{ $expense->payment_date ? \Carbon\Carbon::parse($expense->payment_date)->format('d/m/Y') : '-' }}</td>
                <td>{{ $expense->expense_description }}</td>
                <td>R$ {{ number_format($expense->expense_value, 2, ',', '.') }}</td>
                <td>{{ $expense->expense_category }}</td>
                <td>{{ ucfirst($expense->recurrence) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total: R$ {{ number_format($total, 2, ',', '.') }}
    </div>
</body>
</html>
