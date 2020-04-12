<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-fire"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-user"></i>
                    <span>Data Users</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('categories.index') }}"><i class="fas fa-tag"></i>
                    <span>Data Categories</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('books.index') }}"><i class="fas fa-book"></i>
                    <span>Data Books</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('orders.index') }}"><i class="fas fa-history"></i>
                    <span>Data Orders</span>
                </a>
            </li>
        </ul>

    </aside>
</div>
