# Olá, {{ $user->name }}

Sua despesa **{{ $despesa->nome }}** no valor de **R$ {{ number_format($despesa->valor ?? 0, 2, ',', '.') }}** vence hoje!

Evite juros e pague antes do vencimento.

Atenciosamente,  
**Equipe FinPlan**
