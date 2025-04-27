<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
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
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Type User -->
        <div class="mt-4">
            <x-input-label for="type_user" :value="__('Tipo de Usuário')" />
            <select id="type_user" name="type_user" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="" disabled {{ old('type_user', $user->type_user) == null ? 'selected' : '' }}>Selecione um tipo de usuário</option>
                <option value="conservador" {{ old('type_user', $user->type_user) == 'conservador' ? 'selected' : '' }}>Conservador</option>
                <option value="moderado" {{ old('type_user', $user->type_user) == 'moderado' ? 'selected' : '' }}>Moderado</option>
                <option value="arrojado" {{ old('type_user', $user->type_user) == 'arrojado' ? 'selected' : '' }}>Arrojado</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('type_user')" />
        </div>

        <!-- Input Rent -->
        <div class="mt-4">
            <x-input-label for="rent" :value="__('Renda Atual')" />
            <x-text-input id="rent" class="block mt-1 w-full" type="number" name="rent" :value="old('rent', $user->rent)" required />
            <x-input-error class="mt-2" :messages="$errors->get('rent')" />
        </div>

        <!-- Monthly Income -->
        <div class="mt-4">
            <x-input-label for="monthly_income" :value="__('Salário Mensal (R$)')" />
            <x-text-input id="monthly_income" name="monthly_income" type="number" step="0.01" class="mt-1 block w-full" :value="old('monthly_income', $user->monthly_income)" required />
            <x-input-error class="mt-2" :messages="$errors->get('monthly_income')" />
        </div>

        <!-- Payment Date -->
        <div class="mt-4">
            <x-input-label for="payment_date" :value="__('Dia do Pagamento')" />
            <x-text-input id="payment_date" name="payment_date" type="date" class="mt-1 block w-full" :value="old('payment_date', $user->payment_date)" required />
            <x-input-error class="mt-2" :messages="$errors->get('payment_date')" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>

    </form>
</section>
