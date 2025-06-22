<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembrete de Meta - FinPlan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 40px 20px;
            position: relative;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }
        .header-content {
            position: relative;
            z-index: 1;
        }
        .logo {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .header-subtitle {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
        }
        .content {
            padding: 40px 30px;
            color: #374151;
        }
        .greeting {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 30px;
            line-height: 1.7;
        }
        .goal-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 2px solid #f59e0b;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        .goal-title {
            font-size: 20px;
            font-weight: 700;
            color: #92400e;
            margin-bottom: 15px;
        }
        .goal-amount {
            font-size: 28px;
            font-weight: 800;
            color: #78350f;
            margin-bottom: 10px;
        }
        .goal-description {
            font-size: 14px;
            color: #a16207;
            font-style: italic;
        }
        .motivation {
            background-color: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
        }
        .motivation-text {
            font-size: 16px;
            color: #065f46;
            font-weight: 500;
            margin: 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            text-color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer-text {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }
        .footer-logo {
            font-size: 18px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 5px;
        }
        .footer-copyright {
            font-size: 12px;
            color: #9ca3af;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 25px 0;
            text-align: center;
        }
        .stat-item {
            flex: 1;
            padding: 15px;
        }
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            display: block;
        }
        .stat-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 20px;
                border-radius: 12px;
            }
            .content {
                padding: 30px 20px;
            }
            .header {
                padding: 30px 20px;
            }
            .stats {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="header-content">
                <div class="logo">💰 FinPlan</div>
                <p class="header-subtitle">Sua jornada para o sucesso financeiro</p>
            </div>
        </div>
        
        <div class="content">
            <h1 class="greeting">Olá, {{ $user->name }}! 👋</h1>
            
            <p class="message">
                Chegou a hora de dar mais um passo em direção ao seu objetivo financeiro! 
                Não se esqueça de fazer o depósito programado para sua meta.
            </p>
            
            <div class="goal-card">
                <div class="goal-title">{{ $goal->goal_title ?? 'Sua Meta' }}</div>
                <div class="goal-amount">R$ {{ number_format($goal->target_value ?? 0, 2, ',', '.') }}</div>
                <div class="goal-description">Valor do depósito programado</div>
            </div>
            
            <div class="stats">
                <div class="stat-item">
                    <span class="stat-value">{{ $goal->frequency ?? 'Mensal' }}</span>
                    <span class="stat-label">Frequência</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">R$ {{ number_format($goal->recurring_value ?? 0, 2, ',', '.') }}</span>
                    <span class="stat-label">Por Período</span>
                </div>
            </div>
            
            <div class="motivation">
                <p class="motivation-text">
                    💪 <strong>Lembre-se:</strong> Pequenos passos levam a grandes conquistas! 
                    Cada depósito te aproxima mais do seu objetivo.
                </p>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ url('http://127.0.0.1:8000/') }}" class="cta-button">
                    📊 Ver Minhas Metas
                </a>
            </div>
        </div>
        
        <div class="footer">
            <div class="footer-logo">FinPlan</div>
            <p class="footer-text">
                Transformando sonhos em realidade financeira
            </p>
            <p class="footer-copyright">
                © {{ date('Y') }} FinPlan. Todos os direitos reservados.
            </p>
        </div>
    </div>
</body>
</html>
