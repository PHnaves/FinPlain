{{-- estilo completo em tailwind de lebrete de meta em email --}}
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Lembrete de Meta</h2>
    <p class="text-gray-600 mb-4">Ola, {{ $nome }}!</p>
    <p class="text-gray-600 mb-4">A meta "{{ $meta->titulo }}" chegou ao seu fim.</p>
    <p class="text-gray-600 mb-4">O valor final foi de R$ {{ $meta->valor_final }}.</p>
    <p class="text-gray-600 mb-4">Obrigado pela colaboração e pela sua constante parceria conosco e consigo mesmo!</p>
    <p class="text-gray-600 mb-4">Atenciosamente, o Time FinPlain.</p>
</div>  