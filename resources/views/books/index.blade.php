@extends('layouts.app')

@section('content')

    {{-- Table --}}
    <div class="container">
      <table class="table table">
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Dono</th>
            <th>Descrição</th>
            <th style="color:gray">Gerenciar <i class="fa fa-cogs"></i></th>
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
            <td value="{{ $book->bk_id }}" style="padding-top:20px">
              <div class="col-md-6" style="margin-left:-15px">
                <button class="btn btn-warning btn-edit"><i class="fa fa-pencil"></i></button>
              </div>
              <div class="col-md-6" style="margin-left:5px">
                <button class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                  @foreach($publishers as $pub_id => $pub_name)
                    <option value="{{ $pub_id }}">{{ $pub_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="tg_id" class="control-label">Tags:</label>
                <select id="tags" class="form-control" name="td_id" multiple="multiple">
                  @foreach ($tags as $tg_id => $tg_name)
                    <option value="{{ $tg_id }}">{{ $tg_name }}</option>
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
                <button id="salvar" type="submit" class="btn btn-primary">Cadastrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

@endsection

@section('script')

  <script type="text/javascript">

  $(document).ready(function(){

    var bk_id;
    // Select2
    $("#tags").select2();

    function deleteBook()
    {
      bk_id = JSON.parse($(this).closest('td').attr("value"));
      var row = $(this).closest('tr'); console.log(row);
      var token = $("meta[name=csrf-token]").attr("content");

      // Sweetalert
      swal({
        title: "Deseja deletar o livro?",
        text: "Você não poderar recuperar o livro deletado !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, deletar!",
        cancelButtonText: "Não, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({
            url : '/' + bk_id,
            method : "POST",
            data : {
              _token : token,
              _method : "DELETE"
            },
            success: function(response) {
              row.remove();
              swal("Deletado!", "O arquivo foi deletado com sucesso.", "success");
            }
          });
        } else {
      	    swal("Cancelado", "O arquivo não foi deletado", "error");
        }
      });

    }

    $(".btn-delete").on("click", deleteBook);

  });

  </script>

@endsection
