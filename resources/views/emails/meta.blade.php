@component('mail::message')
# Olá, {{ $user->name }}

Não se esqueça de depositar **R$ {{ number_format($meta->valor, 2, ',', '.') }}** para sua meta **{{ $meta->nome }}**.

Pequenos passos levam a grandes conquistas!

@component('mail::button', ['url' => url('/metas')])
Ver Metas
@endcomponent

Atenciosamente,  
**Equipe FinPlan**
@endcomponent
