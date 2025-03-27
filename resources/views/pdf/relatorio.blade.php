<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Gastos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }
        .periodo {
            margin-bottom: 20px;
            color: #666;
            text-align: center;
        }
        .necessario {
            color: #4CAF50;
        }
        .nao-necessario {
            color: #f44336;
        }
        .resumo {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Gastos</h1>
        <p>Gerado em: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
    
    <div class="periodo">
        Período: {{ $data_inicio }} até {{ $data_fim }}
    </div>
    
    <div class="resumo">
        <h3>Resumo</h3>
        <p>Total de Gastos: R$ {{ number_format($total, 2, ',', '.') }}</p>
        <p>Quantidade de Gastos: {{ $gastos->count() }}</p>
        <p>Média por Gasto: R$ {{ number_format($gastos->count() > 0 ? $total / $gastos->count() : 0, 2, ',', '.') }}</p>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Necessário</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gastos as $gasto)
            <tr>
                <td>{{ \Carbon\Carbon::parse($gasto->created_at)->format('d/m/Y') }}</td>
                <td>{{ $gasto->descricao }}</td>
                <td>R$ {{ number_format($gasto->valor, 2, ',', '.') }}</td>
                <td class="{{ $gasto->necessario == 'sim' ? 'necessario' : 'nao-necessario' }}">
                    {{ $gasto->necessario == 'sim' ? 'Sim' : 'Não' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total: R$ {{ number_format($total, 2, ',', '.') }}
    </div>
</body>
</html>