<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Stylesheets -->
    <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/css/icon.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/css/ar.css" rel="stylesheet" class="lang_css arabic">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (necessary for Select2 to work) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row header_section">
            <!-- Logo and Menu Toggle -->
            <div class="col-sm-3 col-xs-12 logo_area bring_right">
                <h1 class="inline-block">لوحة تحكم</h1>
                <span class="glyphicon glyphicon-menu-hamburger bring_left open_close_menu" data-toggle="tooltip"
                    data-placement="right" title="فتح/إغلاق القائمة"></span>
            </div>
        </div>
        <!-- End Header Section -->

        <!-- Sidebar -->
        <div class="main_sidebar bring_right">
            <div class="main_sidebar_wrapper">
                <form class="form-inline search_box text-center">
                    <div class="form-group">
                        <!-- Search box (if needed) -->
                    </div>
                </form>
                <ul>
                    <!-- Link to Merchants -->
                    <li><span class="glyphicon glyphicon-user"></span><a
                            href="{{ route('merchants.index') }}">التجار</a></li>

                    <!-- Link to Companies -->
                    <li><span class="glyphicon glyphicon-briefcase"></span><a
                            href="{{ route('companies.index') }}">الشركات</a></li>

                    <!-- Link to Farmers -->
                    <li><span class="glyphicon glyphicon-leaf"></span><a
                            href="{{ route('farmers.index') }}">الفلاحين</a></li>
                    <!-- Link to Loans -->
                    {{-- <li><span class="glyphicon glyphicon-credit-card"></span><a
                            href="{{ route('loans.index') }}">القروض</a></li> --}}

                    <!-- Link to Workers -->
                    <li><span class="glyphicon glyphicon-wrench"></span><a
                            href="{{ route('people.index', ['role' => 'worker']) }}">العمال</a></li>

                    <!-- Link to Drivers -->
                    <li><span class="glyphicon glyphicon-road"></span><a
                            href="{{ route('people.index', ['role' => 'driver']) }}">السائقين</a></li>


                    <!-- Link to Daily Services -->
                    <li><span class="glyphicon glyphicon-calendar"></span><a
                            href="{{ route('daily_expenses.index') }}">الخدمات اليومية</a></li>

                    {{-- <!-- Additional Links -->
                    <li><span class="glyphicon glyphicon-list-alt"></span><a href="{{ route('products.index') }}">المنتجات</a></li>
                    <li><span class="glyphicon glyphicon-stats"></span><a href="{{ route('sales.index') }}">المبيعات</a></li>
                    <li><span class="glyphicon glyphicon-usd"></span><a href="{{ route('payments.index') }}">الدفعات</a></li>

                    <!-- Logout Option -->
                    <li>
                        <span class="glyphicon glyphicon-log-out"></span>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li> --}}
                </ul>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        @yield('content')
        <!-- End Main Content -->

        <!-- JavaScript -->
        <script src="{{ asset('admin') }}/js/jquery-2.1.4.min.js"></script>
        <script src="{{ asset('admin') }}/js/bootstrap.min.js"></script>
        <script src="{{ asset('admin') }}/js/js.js"></script>
    </div>
</body>

</html>
