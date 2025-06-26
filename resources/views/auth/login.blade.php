<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FinPlan | Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary-3 text-base">
    <!-- Preloader Start -->
    <div class="preloader h-full fixed w-full z-50 bg-white transition duration-300">
        <img src="{{ asset('/images/Logo-FinPlan.png') }}" class="max-w-[20rem] block absolute top-2/4 left-2/4 transform -translate-x-2/4 -translate-y-2/4" alt="Logo">
    </div>
    <!-- Preloader End -->
    <div class="grid grid-cols-1 lg:grid-cols-5 lg:gap-6">
        <div class="bg-primary col-span-2 hidden lg:flex items-center justify-start p-4 lg:h-screen bg-[url('{{ asset('assets/images/auth/auth-bg.png') }}')] bg-no-repeat bg-cover bg-center lg:pl-12 xxl:pl-36">
            <div class="content">
                <img class="max-w-full mb-6" src="{{ asset('/images/Login.png') }}" alt="Imagem de fundo">
            </div>
        </div>
        <div class="col-span-3 px-4 py-12 lg:py-6 flex items-center justify-center">
            <div class="text-center w-full md:w-3/4 xxl:w-2/4">
                <div class="col-start-2 col-end-12 col-span-4">
                    <div class="mb-10">
                        <h1 class="text-3xl md:text-4xl text-primary font-bold mb-3">Acessar sua conta</h1>
                        <p class="text-base text-info">Bem-vindo de volta!</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="w-full validation" novalidate>
                        @csrf
                        <div class="mb-5 text-left">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="email@mail.com" required autofocus>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-4 text-left">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="***********" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="mb-5">
                            <label class="flex items-center mb-0">
                                <input type="checkbox" name="remember" class="mr-2 relative appearance-none rounded-std-1/2 border border-1 cursor-pointer border-info-1 checked:border-primary checked:bg-primary checked:after:content-['\2713'] checked:after:text-white checked:after:absolute checked:after:top-1/2 checked:after:left-1/2 checked:after:-translate-x-1/2 checked:after:-translate-y-1/2 h-4 w-4">
                                <span class="text-info">Remember me</span>
                            </label>
                        </div>
                        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-std border border-primary hover:bg-primary-1 transition-colors duration-500 mb-5">Entrar</button>

                        @if (Route::has('password.request'))
                            <p class="text-info font-semibold">
                                <a class="text-primary hover:text-primary-1 font-bold transition-colors duration-500" href="{{ route('password.request') }}">
                                    Esqueceu sua senha?
                                </a>
                            </p>
                        @endif

                        <p class="text-info font-semibold mt-4">Não possui uma conta? 
                            <a class="text-primary hover:text-primary-1 font-bold transition-colors duration-500" href="{{ route('register') }}">
                                Criar
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
