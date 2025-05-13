<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ __('Redefinir Senha') }}</h2>
        <p class="text-sm text-gray-600">
            {{ __('Digite sua nova senha abaixo.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" class="text-sm font-medium text-gray-700" />
            <x-text-input id="email" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" 
                type="email" 
                name="email" 
                :value="old('email', $request->email)" 
                required 
                autofocus 
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Nova Senha')" class="text-sm font-medium text-gray-700" />
            <x-text-input id="password" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="text-sm font-medium text-gray-700" />
            <x-text-input id="password_confirmation" 
                class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button class="w-full justify-center bg-primary-600 hover:bg-primary-700 focus:ring-primary-500">
                {{ __('Redefinir Senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
