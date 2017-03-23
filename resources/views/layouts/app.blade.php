<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Livros Cadastrados</title>

        <!-- CSS And JavaScript -->
        <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <meta name="csrf" token="{{ csrf_token() }}">
      @yield('scripts')
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
                  <div class="container-fluid">
                  <div class="navbar-header">
                    <a class="navbar-brand">Livros DTE</a>
                  </div>
                  <ul class="nav navbar-nav">
                    <li>@yield('btn-modal')</li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-down"></span></a>
                         <ul class="dropdown-menu">
                           <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                         </ul>
                    </li>
                  </ul>
                </div>
            </nav>
        </div>

        @yield('content')
    </body>
</html>
