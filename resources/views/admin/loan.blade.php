@extends('layouts.admin')

@section('title')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Empréstimos
@endsection

@section('subtitle')
  {{-- <p style="display:inline; margin-left:5px;"> Gerenciar</p> --}}
  Gerenciar
@endsection

@section('tableTitle')
  Empréstimo
@endsection

@section('modalForm')
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
@endsection

@section('thTable')
  <th>Usuário</th>
  <th>Livro</th>
  <th>Data de empréstimo</th>
  <th>Data de devolução</th>
  <th>Situação</th>
@endsection

@section('tableBody')
  @if(count($loans)!=0)
    @foreach ($loans as $loan)
      <tr>
        <td class="options hidden">
          <input class="items" type="checkbox" value="{{ $loan->ln_id }}">
        </td>
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
  @else
    <tr>
      <p>Nenhum empréstimo enconpado</p>
    </tr>
  @endif
@endsection

@section('col-md')
  <div class="col-md-8">
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function()
    {
      //Add loan
      $("#btn-confirm").on("click", function(e)
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
            $("#modal-add").modal("toggle");
            data = data[0];
            console.log(data);
            var newLoan =  '<tr>' +
                            '<td>' + userName + '</td>' +
                            '<td>' + bookName + '</td>' +
                            '<td>' + data.ln_date + '</td>' +
                            '<td>' + data.ln_due_date + '</td>' +
                            '<td style="text-align:center"><i class="fa fa-smile-o" style="color:green"></i></td>' +
                          '</tr>';
            $('.table-body').append(newLoan);
          },
          error: function(response){
            console.log(response);
          }
        });
      });

    });
  </script>
@endsection
