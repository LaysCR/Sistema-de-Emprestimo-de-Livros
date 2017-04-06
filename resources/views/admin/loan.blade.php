@extends('layouts.admin')

@section('title')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Empréstimos
@endsection

@section('subtitle')
  {{-- <p style="display:inline; margin-left:5px;"> Gerenciar</p> --}}
  Gerenciar
@endsection

@section('content')
  <!-- TABLE: LATEST ORDERS -->
        <div class="col-md-6">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Empréstimos</h3>

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
                      <th>Usuário</th>
                      <th>Livro</th>
                      <th>Data de empréstimo</th>
                      <th>Data de devolução</th>
                      <th>Situação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($loans as $loan)
                      <tr>
                        <td>{{ $loan->user->name }}</td>
                        <td>{{ $loan->book->bk_name }}</td>
                        <td>{{ $loan->ln_date }}</td>
                        <td>{{ $loan->ln_due_date }}</td>
                        <td style="text-align:center">
                          @if($loan->ln_status == 'ok')
                            <i class="fa fa-smile-o" style="color:green"></i>
                          @else
                            <i class="fa fa-frown-o" style="color:red"></i>
                          @endif
                        </td>
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
