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
  {{-- Book Modal --}}
  <div class="modal fade" id="modal-add-book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-right" id="btn-add-book"><i class="fa fa-plus"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-left">Ver mais</a>
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
    $(document).ready(function(){

      $("#btn-add-book").on("click", function(){
        $("#modal-add-book").modal("toggle");
      });

      $("#btn-confirm-book").on("click", function(e){
        e.preventDefault();

        var form = $("#postBook").serialize();
        console.log(form);

        // $.ajax({
        //   url : "/book",
        //   method : "POST",
        //   data : form,
        //   success: function(data){
        //     $("#add-book").modal("toggle");
        //     data = data[0];
        //     console.log(data);
        //     // var newBook = '<tr>' +
        //     //                 '<td>' +  + '</td>' +
        //     //                 '<td>' +  + '</td>' +
        //     //                 '<td>' +  + '</td>' +
        //     //               '</tr>';
        //     // $('.bookList').append(newBook);
        //   },
        //   error: function(response){
        //     console.log(response);
        //   }
        // });
      });

    });
  </script>

@endsection
