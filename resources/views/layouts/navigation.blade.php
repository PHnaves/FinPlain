    <!-- Navbar Desktop -->
    <nav class="hidden sm:flex justify-between items-center p-2 bg-primary-1 text-white border-b border-primary-1 fixed w-full h-16 z-10">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('/images/Logo-FinPlain.png')}}" class="h-12 w-12" alt="Logo">
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{route('notifications')}}" class="p-2 flex items-center hover:bg-primary-2 rounded-md">
                <img src="{{ asset('/icons/bell.png') }}" class="h-5 w-auto" alt="Notificacao">
                <span>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="text-red text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </span>
            </a>
            <!-- Usuário (Dropdown) -->
            <div class="mt-auto">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center justify-between w-full text-left px-4 py-2 hover:bg-primary-2 rounded-md">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </nav>

    <!-- Sidebar Desktop -->
    <aside class="fixed top-16 left-0 hidden sm:flex flex-col w-64 bg-primary-1 text-white border-r border-primary-2 h-full pt-8 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 hover:bg-primary-2 px-4 py-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-primary-2' : '' }}">
        <img src="{{asset('/icons/home.png')}}" alt="dashboard">
        </a>
        <a href="{{ route('despesas.index') }}" class="flex items-center space-x-3 hover:bg-primary-2 px-4 py-2 rounded-md {{ request()->routeIs('despesas.index') ? 'bg-primary-2' : '' }}">
            <img src="{{asset('/icons/credit-card.png')}}" alt="despesa">
        </a>
        <a href="{{ route('metas.index') }}" class="flex items-center space-x-3 hover:bg-primary-2 px-4 py-2 rounded-md {{ request()->routeIs('metas.index') ? 'bg-primary-2' : '' }}">
            <img src="{{asset('/icons/check-square.png')}}" alt="meta">
        </a>
        <a href="{{ route('investiments.index') }}" class="flex items-center space-x-3 hover:bg-primary-2 px-4 py-2 rounded-md {{ request()->routeIs('investiments.index') ? 'bg-primary-2' : '' }}">
            <img src="{{asset('/icons/dollar-sign.png')}}" alt="investimentos">
        </a>
    </aside>