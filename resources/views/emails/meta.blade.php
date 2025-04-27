# Olá, {{ $user->name }}

Não se esqueça de depositar **R$ {{ number_format($goal->target_value ?? 0, 2, ',', '.') }}** para sua meta **{{ $goal->goal_name }}**.

Pequenos passos levam a grandes conquistas!

Atenciosamente,  
**Equipe FinPlan**
