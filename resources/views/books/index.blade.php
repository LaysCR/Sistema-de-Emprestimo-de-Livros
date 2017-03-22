@extends('layouts.app')

@section('content')

    {{-- Table --}}
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Título</th>
            <th>Autor</th>
            {{-- <th>Editora</th> --}}
            <th>Dono</th>
            <th>Descrição</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($books as $book)
          <tr>
            <td>{{ $book->bk_name }}</td>
            <td>{{ $book->bk_author }}</td>
            {{-- <td>{{ $publisher->pub_name }}</td> --}}
            <td>{{ $book->bk_owner }}</td>
            <td>{{ $book->bk_description }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- Modal's button --}}
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"></button>
    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Cadastrar Livro</h4>
          </div>
          <div class="modal-body">
            {{-- @form --}}
            <form>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Título:</label>
                <input type="text" class="form-control" id="bk_name">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Autor:</label>
                <input type="text" class="form-control" id="bk_name">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="control-label">Dono:</label>
                <input type="text" class="form-control" id="bk_owner">
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Descrição:</label>
                <textarea class="form-control" id="bk_description"></textarea>
              </div>
            </form>
            {{-- @endform --}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary">Cadastrar</button>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('script')



@endsection
