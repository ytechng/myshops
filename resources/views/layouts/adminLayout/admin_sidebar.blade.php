<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/admin/dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-album"></i><span class="hide-menu">Banners </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-pill btn-danger float-right"> 2</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/admin/banners') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">View Banners </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/admin/banners/add') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Banner </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span class="hide-menu">Categories </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-pill btn-danger float-right"> 2</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/admin/categories') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">View Categories </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/admin/categories/add') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Category </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-basket"></i><span class="hide-menu">Products </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-pill btn-danger float-right"> 2</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/admin/products') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">View Products </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/admin/products/add') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Product </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-coin"></i><span class="hide-menu">Coupons </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-pill btn-danger float-right"> 2</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/admin/coupons') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">View Coupons </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/admin/coupons/add') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Coupon </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">Transaactions </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-pill btn-danger float-right"> 2</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/admin/transactions') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">View Transactions </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/admin/transactions/add') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Payment </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Customers </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-pill btn-danger float-right"> 2</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/admin/customers') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">View Customers </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/admin/customers/add') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Banner </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-library-books"></i><span class="hide-menu">Reports </span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-pill btn-danger float-right"> 2</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/admin/reports') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Customers Report </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/admin/reports/add') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu">Products Report </span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->