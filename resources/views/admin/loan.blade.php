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
  <!-- MODAL -->
  <div class="modal fade" id="modal-add-loan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Criar Empréstimo</h4>
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
            <button type="submit" class="btn btn-primary" id="add-loan">Confirmar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- TABLE: LATEST ORDERS -->
        <div class="col-md-6">
            <div class="box box-primary">
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
                    <tbody class="loanList">
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
                <a class="btn btn-sm btn-primary btn-flat pull-right" id="btn-add-loan">Adicionar Empréstimo &ensp;<i class="fa fa-plus"></i></a>
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
      $("#btn-add-loan").on("click", function(){
        $("#modal-add-loan").modal("toggle");
      });

      //Add loan
      $("#add-loan").on("click", function(e)
      {
        e.preventDefault();

        var token = $("meta[name=csrf-token]").attr("content");

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
            $("#modal-add-loan").modal("toggle");
            data = data[0];
            console.log(data);
            var newLoan =  '<tr>' +
                            '<td>' + userName + '</td>' +
                            '<td>' + bookName + '</td>' +
                            '<td>' + data.ln_date + '</td>' +
                            '<td>' + data.ln_due_date + '</td>' +
                            '<td style="text-align:center"><i class="fa fa-smile-o" style="color:green"></i></td>' +
                          '</tr>';
            $('.loanList').append(newLoan);
          },
          error: function(response){
            console.log(response);
          }
        });
      });

    });
  </script>
@endsection
