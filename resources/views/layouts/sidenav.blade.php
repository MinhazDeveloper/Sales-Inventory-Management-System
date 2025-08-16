<aside class="sidenav">
        <nav class="d-flex flex-column gap-1">
            <a href="{{route('dashboard')}}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line icon"></i> <span>Dashboard</span>
            </a>
            <a href="{{route('categoryPage')}}" class="{{ request()->routeIs('categoryPage') ? 'active' : '' }}">
                <i class="fas fa-list-ul icon"></i> <span>Category</span>
            </a>
            <a href="{{route('productPage')}}" class="{{ request()->routeIs('productPage') ? 'active' : '' }}">
                <i class="fas fa-box icon"></i> <span>Product</span>
            </a>
            <a href="" >
                <i class="fas fa-cart-plus icon"></i> <span>Create Sale</span>
            </a>
            <a href="{{route('customerPage')}}" class="{{ request()->routeIs('customerPage') ? 'active' : '' }}">
                <i class="fas fa-user-friends icon"></i> <span>Customer</span>
            </a>
            <a href="{{route('invoiceCreate')}}" >
                <i class="fas fa-file-invoice-dollar icon"></i> <span>Invoice</span>
            </a>
            <a href="{{route('reportForm')}}" >
                <i class="fas fa-chart-bar icon"></i> <span>Report</span>
            </a>
        </nav>
    </aside>