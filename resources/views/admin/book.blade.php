@extends('layouts.admin')

@section('title')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Livros
@endsection

@section('subtitle')
  {{-- <p style="display:inline; margin-left:5px;"> Gerenciar</p> --}}
  Gerenciar
@endsection

@section('url')
  "/book/"
@endsection

@section('tableTitle')
  Livro
@endsection

@section('modalForm')
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
    <select class="form-control" name="bk_pub_id" id="bk_pub_id">
      <option selected disabled>Selecione uma editora</option>
      @foreach($publishers as $publisher)
        <option id="bookPublisherOption{{ $publisher->pub_id }}" value="{{ $publisher->pub_id }}">{{ $publisher->pub_name }}</option>
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
@endsection

@section('thTable')
  @if(count($books) > 0)
    <th class="options hidden">
     <input id="check-all" type="checkbox">
    </th>
    <th>Nome</th>
    <th>Autor</th>
    <th>Editora</th>
    <th>Dono</th>
    <th>Descrição</th>
    <th>Status</th>
  @else
    <p id="p">Não foram encontrados resultados</p>
  @endif
@endsection

@section('tableBody')
  @foreach ($books as $book)
    <tr>
      <td class="options hidden">
        <input class="items" type="checkbox" value="{{ $book->bk_id }}">
      </td>
      <td>{{ $book->bk_name }}</td>
      <td>{{ $book->bk_author }}</td>
      <td>{{ $book->publisher->pub_name }}</td>
      <td>{{ $book->bk_owner }}</td>
      <td>{{ $book->bk_description }}</td>
      <td>
        @if ($book->bk_availability == true)
          <span style="color:green">Disponível</span>
        @else
          <span style="color:red">Indisponível</span>
        @endif
      </td>
    </tr>
  @endforeach
@endsection

@section('col-md')
  <div class="col-md-12">
@endsection

@section('scripts')
  <script type="text/javascript">

    $(document).ready(function(){

      $("#btn-confirm").on("click", function(e){
        e.preventDefault();

        var name = $("#bk_name").val();
        var author = $("#bk_author").val();
        var publisher = $("#bk_pub_id").val();
        var owner = $("#bk_owner").val();
        var description = $("#bk_description").val();
        var token = $("meta[name=csrf-token]").attr("content");
        var pubName = $("#bookPublisherOption"+publisher).text();

        $.ajax({
          url : "/book",
          method : "POST",
          data : {
            _token : token,
            bk_name : name,
            bk_author: author,
            bk_owner : owner,
            bk_pub_id : publisher,
            bk_description : description
          },
          success: function(data){
            $("#modal-add").modal("toggle");
            data = data[0];
            var newBook = '<tr>' +
                            '<td class="options hidden">' +
                              '<input class="items" type="checkbox" value='+ data.bk_id +'>' +
                            '</td>' +
                            '<td>' + name + '</td>' +
                            '<td>' + author + '</td>' +
                            '<td>' + pubName + '</td>' +
                            '<td>' + owner + '</td>' +
                            '<td>' + description + '</td>' +
                            '<td style="color:green">Disponível</td>'
                          '</tr>';
                          //Check items
                          if(isEmpty($('#table').children('tbody').children().length)){
                            $('#p').remove();
                            $('#table').empty();
                            var thead = '<thead>' +
                                          '<tr>' +
                                          '<th class="options hidden">' +
                                            '<input id="check-all" type="checkbox">' +
                                          '</th>' +
                                          '<th>Nome</th>' +
                                          '<th>Autor</th>' +
                                          '<th>Editora</th>' +
                                          '<th>Dono</th>' +
                                          '<th>Descrição</th>' +
                                          '<th>Status</th>'
                                          '</tr>' +
                                        '</thead>';
                            $('#table').append(thead);
                            $('#table').append('<tbody class="table-body">' + newBook + '</tbody>');

                          } else {
                            $('.table-body').append(newBook);
                          }
                          $("#btn-delete").on("click", onClickBtnDelete);
                          $("#check-all").on("click", checkAll);
          },
          error: function(response){
            console.log(response);
          }
        });
      });

    });
  </script>

@endsection
