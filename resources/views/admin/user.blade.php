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

  {{-- User Modal --}}
  <div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cadastrar Usuário</h4>
        </div>
        <div class="modal-body">
          <form id="postUser" action="{{ url('/user') }}" method="POST"> {{ csrf_field() }}
            <div class="form-group">
              <label for="name" class="control-label">Usuário:</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="email" class="control-label">Email:</label>
              <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
              <label for="user_rle_id" class="control-label">Permissão:</label>
              <select id="role-form-user" class="form-control" name="user_rle_id">
                <option selected disabled>Selecione uma permissão</option>
                @foreach($roles as $role)
                  <option id="userRoleOption{{ $role->rle_id }}" value="{{ $role->rle_id }}">{{ $role->rle_name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Senha:</label>
              <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button id="btn-add-user" type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- TABLE: USERS -->
        <div class="col-md-6">
            <div class="box box-primary">
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
                    <tbody class="userList">
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
                <a class="btn btn-sm btn-primary btn-flat pull-right" id="add-user">Adicionar Usuário &ensp;<i class="fa fa-plus"></i></a>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>

@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function()
    {
      //Open modal
      $("#add-user").on("click", function(){
        $("#modal-add-user").modal("toggle");
      });

      //Add user
      $("#btn-add-user").on("click", function(e)
      {
        e.preventDefault();

        // var data = $("#postUser").serialize();

        var name = $("#name").val(); console.log(name);
        var email = $("#email").val(); console.log(email);
        var password = $("#password").val(); console.log(password);

        var role = $("#role-form-user").val(); console.log('role =' + role);
        var roleName = $("#userRoleOption"+role).text(); console.log('roleName = ' + roleName);
        var token = $("meta[name=csrf-token]").attr("content"); console.log(token);

        var rle;
        if (role == 1){
          rle = '<span class="label label-primary">' + roleName + '</span>';
        } else {
          rle = '<span class="label label-success">' + roleName + '</span>';
        }

        $.ajax({
          url : "/user",
          method : "POST",
          data : {
            _token : token,
            name : name,
            email : email,
            user_rle_id : role,
            password : password
          },
          success: function(data){
            $("#modal-add-user").modal("toggle");
            var newUser = '<tr>' +
                            '<td>' + name + '</td>' +
                            '<td>' + email + '</td>' +
                            '<td>' + rle + '</td>' +
                          '</tr>';
            $('.userList').append(newUser);
          },
          error: function(response){
            console.log(response);
          }
        });
      });

    });
  </script>
@endsection
