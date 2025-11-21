<header>
    <h1 style="text-align: center;">My Personal Website</h1>
</header>

<nav>
    <ul>
        <li class="{{ request()->routeIs('beranda') ? 'active' : '' }}">
            <a href="{{ route('beranda') }}">Beranda</a>
        </li>
        <li class="{{ request()->routeIs('datadiri') ? 'active' : '' }}">
            <a href="{{ route('datadiri') }}">Data Diri</a>
        </li>
        <li class="{{ request()->routeIs('aktivitas.index') ? 'active' : '' }}">
            <a href="{{ route('aktivitas.index') }}">Aktivitas</a>
        </li>
        <li class="{{ request()->routeIs('kontak') ? 'active' : '' }}">
            <a href="{{ route('kontak') }}">Kontak</a>
        </li>
    </ul>
</nav>

<style>
    nav {
        background-color: #333;
        padding: 10px;
    }
    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }
    nav ul li {
        margin-right: 20px;
    }
    nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    nav ul li.active a {
        text-decoration: underline;
    }
</style>
