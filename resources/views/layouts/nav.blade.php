<nav class="mt-3">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/dashboard" class="nav-link @if(request()->is('/') || request()->is('dashboard')) active @endif"">
                <i class="nav-icon fas fa-home"></i> <span class="menu-name">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/category" class="nav-link @if(request()->is('category*')) active @endif">
                <i class="nav-icon fa fa-th-large"></i> <span class="menu-name">Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/sub-category" class="nav-link @if(request()->is('sub-category*')) active @endif">
                <i class="nav-icon fa fa-th"></i> <span class="menu-name">Sub Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/product" class="nav-link @if(request()->is('product*')) active @endif">
                <i class="nav-icon fa fa-cube"></i> <span class="menu-name">Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/banner" class="nav-link @if(request()->is('banner*')) active @endif">
                <i class="nav-icon fa fa-image"></i> <span class="menu-name">Banners</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="/text-content" class="nav-link @if(request()->is('text-content*')) active @endif">
                <i class="nav-icon fa fa-file"></i> <span class="menu-name">Text Content</span>
            </a>
        </li>
    </ul>
</nav>
