<nav class="navbar navbar-expand navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">TiketWar</a>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"  href="{{ route('home') }}">Beranda</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('konser.*') ? 'active' : '' }}" href="{{ route('konser.index') }}">Konser</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" href="{{route('pesanan.index') }}">Pesanan</a>
            </li> 

            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a>
            </li> 
        </ul>

        <ul class="navbar-nav ms-auto"> {{-- BARU --}}
            @auth {{-- BARU --}}
            <li class="nav-item d-flex align-items-center me-2"> {{-- BARU --}}
                <span class="navbar-text">{{ auth()->user()->name }}</span> {{-- BARU --}}
            </li> {{-- BARU --}}
            <li class="nav-item"> {{-- BARU --}}
                <form action="{{ route('logout') }}" method="POST"> {{-- BARU --}}
                @csrf {{-- BARU --}}
                <button type="submit" 
                class="btn btn-sm btn-outline-secondary">Keluar</button> {{-- BARU --}}
                </form> {{-- BARU --}}
            </li> {{-- BARU --}}
            @endauth {{-- BARU --}}
                @guest {{-- BARU --}}
                <li class="nav-item"><a class="nav-link" 
                href="{{ route('login') }}">Login Admin</a></li> {{-- BARU --}}
            @endguest 
        </ul> 
    </div>
</nav>