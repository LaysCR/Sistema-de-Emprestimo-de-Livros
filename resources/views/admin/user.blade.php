@extends('layouts.admin')

@section('title')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Usuários
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
                <h3 class="box-title">Usuários</h3>

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
                      <th>Email</th>
                      <th>Privilégio</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          @if ($user->user_rle_id == 1)
                            <span class="label label-primary">{{ $user->role->rle_name }}</span>
                          @else
                            <span class="label label-success">{{ $user->role->rle_name }}</span>
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
