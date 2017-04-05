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

<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header logo">
                    <a href="{{url('/')}}"><img src="{{asset('/img/logo.png')}}"></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

            @if(!Auth::check())
                <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-lock"></i> Acessar o sistema</a></li>
                        </ul>
                    </div>
                @else
                    <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-unlock-alt"></i> Sair do sistema</a>
                                </a>
                                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                    <input name="_token" value="{{csrf_token()}}" type="hidden">
                                </form>
                            </li>
                        </ul>
                    </div>
            @endif
            <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>

    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    @include('layouts.includes.footer')

</div>

<script src="{{ asset('/js/app.js')}}"></script>
<script src="{{ asset('/js/plugins.js')}}"></script>

{{-- {!! Flash::render() !!} --}}

@yield('scripts')

</body>
</html>
