<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/css/app.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/custom.css') }}" />
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('admin-assets/img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets//bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin-assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/bundles/jquery-selectric/selectric.css') }}">


    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="loader"></div>
    <div class="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar"
                                class="nav-link nav-link-lg
                                        collapse-btn"> <i
                                    data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                        <li>
                            <form class="form-inline mr-auto">
                                <div class="search-element">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                        data-width="200">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                                src="{{ asset('admin-assets/img/admin.png') }}" class="user-img-radious-style"> <span
                                class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title"><strong>{{ Auth::guard('admin')->user()->name }}</div>
                            <a href="profile.html" class="dropdown-item has-icon"> <i
                                    class="far
                                            fa-user"></i> Profile
                            </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                                Activities
                            </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger"> <i
                                    class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            @include('admin.layouts.sidebar')
            <div class="content-wrapper">
                @yield('content')
                
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">

                <strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
            </footer>
        </div>

    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('admin-assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/page/index.js') }}"></script>
    <script src="{{ asset('admin-assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin-assets/js/custom.js') }}"></script>
    <script src="{{ asset('admin-assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('admin-assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/page/datatables.js') }}"></script>
    <script src="{{ asset('admin-assets/bundles/apexcharts/apexcharts.min.js') }}"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('customJs')
</body>

</html>
