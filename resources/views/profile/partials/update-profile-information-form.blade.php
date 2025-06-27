<section>
    <header class="mb-6 border-b-2 border-primary-1 pb-4">
        <h2 class="text-3xl font-bold text-primary-1">
            Informações do perfil
        </h2>
        <p class="mt-2 text-gray-600 text-base">
            Atualize as informações do seu perfil e endereço de e-mail.
        </p>
    </header>


    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Seu endereço de e-mail não está verificado.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Um novo link de verificação foi enviado para o seu e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Type User -->
        <div class="mt-4">
            <x-input-label for="type_user" :value="__('Tipo de usuário')" />
            <select id="type_user" name="type_user" class="form-control" required>
                <option value="" disabled {{ old('type_user', $user->type_user) == null ? 'selected' : '' }}>Selecione um tipo de usuário</option>
                <option value="conservador" {{ old('type_user', $user->type_user) == 'conservador' ? 'selected' : '' }}>Conservador</option>
                <option value="moderado" {{ old('type_user', $user->type_user) == 'moderado' ? 'selected' : '' }}>Moderado</option>
                <option value="arrojado" {{ old('type_user', $user->type_user) == 'arrojado' ? 'selected' : '' }}>Arrojado</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('type_user')" />
        </div>

        <!-- Input Rent -->
        <div class="mt-4">
            <x-input-label for="rent" :value="__('Renda atual')" />
            <x-text-input id="rent" class="form-control" type="number" name="rent" min="0" max="99999999,99" step="0.01" :value="old('rent', $user->rent)" required />
            <x-input-error class="mt-2" :messages="$errors->get('rent')" />
        </div>

        <!-- Monthly Income -->
        <div class="mt-4">
            <x-input-label for="monthly_income" :value="__('Salário mensal (R$)')" />
            <x-text-input id="monthly_income" name="monthly_income" min="0" max="99999999,99" type="number" step="0.01" class="form-control" :value="old('monthly_income', $user->monthly_income)" required />
            <x-input-error class="mt-2" :messages="$errors->get('monthly_income')" />
        </div>

        <!-- Payment frequency -->
        <div class="mt-4">
            <x-input-label for="payment_frequency" :value="__('Frequência de pagamento')" />
            <select id="payment_frequency" name="payment_frequency" class="form-control" required>
                <option value="" disabled {{ old('payment_frequency', $user->payment_frequency) == null ? 'selected' : '' }}>Selecione uma Frequência</option>
                <option value="mensal" {{ old('payment_frequency', $user->payment_frequency) == 'mensal' ? 'selected' : '' }}>Mensal</option>
                <option value="quinzenal" {{ old('payment_frequency', $user->payment_frequency) == 'quinzenal' ? 'selected' : '' }}>Quinzenal</option>
                <option value="semanal" {{ old('payment_frequency', $user->payment_frequency) == 'semanal' ? 'selected' : '' }}>Semanal</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('payment_frequency')" />
        </div>

        <!-- Payment Day -->
        <div class="mt-4">
            <x-input-label for="payment_day" :value="__('Dia do pagamento')" />
            <x-text-input id="payment_day" name="payment_day" type="number" class="form-control" :value="old('payment_day', $user->payment_day)" required min="1" max="31"/>
            <x-input-error class="mt-2" :messages="$errors->get('payment_day')" />
        </div>


        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('Salvo.') }}
                </p>
            @endif
        </div>

    </form>
</section>
