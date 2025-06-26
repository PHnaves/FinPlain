<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="index, follow">
    <meta name="og:title" property="og:title" content="FinPlan - Sua Plataforma de Gestão Financeira">
	<meta property="og:image" content="https://designtocodes.com/wp-content/uploads/2023/12/DataAI-Free-Data-Analytics-Tailwind-CSS-Dashboard-Template.jpg">
	<meta name="og:description" content="FinPlan é uma plataforma profissional e amigável para gestão financeira. Comece a organizar suas finanças agora!">
    <!-- Favicons -->
    <link rel="app-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site-webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}">
    <title>FinPlan</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="../public/lib/fontawesome/css/all.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(45deg, #11999E, #0D7A7E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: #F5F7F8;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .hero-gradient {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .btn-gradient {
            background: linear-gradient(45deg, #11999E, #0D7A7E);
            transition: transform 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
        }
        .hamburger-menu {
            display: none;
            cursor: pointer;
            padding: 0.5rem;
        }
        .hamburger-menu span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px 0;
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .desktop-menu {
                display: none !important;
            }
            .hamburger-menu {
                display: block !important;
            }
        }
        @media (min-width: 769px) {
            .desktop-menu {
                display: flex !important;
            }
            .hamburger-menu {
                display: none !important;
            }
        }
    </style>
</head>

<body class="landing">
    <!-- Preloader Start -->
    <div class="preloader h-screen fixed w-full z-50 bg-[#0A5B5E] transition duration-300">
        <img src="{{ asset('/images/Logo-FinPlan.png')}}" class="max-w-[20rem] block absolute top-2/4 left-2/4 transform -translate-x-2/4 -translate-y-2/4" alt="Logo">
    </div>
    <!-- Preloader End -->

    <!-- Header -->
    <header class="bg-[#0A5B5E] sticky top-0 w-full z-40 shadow-sm hidden" id="mainHeader">
        <nav class="py-2">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ asset('/images/Logo-FinPlan.png')}}" class="w-16 md:w-20" alt="Logo FinPlan">
                    </div>

                    <div class="flex items-center">
                        <div class="desktop-menu items-center space-x-4 md:space-x-6">
                            <a href="#home" class="nav-link text-white hover:text-primary-3 text-sm font-medium hidden md:inline-block">Início</a>
                            <a href="#sobre" class="nav-link text-white hover:text-primary-3 text-sm font-medium hidden md:inline-block">Sobre</a>
                            <a href="#precos" class="nav-link text-white hover:text-primary-3 text-sm font-medium hidden md:inline-block">Planos</a>
                            <a href="#contato" class="nav-link text-white hover:text-primary-3 text-sm font-medium hidden md:inline-block">Contato</a>
                            <a href="{{route('login')}}" class="bg-primary hover:bg-primary-1 text-white px-4 md:px-5 py-1.5 rounded-full text-sm font-semibold shadow-lg transition-colors duration-300 hidden md:inline-block">Começar Agora</a>
                        </div>
                        <button class="md:hidden text-white p-2 ml-4" id="navToggler">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Navigation -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" id="mobileNavOverlay"></div>
    <div class="fixed right-0 top-0 h-full w-[280px] bg-[#0A5B5E] shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50" id="mobileNav">
        <div class="p-6">
            <div class="flex justify-between items-center mb-8">
                <img src="{{ asset('/images/Logo-FinPlan.png')}}" class="w-16" alt="Logo FinPlan">
                <button class="text-white hover:text-primary-3 transition-colors duration-300 p-2" id="navCloser">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <nav class="space-y-6">
                <a href="#home" class="nav-link block text-white hover:text-primary-3 text-base font-medium py-2">Início</a>
                <a href="#sobre" class="nav-link block text-white hover:text-primary-3 text-base font-medium py-2">Sobre</a>
                <a href="#precos" class="nav-link block text-white hover:text-primary-3 text-base font-medium py-2">Planos</a>
                <a href="#contato" class="nav-link block text-white hover:text-primary-3 text-base font-medium py-2">Contato</a>
                <a href="{{route('login')}}" class="bg-primary hover:bg-primary-1 text-white px-6 py-2.5 rounded-full text-base font-semibold shadow-lg inline-block transition-colors duration-300 w-full text-center md:hidden">Começar Agora</a>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-white to-gray-50 py-20 pt-32 md:py-32 relative overflow-hidden" id="home" style="margin-top: 0; z-index: 0;">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight text-gray-900">
                        Organize suas finanças com
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-primary-1">FinPlan</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-700 mb-8 leading-relaxed">
                        A plataforma completa para gerenciar suas finanças pessoais e empresariais de forma simples e eficiente.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{route('login')}}" class="bg-primary hover:bg-primary-1 text-white px-8 py-4 rounded-full font-semibold shadow-lg w-full sm:w-auto text-center transition-all duration-300 transform hover:scale-105">
                            Começar Gratuitamente
                        </a>
                        <a href="#sobre" class="text-gray-900 hover:text-primary font-medium flex items-center group">
                            <i class="fas fa-play-circle mr-2 group-hover:animate-bounce"></i>
                            Saiba mais
                        </a>
                    </div>
                </div>
                <div class="relative" style="z-index: 0;">
                    <div class="relative transform hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('/images/Hero-Section.png') }}" alt="Dashboard FinPlan" class="w-full rounded-2xl shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 pt-32 bg-gray-50" id="sobre">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Por que escolher a FinPlan?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Nossa plataforma oferece todas as ferramentas necessárias para você controlar suas finanças de forma eficiente e segura.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1: Análise -->
                <div class="bg-white p-10 rounded-xl shadow-lg card-hover">
                    <div class="mb-8">
                        <img src="{{ asset('/images/Imagem-Welcome1.png') }}" alt="Análise Financeira" class="w-full h-64 object-cover rounded-lg">
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Visualize Seus Dados</h3>
                    <p class="text-gray-600 text-lg">Transforme números em insights com painéis intuitivos e relatórios fáceis de entender.</p>
                </div>

                <!-- Card 2: Metas -->
                <div class="bg-white p-10 rounded-xl shadow-lg card-hover">
                    <div class="mb-8">
                        <img src="{{ asset('/images/Imagem-Welcome2.png') }}" alt="Metas Financeiras" class="w-full h-64 object-cover rounded-lg">
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Alcance Seus Objetivos</h3>
                    <p class="text-gray-600 text-lg">Monitore seu progresso e mantenha o foco nas metas que importam para sua vida financeira.</p>
                </div>

                <!-- Card 3: Segurança -->
                <div class="bg-white p-10 rounded-xl shadow-lg card-hover">
                    <div class="mb-8">
                        <img src="{{ asset('/images/Imagem-Welcome3.png') }}" alt="Segurança Financeira" class="w-full h-64 object-cover rounded-lg">
                    </div>
                    <h3 class="text-2xl font-semibold mb-4">Proteção em Primeiro Lugar</h3>
                    <p class="text-gray-600 text-lg">Tenha tranquilidade com tecnologia de ponta cuidando da privacidade dos seus dados.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-20 pt-32" id="precos">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Planos que cabem no seu bolso</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Escolha o plano ideal para suas necessidades financeiras
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Free Plan -->
                <div class="bg-white rounded-2xl shadow-lg p-8 card-hover">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">Plano Gratuito</h3>
                        <p class="text-gray-600">Perfeito para começar</p>
                    </div>
                    <div class="text-center mb-8">
                        <span class="text-5xl font-bold">R$0</span>
                        <span class="text-gray-600">/mês</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Controle de gastos básico</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Até 3 metas criadas consecutivamente</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>5 Relatórios mensais</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>10 Transações financeiras</span>
                        </li>
                    </ul>
                    <a href="{{route('login')}}" class="block text-center bg-gray-100 text-gray-800 hover:bg-gray-200 font-semibold py-3 px-6 rounded-full transition-colors duration-300">
                        Começar Agora
                    </a>
                </div>
                <!-- Premium Plan -->
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl shadow-lg p-8 card-hover text-white">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">Plano Premium</h3>
                        <p class="text-indigo-100">Para quem quer mais</p>
                    </div>
                    <div class="text-center mb-8">
                        <span class="text-5xl font-bold">R$29,90</span>
                        <span class="text-indigo-100">/mês</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check text-white mr-3"></i>
                            <span>Todas as features do plano gratuito</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-white mr-3"></i>
                            <span>Contas ilimitadas</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-white mr-3"></i>
                            <span>Relatórios ilimitados</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-white mr-3"></i>
                            <span>Suporte prioritário</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-white mr-3"></i>
                            <span>Metas financeiras ilimitadas</span>
                        </li>
                    </ul>
                    <a href="{{route('login')}}" class="block text-center bg-white text-indigo-600 hover:bg-indigo-50 font-semibold py-3 px-6 rounded-full transition-colors duration-300">
                        Assinar Agora
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 pt-32 bg-gray-50" id="contato">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Entre em Contato</h2>
                    <p class="text-lg text-gray-600">
                        Estamos aqui para ajudar você a começar sua jornada de gestão financeira.
                    </p>
                </div>
                <form class="bg-white rounded-2xl shadow-lg p-8" method="POST" action="{{ route('contato.store') }}">
                    @csrf
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="firstName">Nome</label>
                            <input type="text" id="firstName" name="firstNameContact" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-300" placeholder="Seu nome">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="lastname">Sobrenome</label>
                            <input type="text" id="lastname" name="lastnameContact" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-300" placeholder="Seu sobrenome">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                            <input type="email" id="email" name="emailContact" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-300" placeholder="seu@email.com">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2" for="phone">Telefone</label>
                            <input type="tel" id="phone" name="phoneContact" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-300" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2" for="message">Mensagem</label>
                        <textarea id="message" name="messageContact" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-300" placeholder="Digite sua mensagem"></textarea>
                    </div>
                    <button type="submit" class="btn-gradient text-white w-full py-3 rounded-lg font-semibold shadow-lg">
                        Enviar Mensagem
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#0A5B5E] text-white py-12 pt-32">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    {{-- <img src="{{ asset('/images/Logo-FinPlan.png')}}" class="w-24 mb-4" alt="Logo FinPlan"> --}}
                    <h3 class="text-sm font-semibold mb-4">FinPlan</h3>
                    <p class="text-gray-300 text-sm mb-4 pr-32">
                        Simplifique sua vida financeira com a FinPlan. A plataforma completa para gerenciar suas finanças pessoais e empresariais.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold mb-4">Links Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-300 hover:text-white text-sm transition-colors duration-300">Início</a></li>
                        <li><a href="#sobre" class="text-gray-300 hover:text-white text-sm transition-colors duration-300">Sobre</a></li>
                        <li><a href="#precos" class="text-gray-300 hover:text-white text-sm transition-colors duration-300">Planos</a></li>
                        <li><a href="#contato" class="text-gray-300 hover:text-white text-sm transition-colors duration-300">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold mb-4">Legal</h3>
                    <ul class="space-y-2">
                        <li><a href="{{route('termos.politicaPrivacidade')}}" class="text-gray-300 hover:text-white text-sm transition-colors duration-300">Política de Privacidade</a></li>
                        <li><a href="{{route('termos.termosServico')}}" class="text-gray-300 hover:text-white text-sm transition-colors duration-300">Termos de Serviço</a></li>
                        <li><a href="{{route('termos.termosUso')}}" class="text-gray-300 hover:text-white text-sm transition-colors duration-300">Termos de Uso</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-400 pt-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <p class="text-gray-300 text-sm mb-4 md:mb-0">© 2024 FinPlan. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navToggler = document.getElementById('navToggler');
            const navCloser = document.getElementById('navCloser');
            const mobileNav = document.getElementById('mobileNav');
            const mobileNavOverlay = document.getElementById('mobileNavOverlay');

            function openMobileNav() {
                mobileNav.classList.remove('translate-x-full');
                mobileNavOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeMobileNav() {
                mobileNav.classList.add('translate-x-full');
                mobileNavOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }

            navToggler?.addEventListener('click', openMobileNav);
            navCloser?.addEventListener('click', closeMobileNav);
            mobileNavOverlay?.addEventListener('click', closeMobileNav);

            const mobileLinks = mobileNav.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', closeMobileNav);
            });

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.querySelector('.preloader');
            const mainHeader = document.getElementById('mainHeader');
            
            setTimeout(function() {
                preloader.style.opacity = '0';
                preloader.style.visibility = 'hidden';
                mainHeader.classList.remove('hidden');
            }, 1000);
        });

        // Fechar o menu quando clicar fora
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('userMenu');
            const button = event.target.closest('button');
            if (!button && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        // Função para alternar a sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Fechar a sidebar quando clicar fora em telas móveis
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = event.target.closest('button');
            if (!hamburger && !sidebar.contains(event.target) && window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>

</html>