@extends('layouts.user')

@section('title')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Livros
@endsection

@section('subtitle')
  {{-- <p style="display:inline; margin-left:5px;"> Gerenciar</p> --}}
  Gerenciar
@endsection

@section('tableTitle')
  Livro
@endsection

@section('thTable')
  @if(count($books) > 0)
    <th>Título</th>
    <th>Autor</th>
    <th>Editora</th>
    <th>Dono</th>
    <th>Descrição</th>
  @else
    <p>Nenhum livro disponível para empréstimo</p>
  @endif
@endsection

@section('tableBody')
  @foreach ($books as $book)
      <tr class="requestRow">
        <input type="hidden" value="{{ $book->bk_id }}">
        <td>{{ $book->bk_name }}</td>
        <td>{{ $book->bk_author }}</td>
        <td>{{ $book->publisher->pub_name }}</td>
        <td>{{ $book->bk_owner }}</td>
        <td>{{ $book->bk_description }}</td>
      </tr>
  @endforeach
@endsection

@section('col-md')
  <div class="col-md-12">
@endsection

@section('script')
  <script type="text/javascript">
    var token = $("meta[name=csrf-token]").attr("content");

    function isEmpty(tableLength)
    {
      if(tableLength === 0){
        return true;
      }
      else {
        return false;
      }
    }

    $(document).ready(function(){
      var lastClickedRow;
      var rowId;
      var userId = {{ Auth::id() }};

      $("#request").on("click", function(){
        var bookId = rowId;
          $.ajax({
            url: "/notification",
            method: "post",
            data: {
              _token: token,
              user : userId,
              book: bookId
            },
            success: function (data){
              lastClickedRow.remove();
              var empty = isEmpty($("tbody" ).children().length);
              if(empty){
                $('#table').empty();
                $('#table').append('<p>Nenhum livro disponível para empréstimo</p>');
              }
            },
            error: function(){
              console.log('moises');
            }
          });
        });

        $(".requestRow").on("click", function(){
          if (lastClickedRow == undefined)
          {
            $(this).css("background-color", "#3c8dbc");
            lastClickedRow = $(this);
            lastClickedRow.css("color", "white");
            rowId = lastClickedRow.children().val();
          }
          else if (rowId == $(this).children().val())
          {
            lastClickedRow
              .css("background-color", "white")
              .css("color", "#333333");
            lastClickedRow = undefined;
            rowId = undefined;
          }
          else
          {
            lastClickedRow
              .css("background-color", "white")
              .css("color", "#333333");
            $(this)
              .css("background-color", "#3c8dbc")
              .css("color", "white");
            lastClickedRow = $(this);
            rowId = lastClickedRow.children().val();
          }
        });

    });
  </script>
@endsection
