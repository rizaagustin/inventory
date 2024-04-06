<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
      </div>
      @can('dashboard-index')
      <ul class="sidebar-menu" data-widget="tree">
          <li class="header">DASHBOARD</li>
          <li><a href="{{ route('home') }}"><i class="fa fa-dashboard text-purple"></i><span>Dashboard</span></a></li>            
      </ul>
      @endcan
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">DATA MASTER</li>
        @can('supplier-index')
            <li><a href="{{ route('supplier.index') }}"><i class="fa fa-users text-purple"></i><span>Supplier</span></a></li>
        @endcan
        @can('customer-index')        
            <li><a href="{{ route('customer.index') }}"><i class="fa fa-users text-purple"></i><span>Customer</span></a></li>
        @endcan
        @can('product-index')
            <li><a href="{{ route('product.index') }}"><i class="fa fa-inbox text-purple"></i><span>Product</span></a></li>            
        @endcan
      </ul>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">TRANSACTION</li>
        @can('productin-index')
            <li><a href="{{ route('productin.index') }}"><i class="fa fa-truck text-purple"></i> <span>Transaction In</span></a></li>            
        @endcan
        @can('productout-index')
            <li><a href="{{ route('productout.index') }}"><i class="fa fa-truck text-purple"></i> <span>Transaction Out</span></a></li>            
        @endcan
      </ul>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">SETTING</li>
        @can('permission-index')
            <li><a href="{{ route('permission.index') }}"><i class="fa fa-gears text-purple"></i><span>Permission</span></a></li>
        @endcan
        @can('role-index')
            <li><a href="{{ route('role.index') }}"><i class="fa fa-gears text-purple"></i> <span>Role</span></a></li>
        @endcan
        @can('user-index')
            <li><a href="{{ route('user.index') }}"><i class="fa fa-user text-purple"></i> <span>User</span></a></li>
        @endcan
      </ul>
    </section>
  </aside>