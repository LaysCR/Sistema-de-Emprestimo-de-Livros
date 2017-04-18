@extends('layouts.admin')

@section('title')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Empréstimos
@endsection

@section('subtitle')
  {{-- <p style="display:inline; margin-left:5px;"> Gerenciar</p> --}}
  Gerenciar
@endsection

@section('url')
"/loan/"
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
  @if(count($loans) > 0)
    <th>Usuário</th>
    <th>Livro</th>
    <th>Data de empréstimo</th>
    <th>Data de devolução</th>
    <th>Situação</th>
  @else
    <p id="p">Não foram encontrados resultados</p>
  @endif
@endsection

@section('tableBody')
    @foreach ($loans as $loan)
      <tr>
        <td class="options hidden">
          <input class="items" type="checkbox" value="{{ $loan->ln_id }}">
          <input type="hidden" name="ln_bk_id" value="{{ $loan->ln_bk_id }}">
        </td>
        <td>{{ $loan->user->name }}</td>
        <td>{{ $loan->book->bk_name }}</td>
        <td>{{ date('d/m/Y', strtotime($loan->ln_date)) }}</td>
        <td>{{ date('d/m/Y', strtotime($loan->ln_due_date)) }}</td>
        <td style="text-align:center">
          @if($loan->ln_status == 0)
            <i class="fa fa-smile-o" style="color:green; font-size:22px"></i>
          @elseif ($loan->ln_status == 1)
            <i class="fa fa-meh-o" style="color:orange; font-size:22px"></i>
          @elseif ($loan->ln_status == 2)
            <i class="fa fa-frown-o" style="color:red; font-size:22px"></i>
          @endif
        </td>
      </tr>
    @endforeach
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
            $('#loanBookOption'+book).addClass('hidden');
            data = data[0];

            var date = new Date();
            var dueDate = new Date();
            dueDate.setDate(dueDate.getDate() + 14); console.log(dueDate);

            date = dateFormat(date);
            dueDate = dateFormat(dueDate);

            var newLoan = '<tr>' +
                            '<td class="options hidden">'+
                              '<input class="items" type="checkbox" value="'+ data.ln_id +'">' +
                              '<input type="hidden" name="ln_bk_id" value="'+ book +'">' +
                            '</td>' +
                            '<td>' + userName + '</td>' +
                            '<td>' + bookName + '</td>' +
                            '<td>' + date + '</td>' +
                            '<td>' + dueDate + '</td>' +
                            '<td style="text-align:center"><i class="fa fa-smile-o" style="color:green; font-size:22px"></i></td>' +
                          '</tr>';
            //Check items
            if(isEmpty($('#table').children('tbody').children().length)){
              $('#p').remove();
              $('#table').empty();
              var thead = '<thead>' +
                            '<tr>' +
                            '<th class="hidden">' +
                              '<input id="check-all" type="checkbox">' +
                            '</th>' +
                            '<th class="options hidden"></th>' +
                            '<th>Usuário</th>' +
                            '<th>Livro</th>' +
                            '<th>Data de empréstimo</th>' +
                            '<th>Data de devolução</th>' +
                            '<th>Situação</th>' +
                            '</tr>' +
                          '</thead>';
              $('#table').append(thead);
              $('#table').append('<tbody class="table-body">' + newLoan + '</tbody>');

            } else {
              $('.table-body').append(newLoan);
            }
            $("#btn-delete").on("click", onClickBtnDelete);
          },
          error: function(response){
            console.log(response);
          }
        });
      });

    });
  </script>
@endsection
