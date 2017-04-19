@extends('layouts.admin')

@section('title')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Usuários
@endsection

@section('subtitle')
  {{-- <p style="display:inline; margin-left:5px;"> Gerenciar</p> --}}
  Gerenciar
@endsection

@section('url')
"/user/"
@endsection

@section('tableTitle')
  Usuário
@endsection

@section('modalForm')
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
@endsection

@section('thTable')
  <th>Nome</th>
  <th>Email</th>
  <th>Privilégio</th>
@endsection

@section('tableBody')
  @if(count($users)!=0)
  @foreach ($users as $user)
    <tr>
      <td class="options hidden">
        @if ($user->user_rle_id == 1)
          <input class="items" type="checkbox" value="{{ $user->id }}">
        @else
          <input class="items" type="checkbox" value="{{ $user->id }}" disabled>
        @endif
      </td>
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
  @else
    <tr>Nenhum usuário encontrado</tr>
  @endif
@endsection

@section('col-md')
  <div class="col-md-6">
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function()
    {

      //Add user
      $("#btn-confirm").on("click", function(e)
      {
        e.preventDefault();

        // var data = $("#postUser").serialize();

        var name = $("#name").val(); console.log(name);
        var email = $("#email").val(); console.log(email);
        var password = $("#password").val(); console.log(password);

        var role = $("#role-form-user").val(); console.log('role =' + role);
        var roleName = $("#userRoleOption"+role).text(); console.log('roleName = ' + roleName);

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
            $("#modal-add").modal("toggle");
            data = data[0];
            var newUser = '<tr>' +
                            '<td class="options hidden">'+
                              '<input class="items" type="checkbox" value="'+ data.id +'">' +
                            '</td>' +
                            '<td>' + name + '</td>' +
                            '<td>' + email + '</td>' +
                            '<td>' + rle + '</td>' +
                          '</tr>';

                          //Check items
                          if(isEmpty($('#table').children('tbody').children().length)){
                            $('#p').remove();
                            $('#table').empty();
                            var thead = '<thead>' +
                                          '<tr>' +
                                          '<th class="options hidden">' +
                                            '<input id="check-all" type="checkbox">' +
                                          '</th>' +
                                          '<th>Nome</th>' +
                                          '<th>Email</th>' +
                                          '<th>Privilégio</th>' +
                                          '</tr>' +
                                        '</thead>';
                                        $('#table').append(thead);
                            $('#table').append('<tbody class="table-body">' + newUser + '</tbody>');

                          } else {
                            $('.table-body').append(newUser);
                          }
                          $("#btn-delete").on("click", onClickBtnDelete);
                          $("#check-all").on("click", checkAll);
          },
          error: function(response){
            console.log(response);
          }
        });
      });

    });
  </script>
@endsection
