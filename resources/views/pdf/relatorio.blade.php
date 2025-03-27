<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Gastos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
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
        }
        .periodo {
            margin-bottom: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Relatório de Gastos</h1>
    
    <div class="periodo">
        Período: {{ $data_inicio }} até {{ $data_fim }}
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
                <td>{{ $gasto->necessario == 'sim' ? 'Sim' : 'Não' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total: R$ {{ number_format($total, 2, ',', '.') }}
    </div>
</body>
</html>