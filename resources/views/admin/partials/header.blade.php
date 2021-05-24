<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('adminlte/dist/img/logoo.jpg')}}" alt="FoodOrder Admin" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">FoodOrder Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/dist/img/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">@auth
            {{ Auth::user()->name }}
          @endauth</a>
          @auth
          <div aria-labelledby="navbarDropdown">
            <a class="btn btn-danger" href="{{ route('admin.getLogout') }}">
                {{ __('Logout') }}
            </a>
        </div>
          @endauth
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="/admin" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                   Dashboard
                  </p>
                </a>
              </li>
          <li class="nav-item">
            <a href="{{ route('admin.category.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('admin.category_manaage')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.menu.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('admin.menu_manage')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.product.index') }}" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                @lang('admin.product_manage')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.slide.index') }}" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                @lang('admin.slider_manage')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.setting.index') }}" class="nav-link">
                <i class="nav-icon fas fa-sliders-h"></i>
              <p>
                @lang('admin.setting_manage')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
              <p>
               @lang('admin.user_manage')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.role.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
              <p>
               @lang('admin.role_manage')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.per.create') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
              <p>
               @lang('admin.permission')
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.table.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
              <p>
              Table Manage
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.order.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
              <p>
              Orders Manage
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.reservation.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
              <p>
              Reservation Table Manage
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.voucher.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Voucher Manage
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.page.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Page Manage
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.chart') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Chart
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
