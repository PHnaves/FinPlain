<!-- Sidebar Principal -->
<aside class="fixed top-0 left-0 h-screen w-64 bg-primary-2 shadow-xl z-[100] transition-all duration-300 transform -translate-x-full md:translate-x-0" id="sidebar">
    <!-- Logo e Nome -->
    <div class="flex items-center space-x-3 p-6 border-b border-white/10">
        <div class="relative group">
            <img src="{{ asset('/images/Logo-FinPlan.png')}}" class="h-20 w-20 object-contain transition-transform duration-300 group-hover:scale-110" alt="Logo">
            <div class="absolute inset-0 bg-white/20 rounded-full blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
        <span class="text-xl font-bold text-white">FinPlan</span>
    </div>

    <!-- Menu de Navegação -->
    <nav class="p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <img src="{{ asset('icons/home.png') }}" alt="" class="w-5 h-5">
            <span class="font-medium">Dashboard</span>
        </a>
        <a href="{{ route('despesas.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('despesas.index') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <img src="{{ asset('icons/credit-card.png') }}" alt="" class="w-5 h-5">
            <span class="font-medium">Transações</span>
        </a>
        <a href="{{ route('ganhos.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('ganhos.index') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <img src="{{ asset('icons/dollar-sign.png') }}" alt="" class="w-5 h-5">
            <span class="font-medium">Ganhos</span>
        </a>
        <a href="{{ route('metas.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('metas.index') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <img src="{{ asset('icons/check-square.png') }}" alt="" class="w-5 h-5">
            <span class="font-medium">Metas</span>
        </a>
        <a href="{{ route('records.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('records.index') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <img src="{{ asset('icons/file-text.png') }}" alt="" class="w-5 h-5">
            <span class="font-medium">Relatórios</span>
        </a>
        <a href="{{ route('investiments.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('investiments.index') ? 'bg-white/20' : 'hover:bg-white/10' }}">
            <img src="{{ asset('icons/dollar-sign.png') }}" alt="" class="w-5 h-5">
            <span class="font-medium">Investimentos</span>
        </a>
    </nav>
</aside>

<!-- Navbar Superior -->
<nav class="top-0 right-0 left-0 md:left-64 h-16 px-4 flex items-center justify-between md:justify-end space-x-4">
    <!-- Menu Hambúrguer (Mobile) -->
    <button onclick="toggleSidebar()" class="md:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div class="flex items-center space-x-4">
        <!-- Notificações -->
        <a href="{{route('notifications')}}" class="relative p-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200">
            <img src="{{ asset('/icons/bell.png')}}" alt="" class="h-6 w-6 rounded-full filter brightness-0">
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </a>

        <!-- Perfil do Usuário -->
        <div class="relative">
            <button onclick="document.getElementById('userMenu').classList.toggle('hidden')" class="flex items-center space-x-3 text-gray-700 hover:bg-gray-100 px-3 py-2 rounded-lg transition-colors duration-200">
                <div class="h-8 w-8 rounded-full bg-primary-1 flex items-center justify-center text-white font-medium">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="font-medium">{{ Auth::user()->name }}</span>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 z-50">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
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
        const hamburgerButton = document.querySelector('button.md\\:hidden');
        
        if (!hamburger && !sidebar.contains(event.target) && hamburgerButton && !hamburgerButton.classList.contains('hidden')) {
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>