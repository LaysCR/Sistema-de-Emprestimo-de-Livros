<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <style>
      .hidden {
        display: none;
      }
    </style>
    @yield('stylesheets')
</head>

<body class="hold-transition skin-blue-light sidebar-mini">

<div class="wrapper">

    @include('layouts.includes.header')

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

          {{-- Modal --}}
          <div class="modal fade" id="modal-add" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">
                    Cadastrar @yield('title')
                  </h4>
                </div>
                <div class="modal-body">
                  <form id="modal-form">
                    @yield('modalForm')
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                      <button id="btn-confirm" type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Table -->
                @yield('col-md')
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">
                          @yield('title')
                        </h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="table-responsive">
                          <table class="table no-margin">
                            <thead>
                            <tr>
                              <th class="options hidden"></th>
                              @yield('thTable')
                            </tr>
                            </thead>
                            <tbody class="table-body">
                              @yield('tableBody')
                            </tbody>
                          </table>
                        </div>
                        <!-- /.table-responsive -->
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer clearfix">
                        <a class="btn btn-sm btn-primary btn-flat pull-right" id="add">
                          Adicionar @yield('tableTitle')
                          &ensp;<i class="fa fa-plus"></i>
                        </a>
                        <a class="btn btn-sm btn-default btn-flat pull-left" id="open-options"><i class="fa fa-cogs"></i></a>
                        <a class="btn btn-sm btn-default btn-flat pull-left options hidden" id="btn-edit"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-sm btn-default btn-flat pull-left options hidden" id="btn-delete"><i class="fa fa-trash"></i></a>
                      </div>
                      <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                </div>
        </section>
    </div><!-- /.content-wrapper -->

    <!-- Footer bar. -->
    @include('layouts.includes.footer')

</div><!-- ./wrapper -->

<!-- JQUERY-->
<script src="{{ asset('/js/app.js')}}"></script>
<script src="{{ asset('/js/plugins.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function(){

    var token = $("meta[name=csrf-token]").attr("content");

    $("#add").on("click", function(){
      $("#modal-add").modal("toggle");
    });

    $("#open-options").on('click', function(){
      $(".options").toggleClass("hidden");
    });

    $("#btn-delete").on("click", function(){
      $(".items:checked").each(function(){
        var row = $(this).closest('tr');
        var id = $(this).val();
        var url = @yield('url');
        $.ajax({
          url : url + id,
          method : "POST",
          data : {
            _token : token,
            _method : "DELETE",
          },
          success : function(data) {
              row.remove();
          },
          error : function(response) {
            console.log(response);
          }
        });
      });
    });


  });
</script>

@yield('scripts')

</body>
</html>
