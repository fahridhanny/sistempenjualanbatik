<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="/dashboard">
                    <i class="fa fa-fw fa-home"></i> <span style="margin-left: 3px;">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('product') ? 'active' : '' }}">
                <a href="/product">
                    <i class="fa fa-fw fa-tags"></i> <span style="margin-left: 3px;">Product</span>
                </a>
            </li>
            <li class="{{ request()->is('user') ? 'active' : '' }}">
                <a href="/user">
                    <i class="fa fa-fw fa-users"></i> <span style="margin-left: 3px;">User</span>
                </a>
            </li>
            <li class="{{ request()->is('profile/admin') ? 'active' : '' }}">
                <a href="/profile/admin">
                    <i class="fa fa-fw fa-user"></i> <span style="margin-left: 3px;">Profile</span>
                </a>
            </li>
            <li class="{{ request()->is('logout') ? 'active' : '' }}">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="single-icon">
                    <i class="fas fa-sign-out-alt"></i> <span style="margin-left: 8px;"> Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>