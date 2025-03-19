@component('mail::message')
# Olá, {{ $user->name }}

Sua despesa **{{ $despesa->nome }}** no valor de **R$ {{ number_format($despesa->valor, 2, ',', '.') }}** vence hoje!

Evite juros e pague antes do vencimento.

@component('mail::button', ['url' => url('/despesas')])
Ver Despesas
@endcomponent

Atenciosamente,  
**Equipe FinPlan**
@endcomponent
