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
        <img src="{{ asset('assets/images/logo/logo.png') }}" class="max-w-[20rem] block absolute top-2/4 left-2/4 transform -translate-x-2/4 -translate-y-2/4" alt="Logo">
    </div>
    <!-- Preloader End -->
    <div class="grid grid-cols-1 lg:grid-cols-5 lg:gap-6">
        <div class="bg-primary col-span-2 hidden lg:flex items-center justify-start p-4 lg:h-screen bg-[url('{{ asset('assets/images/auth/auth-bg.png') }}')] bg-no-repeat bg-cover bg-center lg:pl-12 xxl:pl-36">
            <div class="content">
                <img class="max-w-[16rem] mb-6" src="{{ asset('assets/images/logo/logo_white_1.png') }}" alt="Logo">
                <h4 class="text-white md:text-3xl xl:text-[42px] font-bold capitalize leading-[52px]">Join Our Community</h4>
            </div>
        </div>
        <div class="col-span-3 px-4 py-12 lg:py-6 flex items-center justify-center">
            <div class="text-center w-full md:w-3/4 xxl:w-2/4">
                <div class="col-start-2 col-end-12 col-span-4">
                    <div class="mb-10">
                        <h1 class="text-3xl md:text-4xl text-primary font-bold mb-3">Create an Account</h1>
                        <p class="text-base text-info">See your growth and get consulting support</p>
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
                            <input type="email" class="form-control" id="email" name="email" placeholder="seu@email.com" required>
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
                            <label for="type_user">Tipo de Usuário</label>
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
                                <span class="text-info">I accept the <a href="#" class="text-primary font-bold">Terms of Service</a></span>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-std border border-primary hover:bg-primary-1 hover:text-primary transition-colors duration-500 mb-5">Create Now</button>

                        <p class="text-info font-semibold">Already have an account? 
                            <a class="text-primary hover:text-info-1 font-bold transition-colors duration-500" href="{{ route('login') }}">
                                Log In
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
