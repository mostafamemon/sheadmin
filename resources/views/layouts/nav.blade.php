<nav class="mt-3">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/dashboard" class="nav-link">
                <i class="nav-icon fas fa-home"></i> <span class="menu-name">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/category" class="nav-link @if(request()->is('category*')) active @endif">
                <i class="nav-icon fas fa-network-wired"></i> <span class="menu-name">Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/product" class="nav-link @if(request()->is('product*')) active @endif">
                <i class="nav-icon fas fa-cubes"></i> <span class="menu-name">Product</span>
            </a>
        </li>
    </ul>
</nav>
