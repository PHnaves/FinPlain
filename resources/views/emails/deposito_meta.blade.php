@component('mail::message')
# Olá, {{ $meta->user->name }}!

É hora de investir no seu futuro! 🚀  
Sua meta **"{{ $meta->descricao }}"** precisa de um novo depósito de **R$ {{ number_format($meta->valor_periodico, 2, ',', '.') }}**.

Não deixe sua meta escapar!

@component('mail::button', ['url' => route('metas.index')])
Ver Minhas Metas
@endcomponent

Bons investimentos!  
**Equipe FinPlan**
@endcomponent
