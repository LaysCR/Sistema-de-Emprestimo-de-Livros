@extends('layouts.app')

@section('content')

      <button type="button" class="btn btn-primary" id="btn-add-loan"><i class="fa fa-plus"></i></button>

      {{-- Modal --}}
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

@endsection

@section('script')

  <script type="text/javascript">

  $(document).ready(function(){

    $("#btn-add-loan").on("click", function()
    {
      $("#add-loan").modal("toggle");
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
          console.log(response);
          // location.href = "{{ route('admin.index') }}";
        },
        error: function(response){
          console.log(response);
        }
      });
    });

  });

  </script>

@endsection
