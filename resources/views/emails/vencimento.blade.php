# Olá, {{ $user->name }}

Sua despesa **{{ $expense->expense_name }}** no valor de **R$ {{ number_format($expense->expense_value ?? 0, 2, ',', '.') }}** vence hoje!

Evite juros e pague antes do vencimento.

Atenciosamente,  
**Equipe FinPlan**
