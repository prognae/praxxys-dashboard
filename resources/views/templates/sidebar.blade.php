<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index3.html" class="brand-link" style="text-align: center">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/user-image/user-icon.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        
                        <p>
                            Product Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/products" class="nav-link">
                                <p>Product List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/products/create" class="nav-link">
                                <p>Create Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link">
                        
                        <p>
                            Account
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/profile" class="nav-link">
                                <p>Edit Profile</p>
                            </a>
                        </li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <li class="nav-item">
                                <a onclick="event.preventDefault();
                                    this.closest('form').submit();" 
                                    href="/logout" class="nav-link">
                                    <p>Logout</p>
                                </a>
                            </li>
                        </form>
                        
                    </ul>
                </li>
                
            </ul>
        </nav>

    </div>

</aside>