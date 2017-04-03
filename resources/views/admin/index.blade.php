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
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endif
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="book" class="control-label">Livro:</label>
                <select id="loan-form-book" class="form-control" name="loan-form-book">
                <option selected disabled>Selecione um livro</option>
                @foreach ($books as $book)
                    <option value="{{ $book->bk_id }}">{{ $book->bk_name }}</option>
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
                <input type="text" class="form-control" name="bk_name" id="bk_name"----------------->
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


  <div class="content">

    {{-- Loan Panel --}}
    <div id="loan-panel" class="col-md-4">
      <div class="panel panel-default outer">
          <div class="panel-heading">
              <h3 class="panel-title"><b>Empréstimos</b></h3>
          </div>
          <div class="panel-body">
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
          <div class="panel-body">
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

    $("#btn-add-loan").on("click", function()
    {
      $("#add-loan").modal("toggle");
    });

    $("#btn-add-book").on("click", function(){
      $("#add-book").modal("toggle");
    });

    $("#btn-confirm-loan").on("click", function(e)
    {
      e.preventDefault();

      var user = $("#loan-form-user").val();
      var book = $("#loan-form-book").val();
      var token = $("meta[name=csrf-token]").attr("content");

      $.ajax({
        url : "/loan",
        method : "POST",
        data : {
          _token : token,
          user : user,
          book : book
        },
        success: function(response){
          $("#add-loan").modal("toggle");
          console.log(response);
          //
          location.href = "{{ route('admin.index') }}";
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
        success: function(){
          console.log("WIIIIIIIIIIIIIII");
        }
      });

    });

  });

  </script>

@endsection
