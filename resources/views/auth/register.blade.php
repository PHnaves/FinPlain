<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary-3 text-base">
    <!-- Preloader Start -->
    <div class="preloader h-full fixed w-full z-50 bg-white transition duration-300">
        <img src="{{ asset('/images/Logo-FinPlain.png') }}" class="max-w-[20rem] block absolute top-2/4 left-2/4 transform -translate-x-2/4 -translate-y-2/4" alt="Logo">
    </div>
    <!-- Preloader End -->
    <div class="grid grid-cols-1 lg:grid-cols-5 lg:gap-6">
        <div class="bg-primary col-span-2 hidden lg:flex items-center justify-start p-4 lg:h-full bg-[url('{{ asset('assets/images/auth/auth-bg.png') }}')] bg-no-repeat bg-cover bg-center lg:pl-12 xxl:pl-36">
            <div class="content">
                <img class="max-w-full mb-6" src="{{ asset('/images/Cadastro.png') }}" alt="Imagem de fundo">
            </div>
        </div>
        <div class="col-span-3 px-4 py-12 lg:py-6 flex items-center justify-center">
            <div class="text-center w-full md:w-3/4 xxl:w-2/4">
                <div class="col-start-2 col-end-12 col-span-4">
                    <div class="mb-10">
                        <h1 class="text-3xl md:text-4xl text-primary font-bold mb-3">Criar Conta</h1>
                        <p class="text-base text-info">Veja seu crescimento e obtenha suporte de consultoria</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="w-full validation" novalidate>
                        @csrf
                        <div class="mb-5 text-left">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Seu nome" required autofocus>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-5 text-left">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="seuEmail@email.com" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-5 text-left">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="***********" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-5 text-left">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="***********" required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mb-5 text-left">
                            <label for="type_user" class="flex items-center gap-2">
                                Tipo de Usuário
                                <div class="relative group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info cursor-help" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="absolute left-0 mt-2 w-64 p-4 bg-white rounded-lg shadow-lg hidden group-hover:block z-50">
                                        <h4 class="font-bold mb-2">Tipos de Perfil de Investidor:</h4>
                                        <ul class="text-sm space-y-2">
                                            <li><span class="font-semibold">Conservador:</span> Prefere segurança e baixo risco, aceitando retornos menores.</li>
                                            <li><span class="font-semibold">Moderado:</span> Equilibra risco e retorno, aceitando alguma volatilidade.</li>
                                            <li><span class="font-semibold">Arrojado:</span> Busca maiores retornos, aceitando maior risco e volatilidade.</li>
                                        </ul>
                                    </div>
                                </div>
                            </label>
                            <select id="type_user" name="type_user" class="form-control" required>
                                <option value="" disabled selected>Selecione um tipo de usuário</option>
                                <option value="conservador">Conservador</option>
                                <option value="moderado">Moderado</option>
                                <option value="arrojado">Arrojado</option>
                            </select>
                            <x-input-error :messages="$errors->get('type_user')" class="mt-2" />
                        </div>

                        <div class="mb-5 text-left">
                            <label for="rent">Renda Atual</label>
                            <input type="number" class="form-control" id="rent" name="rent" placeholder="0.00" required>
                            <x-input-error :messages="$errors->get('rent')" class="mt-2" />
                        </div>

                        <div class="mb-5 text-left">
                            <label for="monthly_income">Salário Mensal</label>
                            <input type="number" step="0.01" class="form-control" id="monthly_income" name="monthly_income" placeholder="0.00" required>
                            <x-input-error :messages="$errors->get('monthly_income')" class="mt-2" />
                        </div>

                        <div class="mb-5 text-left">
                            <label for="payment_date">Dia do Pagamento</label>
                            <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                            <x-input-error :messages="$errors->get('payment_date')" class="mt-2" />
                        </div>

                        <div class="mb-5">
                            <label class="flex items-center mb-0">
                                <input type="checkbox" name="terms" class="mr-2 relative appearance-none rounded-std-1/2 border border-1 cursor-pointer border-info-1 checked:border-primary checked:bg-primary checked:after:content-['\2713'] checked:after:text-white checked:after:absolute checked:after:top-1/2 checked:after:left-1/2 checked:after:-translate-x-1/2 checked:after:-translate-y-1/2 h-4 w-4" required>
                                <span class="text-info">Eu aceito os <a href="#" class="text-primary hover:text-primary-1 transition-colors duration-500 font-bold">Termos de Serviço</a></span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-std border border-primary hover:bg-primary-1 transition-colors duration-500 mb-5">Criar Agora</button>

                        <p class="text-info font-semibold">Já tem uma conta? 
                            <a class="text-primary hover:text-primary-1 font-bold transition-colors duration-500" href="{{ route('login') }}">
                                Entrar
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
