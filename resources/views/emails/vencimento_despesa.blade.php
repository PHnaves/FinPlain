@component('mail::message')
# Olá, {{ $despesa->user->name }}!

Atenção! Sua despesa **"{{ $despesa->descricao }}"** no valor de **R$ {{ number_format($despesa->valor, 2, ',', '.') }}** vence em **{{ $despesa->vencimento->format('d/m/Y') }}**.

Evite multas e pague sua conta a tempo! 📅

@component('mail::button', ['url' => route('despesas.index')])
Ver Minhas Despesas
@endcomponent

Atenciosamente,  
**Equipe FinPlan**
@endcomponent
