@extends('layouts.app')

@section('style')
  <style>

    .navbar{
      background-color: LightSkyBlue !important;
    }

    .content {
      margin: 0px 30px 0px;
    }

    .col-md-4{
      padding: 25px 30px 0px;
    }

    .outer{
      border-color: #00c0ef;
      border: 3px #00c0ef solid;
      border-radius: 10px;
    }
    .outer .panel-heading, .outer .panel-footer {
        background-color:#00c0ef;
        border-color: #00c0ef;
        color: white !important;
        border:none;
        font-size:12px;
    }
    .inner .panel-footer, .inner .panel-heading{
      background-color: #009933 !important;
    }

    .inner  {
      color: #737373 !important;
      border-color: #009933 !important;
      font-family: 'Muli', sans-serif;
    }
    .inner .panel-footer{
      padding: 2px;
      padding-right: 10px;
      height: 20px;
    }
    .inner .panel-footer p{
      font-family: 'Muli', sans-serif;
      float: right;
    }

    .btn-primary {
      color: white;
      border-color: #337ab7;
    }
  </style>
@endsection

@section('content')

    {{-- Loan Modal --}}
    <div class="modal fade" id="add-loan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Criar Empréstimo</h4>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label for="user" class="control-label">Usuário:</label>
                <select id="loan-form-user" class="form-control" name="loan-form-user">
                <option selected disabled>Selecione um usuário</option>
                @foreach ($users as $user)
                  @if($user->user_rle_id == 1)
                    <option id="loanUserOption{{ $user->id }}" value="{{ $user->id }}">{{ $user->name }}</option>
                  @endif
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="book" class="control-label">Livro:</label>
                <select id="loan-form-book" class="form-control" name="loan-form-book">
                <option selected disabled>Selecione um livro</option>
                @foreach ($books as $book)
                    <option id="loanBookOption{{ $book->bk_id }}" value="{{ $book->bk_id }}">{{ $book->bk_name }}</option>
                @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary" id="btn-confirm-loan">Confirmar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- Book Modal --}}
    <div class="modal fade" id="add-book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Cadastrar Livro</h4>
          </div>
          <div class="modal-body">
            <form id="postBook" action="{{ url('/') }}" method="POST"> {{ csrf_field() }}
              <div class="form-group">
                <label for="bk_name" class="control-label">Título:</label>
                <input type="text" class="form-control" name="bk_name" id="bk_name">
              </div>
              <div class="form-group">
                <label for="bk_author" class="control-label">Autor:</label>
                <input type="text" class="form-control" name="bk_author" id="bk_author">
              </div>
              <div class="form-group">
                <label for="bk_pub_id" class="control-label">Editora:</label>
                <select class="form-control" name="bk_pub_id">
                  <option selected disabled>Selecione uma editora</option>
                  @foreach($publishers as $publisher)
                    <option value="{{ $publisher->pub_id }}">{{ $publisher->pub_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="bk_owner" class="control-label">Dono:</label>
                <input type="text" class="form-control" name="bk_owner" id="bk_owner">
              </div>
              <div class="form-group">
                <label for="bk_description" class="control-label">Descrição:</label>
                <textarea class="form-control" name="bk_description" id="bk_description"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id="btn-confirm-book" type="submit" class="btn btn-primary">Cadastrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- User Modal --}}
    <div class="modal fade" id="add-user" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Cadastrar Usuário</h4>
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
                <button id="btn-confirm-user" type="submit" class="btn btn-primary">Cadastrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  <div class="content">

    {{-- Loan Panel --}}
    <div id="loan-panel" class="col-md-4">
      <div class="panel panel-default outer">
          <div class="panel-heading">
              <h3 class="panel-title"><b>Empréstimos</b></h3>
          </div>
          <div class="panel-body loanList">
            @foreach ($loans as $loan)
              <div class="panel panel-default inner">
                <div class="panel-body">
                    {{ $loan->user->name }} - {{ $loan->book->bk_name }}
                </div>
                <div class="panel-footer">
                  <p>{{ $loan->ln_due_date }}</p>
                </div>
              </div>
            @endforeach
          </div>
          <div class="panel-footer">
            <button type="button" class="btn btn-primary" id="btn-add-loan"><i class="fa fa-plus"></i></button>
          </div>
      </div>
    </div>

    {{-- Book Panel --}}
    <div id="book-panel" class="col-md-4">
      <div class="panel panel-default outer">
          <div class="panel-heading">
              <h3 class="panel-title"><b>Livros</b></h3>
          </div>
          <div class="panel-body bookList">
            @foreach ($books as $book)
              <div class="panel panel-default inner">
                <div class="panel-body">
                    {{ $book->bk_name }} - {{ $book->bk_author }}
                </div>
                <div class="panel-footer">
                  <p>{{ $book->bk_owner }}</p>
                </div>
              </div>
            @endforeach
          </div>
          <div class="panel-footer">
            <button type="button" class="btn btn-primary" id="btn-add-book"><i class="fa fa-plus"></i></button>
          </div>
      </div>
    </div>

    {{-- User Panel --}}
    <div id="user-panel" class="col-md-4">
      <div class="panel panel-default outer">
          <div class="panel-heading">
              <h3 class="panel-title"><b>Usuários</b></h3>
          </div>
          <div class="panel-body">
            @foreach ($users as $user)
              <div class="panel panel-default inner">
                <div class="panel-body">
                    {{ $user->name }}
                </div>
                <div class="panel-footer">
                  <p>{{ $user->email }}</p>
                </div>
              </div>
            @endforeach
          </div>
          <div class="panel-footer">
            <button type="button" class="btn btn-primary" id="btn-add-user"><i class="fa fa-plus"></i></button>
          </div>
      </div>
    </div>

  </div>

@endsection

@section('script')

  <script type="text/javascript">

  $(document).ready(function(){
    // Global var token
    var token = $("meta[name=csrf-token]").attr("content");

    $("#btn-add-loan").on("click", function()
    {
      $("#add-loan").modal("toggle");
    });
    $('#add-loan').on('hidden', function () {
      $('select').val('');
    });

    $("#btn-add-book").on("click", function(){
      $("#add-book").modal("toggle");
    });

    $("#btn-add-user").on("click", function(){
      $("#add-user").modal("toggle");
    });

    $("#btn-confirm-loan").on("click", function(e)
    {
      e.preventDefault();

      var user = $("#loan-form-user").val();
      var book = $("#loan-form-book").val();
      var userName = $('#loanUserOption'+user).text();
      var bookName = $('#loanBookOption'+book).text();

      $.ajax({
        url : "/loan",
        method : "POST",
        data : {
          _token : token,
          user : user,
          book : book
        },
        success: function(data){
          $("#add-loan").modal("toggle");
          console.log(data[0]);
          // console.log([userName, bookName]);
          var newLoan = '<div class="panel panel-default inner">' +
                          '<div class="panel-body">' +
                                userName + ' - ' + bookName +
                          '</div>' +
                          '<div class="panel-footer">' +
                            '<p>' + data[0].ln_due_date +'</p>' +
                          '</div>' +
                        '</div>';
          $('.loanList').append(newLoan);
        },
        error: function(response){
          console.log(response);
        }
      });
    });

    $("#btn-confirm-book").on("click", function(e){
      e.preventDefault();

      var data = $("#postBook").serialize();

      $.ajax({
        url : "/book",
        method : "POST",
        data : data,
        success: function(data){
          $("#add-book").modal("toggle");
          console.log(data);
          var newBook = '<div class="panel panel-default inner">' +
                          '<div class="panel-body">' +
                                data[0].bk_name + ' - ' + data[0].bk_author +
                          '</div>' +
                          '<div class="panel-footer">' +
                            '<p>' + data[0].bk_owner +'</p>' +
                          '</div>' +
                        '</div>';
          $('.bookList').append(newBook);
        },
        error: function(response){
          console.log(response);
        }
      });
    });

    $("#btn-confirm-user").on("click", function(e)
    {
      e.preventDefault();

      var data = $("#postUser").serialize();
      var user = $("#role-form-user").val();
      var userName = $("#userRoleOption"+user).text();

      $.ajax({
        url : "/user",
        method : "POST",
        data : {
          _token : token,
          data : data
        },
        success: function(response){
          $("#add-user").modal("toggle");
          console.log(response);
        },
        error: function(response){
          console.log(response);
        }
      });
    });

  });

  </script>

@endsection
