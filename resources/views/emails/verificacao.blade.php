<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de E-mail</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .header {
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 24px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 32px 20px;
            color: #333;
        }
        .content h2 {
            font-size: 20px;
            margin-top: 0;
        }
        .content p {
            font-size: 15px;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            background-color: #0d6efd;
            color: white;
            padding: 12px 24px;
            margin-top: 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            font-size: 13px;
            color: #777;
            padding: 24px 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>FinPlan</h1>
        </div>
        <div class="content">
            <h2>Olá, {{ $usuario->name ?? 'usuário' }}!</h2>
            <p>
                Obrigado por se registrar na <strong>FinPlan</strong>. Antes de começarmos, precisamos confirmar seu endereço de e-mail.
            </p>
            <p>
                Clique no botão abaixo para verificar seu e-mail e liberar todas as funcionalidades da plataforma:
            </p>
            <a href="{{ $url }}" class="btn">Confirmar E-mail</a>
            <p>
                Se você não criou uma conta, ignore esta mensagem.
            </p>
        </div>
        <div class="footer">
            © {{ date('Y') }} FinPlan. Todos os direitos reservados.
        </div>
    </div>
</body>
</html>