<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Sistema de inscrições -@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/adminlte.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/plugins.css') }}" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('stylesheets')
</head>

<body class="hold-transition skin-blue-light sidebar-mini">

<div class="wrapper">

    <header class="main-header">

        <a class="logo navbar-brand" href="{{url('/')}}">Livros</a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        <li><a>Olá, {{Auth::user()->name}}</a></li>
                        <li>
                            <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-unlock-alt"></i> Sair do sistema</a>
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                <input name="_token" value="{{csrf_token()}}" type="hidden">
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

    </header>

    <!-- Left side column. contains the main navigation menu-->
    @include('layouts.includes.left')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
                <small>@yield('subtitle')</small>
            </h1>
            <ol class="breadcrumb">
                @yield('breadcrumb')
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
    </div><!-- /.content-wrapper -->

    <!-- Footer bar. -->
    @include('layouts.includes.footer')

</div><!-- ./wrapper -->

<!-- JQUERY-->
<script src="{{ asset('/js/app.js')}}"></script>
<script src="{{ asset('/js/plugins.js')}}"></script>

{{-- {!! Flash::render() !!} --}}

@yield('scripts')

</body>
</html>
