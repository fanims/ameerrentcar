<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('dashboard') }}" class="brand-link">
    <span class="brand-text font-weight-light">
      <img height="60px" width="200px" style="mix-blend-mode: lighten;" src="{{ asset('assets/img/logo.png') }}" alt="">
    </span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Orders -->
        <li class="nav-item">
          <a href="{{ route('orders.index') }}"
            class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-shopping-cart"></i>
            @php
            use Illuminate\Support\Facades\DB;
            $unreadOrdersCount = DB::table('orders')->where('is_read', false)->count();
            @endphp
            <p>Bookings
              @if($unreadOrdersCount > 0)
              <span class="badge badge-info right">{{ $unreadOrdersCount }}</span>
              @endif
            </p>

          </a>
        </li>

        <!-- Booking Reports -->
        <li class="nav-item">
          <a href="{{ route('admin.reports.orders') }}"
            class="nav-link {{ request()->routeIs('admin.reports.orders') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Booking Reports</p>
          </a>
        </li>


        <!-- Category -->
        <li class="nav-item {{ request()->is('category*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('category*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Category
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('category.create') }}"
                class="nav-link {{ request()->routeIs('category.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category.index') }}"
                class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Categories</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Brand -->
        <li class="nav-item {{ request()->is('brand*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('brand*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-bold"></i>
            <p>
              Brands
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('brand.create') }}"
                class="nav-link {{ request()->routeIs('brand.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Brand</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('brand.index') }}"
                class="nav-link {{ request()->routeIs('brand.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Brands</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Cars -->
        <li class="nav-item {{ request()->is('cars*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('cars*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-car"></i>
            <p>
              Cars
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.general-price.edit') }}"
                class="nav-link {{ request()->routeIs('admin.general-price.edit') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>General</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cars.create') }}"
                class="nav-link {{ request()->routeIs('cars.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Car</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cars.index') }}"
                class="nav-link {{ request()->routeIs('cars.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Cars</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Car Types -->
        <li class="nav-item {{ request()->is('car-types*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('car-types*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Car Types
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('car-types.create') }}"
                class="nav-link {{ request()->routeIs('car-types.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Car Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('car-types.index') }}"
                class="nav-link {{ request()->routeIs('car-types.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Car Types</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            @php
            $unreadUsersCount = DB::table('users')->where('is_read', false)->count();
            @endphp

            <p>Users
              @if($unreadUsersCount > 0)
              <span class="badge badge-info right">{{ $unreadUsersCount }}</span>
              @endif
            </p>
          </a>
        </li>

        <!-- Coupons -->
        <li class="nav-item {{ request()->is('admin/coupons*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('admin/coupons*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Coupons
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('coupons.create') }}"
                class="nav-link {{ request()->routeIs('coupons.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Coupon</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('coupons.index') }}"
                class="nav-link {{ request()->routeIs('coupons.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Coupons</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Sliders -->
        <li class="nav-item {{ request()->is('slider*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ request()->is('slider*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-images"></i>
            <p>
              Sliders
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('slider.create') }}"
                class="nav-link {{ request()->routeIs('slider.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Slider</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('slider.index') }}"
                class="nav-link {{ request()->routeIs('slider.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Sliders</p>
              </a>
            </li>
          </ul>
        </li>


        <!-- Settings -->
        <li class="nav-item {{ request()->is('languages*') || request()->is('currencies*') ? 'menu-open' : '' }}">
          <a href="#"
            class="nav-link {{ request()->is('languages*') || request()->is('currencies*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('languages.index') }}"
                class="nav-link {{ request()->routeIs('languages.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Languages</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ route('currencies.index') }}"
                class="nav-link {{ request()->routeIs('currencies.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Currency</p>
              </a>
            </li> --}}

            <li class="nav-item">
              <a href="{{ route('social.create') }}"
                class="nav-link {{ request()->routeIs('social.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Social</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('website.create') }}"
                class="nav-link {{ request()->routeIs('website.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Website Setting</p>
              </a>
            </li>
          </ul>
        </li>


        <!-- Contact -->
        {{-- <li class="nav-item">
          <a href="{{ route('contact.index') }}"
            class="nav-link {{ request()->routeIs('contact.index') ? 'active' : '' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>Contact Messages</p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="{{ route('subscribers.index') }}" class="nav-link">
            <i class="nav-icon fas fa-envelope"></i>
            <p>Subscribers</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>