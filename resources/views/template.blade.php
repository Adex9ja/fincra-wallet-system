@php use Illuminate\Support\Facades\Auth; @endphp
    <!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <title>{{ config('app.name') }} </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}">

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('fonts/feather-font/css/iconfont.css') }}">
    <link media="all" type="text/css" rel="stylesheet"
          href="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link media="all" type="text/css" rel="stylesheet"
          href="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('datatable/dataTables.bootstrap4.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('plugins/simplemde/simplemde.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet"
          href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">


    <!-- common css -->
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- end common css -->

</head>
<body>

<script src="{{ asset('js/spinner.js') }}"></script>

<div class="main-wrapper" id="app">
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="/dashboard" class="sidebar-brand">
                 <span>
                    <img style="margin-bottom: 8px" src="{{asset('images/logo.png')}}" alt="{{ config('app.name') }}"
                         height="30px">
                </span>
            </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item ">
                    <a href="/dashboard" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users" class="nav-link ">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/transactions" class="nav-link ">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Transactions</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="page-wrapper">
        <nav class="navbar">
            <a href="#" class="sidebar-toggler">
                <i data-feather="menu"></i>
            </a>
            <div class="navbar-content">
                <form class="search-form">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="navbarForm"
                               placeholder="Search transaction and user here..." name="term">
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('images/default_profile.png') }}" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="info text-center">
                                    <p class="name  mb-0"> {{ Auth::user()->name }} </p>
                                    <p class="email text-muted mb-3"> {{ Auth::user()->email }} </p>
                                </div>
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="{{ url()->to('profile') }}" class="nav-link">
                                            <i data-feather="user"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ url()->route('logout') }}" class="nav-link">
                                            <i data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="page-content">
            <nav class="page-breadcrumb">
                <ol class="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </ol>
            </nav>

            {!! session('msg')  !!}
            {!! session('error')  !!}
            @yield('content')
        </div>
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">Copyright © 2024 . All rights reserved</p>
            <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Powered by: <a target="_blank"
                                                                                                 href="http://fincra.com">Fincra</a>
            </p>
        </footer>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/email.js') }}"></script>
<script src="{{ asset('js/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/simplemde/simplemde.min.js') }}"></script>
<script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('plugins/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/dataTables.bootstrap4.min.js') }}"></script>

<script type="text/javascript"
        src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.colVis.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable({
            responsive: false,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>
@yield('script')
</body>

</html>
