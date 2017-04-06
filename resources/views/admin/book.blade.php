@extends('layouts.admin')

@section('title')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Livros
@endsection

@section('subtitle')
  {{-- <p style="display:inline; margin-left:5px;"> Gerenciar</p> --}}
  Gerenciar
@endsection

@section('content')
  <!-- TABLE: LATEST ORDERS -->
        <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Livros</h3>

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
                      <th>Nome</th>
                      <th>Autor</th>
                      <th>Editora</th>
                      <th>Dono</th>
                      <th>Descrição</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                      <tr>
                        <td>{{ $book->bk_name }}</td>
                        <td>{{ $book->bk_author }}</td>
                        <td>{{ $book->publisher->pub_name }}</td>
                        <td>{{ $book->bk_owner }}</td>
                        <td>{{ $book->bk_description }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-right"><i class="fa fa-plus"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-left">Ver mais</a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>

@endsection
