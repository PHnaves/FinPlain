# Olá, {{ $user->name }}

Não se esqueça de depositar **R$ {{ number_format($meta->valor_final ?? 0, 2, ',', '.') }}** para sua meta **{{ $meta->nome }}**.

Pequenos passos levam a grandes conquistas!

Atenciosamente,  
**Equipe FinPlan**
