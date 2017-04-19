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
  <th>Título</th>
  <th>Autor</th>
  <th>Editora</th>
  <th>Dono</th>
  <th>Descrição</th>
@endsection

@section('tableBody')
  @foreach ($books as $book)
    @if($book->bk_availability == true)
      <tr class="requestRow">
        <input type="hidden" value="{{ $book->bk_id }}">
        <td>{{ $book->bk_name }}</td>
        <td>{{ $book->bk_author }}</td>
        <td>{{ $book->publisher->pub_name }}</td>
        <td>{{ $book->bk_owner }}</td>
        <td>{{ $book->bk_description }}</td>
      </tr>
    @endif
  @endforeach
@endsection

@section('col-md')
  <div class="col-md-12">
@endsection

@section('script')
  <script type="text/javascript">
    var token = $("meta[name=csrf-token]").attr("content");

    $(document).ready(function(){
      var lastClickedRow;
      var rowId;

      $(".requestRow").on("click", function(){

        if (lastClickedRow == undefined)
        {
          $(this).css("background-color", "lightgrey");
          lastClickedRow = $(this);
          rowId = lastClickedRow.children().val(); console.log(rowId);
        }
        else if (rowId == $(this).children().val())
        {
          lastClickedRow.css("background-color", "white");
          lastClickedRow = undefined;
          rowId = undefined;
        }
        else
        {
          lastClickedRow.css("background-color", "white");
          $(this).css("background-color", "lightgrey");
          lastClickedRow = $(this);
          rowId = lastClickedRow.children().val(); console.log(rowId);
        }
      });

      $("#request").on("click", function(){

        var bookId = rowId;

        

      });

    });
  </script>
@endsection
