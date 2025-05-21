    <!-- Navbar Mobile -->
    <nav class="md:hidden flex justify-between items-center px-4 py-3 bg-black shadow-sm fixed top-0 left-0 right-0 w-full h-16 z-[100]">
        <div class="flex items-center space-x-4">
            <button id="menuButton" class="p-2 hover:bg-gray-900 rounded-lg transition-colors duration-200">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <img src="{{ asset('/images/Logo-FinPlain.png')}}" class="h-12 w-12 object-contain" alt="Logo">
            <div class="text-lg font-semibold text-white">FinPlain</div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{route('notifications')}}" class="relative p-2 flex items-center hover:bg-gray-900 rounded-full transition-colors duration-200">
                <img src="{{ asset('/icons/bell.png') }}" class="h-6 w-6 object-contain brightness-0 invert" alt="Notificacao">
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
            <!-- Usuário Mobile (Dropdown) -->
            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 text-left p-2 hover:bg-gray-900 rounded-lg transition-colors duration-200">
                            <div class="h-8 w-8 rounded-full bg-primary-1 flex items-center justify-center text-white font-medium">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-gray-100">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-gray-100">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </nav>

    <!-- Navbar Desktop -->
    <nav class="hidden md:flex justify-between items-center px-8 py-4 bg-black shadow-sm fixed top-0 left-0 right-0 w-full h-16 z-[100]">
        <div class="flex items-center space-x-8">
            <img src="{{ asset('/images/Logo-FinPlain.png')}}" class="h-14 w-14 object-contain" alt="Logo">
            <div class="text-xl font-semibold text-white">FinPlain</div>
        </div>
        <div class="flex items-center space-x-6">
            <a href="{{route('notifications')}}" class="relative p-2 flex items-center hover:bg-gray-900 rounded-full transition-colors duration-200">
                <img src="{{ asset('/icons/bell.png') }}" class="h-6 w-6 object-contain brightness-0 invert" alt="Notificacao">
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
            <!-- Usuário Desktop (Dropdown) -->
            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-3 text-left px-3 py-2 hover:bg-gray-900 rounded-lg transition-colors duration-200">
                            <div class="h-8 w-8 rounded-full bg-primary-1 flex items-center justify-center text-white font-medium">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="font-medium text-white">{{ Auth::user()->name }}</span>
                                <span class="text-sm text-gray-300">Ver perfil</span>
                            </div>
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-gray-100">
                            Perfil
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-gray-100">
                                Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </nav>

    <!-- Sidebar Mobile -->
    <div id="mobileMenu" class="fixed inset-0 bg-black bg-opacity-50 z-[90] hidden">
        <div class="fixed inset-y-0 left-0 w-64 bg-black shadow-lg transform transition-transform duration-300 ease-in-out -translate-x-full">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between p-4 border-b border-gray-900">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('/images/Logo-FinPlain.png')}}" class="h-8 w-8 object-contain" alt="Logo">
                        <span class="text-lg font-semibold text-white">FinPlain</span>
                    </div>
                    <button id="closeMenu" class="p-2 hover:bg-gray-900 rounded-lg transition-colors duration-200">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto py-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
                        <img src="{{asset('/icons/home.png')}}" alt="dashboard" class="h-5 w-5 object-contain brightness-0 invert">
                        <span class="font-medium text-gray-200">Dashboard</span>
                    </a>
                    <a href="{{ route('despesas.index') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('despesas.index') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
                        <img src="{{asset('/icons/credit-card.png')}}" alt="despesa" class="h-5 w-5 object-contain brightness-0 invert">
                        <span class="font-medium text-gray-200">Transações</span>
                    </a>
                    <a href="{{ route('metas.index') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('metas.index') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
                        <img src="{{asset('/icons/check-square.png')}}" alt="meta" class="h-5 w-5 object-contain brightness-0 invert">
                        <span class="font-medium text-gray-200">Metas</span>
                    </a>
                    <a href="{{ route('investiments.index') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('investiments.index') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
                        <img src="{{asset('/icons/dollar-sign.png')}}" alt="investimentos" class="h-5 w-5 object-contain brightness-0 invert">
                        <span class="font-medium text-gray-200">Investimentos</span>
                    </a>
                    <a href="{{ route('records.index') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('records.index') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
                        <img src="{{asset('/icons/file-text.png')}}" alt="relatorios" class="h-5 w-5 object-contain brightness-0 invert">
                        <span class="font-medium text-gray-200">Relatórios</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Desktop -->
    <aside class="fixed top-16 left-0 hidden md:flex flex-col w-56 bg-black border-r border-gray-900 h-[calc(100vh-4rem)] pt-6 space-y-1">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
            <img src="{{asset('/icons/home.png')}}" alt="dashboard" class="h-5 w-5 object-contain brightness-0 invert">
            <span class="font-medium text-gray-200">Dashboard</span>
        </a>
        <a href="{{ route('despesas.index') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('despesas.index') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
            <img src="{{asset('/icons/credit-card.png')}}" alt="despesa" class="h-5 w-5 object-contain brightness-0 invert">
            <span class="font-medium text-gray-200">Transações</span>
        </a>
        <a href="{{ route('metas.index') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('metas.index') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
            <img src="{{asset('/icons/check-square.png')}}" alt="meta" class="h-5 w-5 object-contain brightness-0 invert">
            <span class="font-medium text-gray-200">Metas</span>
        </a>
        <a href="{{ route('investiments.index') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('investiments.index') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
            <img src="{{asset('/icons/dollar-sign.png')}}" alt="investimentos" class="h-5 w-5 object-contain brightness-0 invert">
            <span class="font-medium text-gray-200">Investimentos</span>
        </a>
        <a href="{{ route('records.index') }}" class="flex items-center space-x-4 hover:bg-gray-900 px-6 py-3 transition-colors duration-200 {{ request()->routeIs('records.index') ? 'bg-gray-900 border-r-4 border-primary-1' : '' }}">
            <img src="{{asset('/icons/file-text.png')}}" alt="relatorios" class="h-5 w-5 object-contain brightness-0 invert">
            <span class="font-medium text-gray-200">Relatórios</span>
        </a>
    </aside>

    <!-- Conteúdo Principal -->
    <div class="md:ml-72 md:mt-16 mt-16 min-h-screen bg-gray-50">
        <main class="p-4 md:p-6">
            {{ $slot }}
        </main>
    </div>

    <script>
    const menuButton = document.getElementById('menuButton');
    const closeMenu = document.getElementById('closeMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuContent = mobileMenu.querySelector('div');

    function openMobileMenu() {
        mobileMenu.classList.remove('hidden');
        setTimeout(() => {
            mobileMenuContent.classList.remove('-translate-x-full');
        }, 10);
    }

    function closeMobileMenu() {
        mobileMenuContent.classList.add('-translate-x-full');
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 300); // Duração da animação em ms
    }

    function toggleMobileMenu() {
        if (mobileMenu.classList.contains('hidden')) {
            openMobileMenu();
        } else {
            closeMobileMenu();
        }
    }

    menuButton?.addEventListener('click', toggleMobileMenu);
    closeMenu?.addEventListener('click', closeMobileMenu);

    // Fechar ao clicar fora
    mobileMenu?.addEventListener('click', (e) => {
        if (e.target === mobileMenu) {
            closeMobileMenu();
        }
    });

    // Fechar se redimensionar para desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) { // md: breakpoint
            closeMobileMenu();
        }
    });

    // Garante que o menu esteja fechado se já estiver em desktop ao carregar
    window.addEventListener('DOMContentLoaded', () => {
        if (window.innerWidth >= 1024) {
            mobileMenu.classList.add('hidden');
            mobileMenuContent.classList.add('-translate-x-full');
        }
    });
</script>
