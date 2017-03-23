@extends('layouts.app')

@section('content')

    {{-- Table --}}
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Título</th>
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

    @section('btn-modal')
    {{-- Modal's button --}}
    <a type="button" data-toggle="modal" data-target="#exampleModal">Cadastrar Livro</a>
    @endsection
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
            <form action="{{ url('/') }}" method="POST"> {{ csrf_field() }}
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
                  @foreach($publishers as $pub_id => $pub_name)
                    <option value="{{ $pub_id }}">{{ $pub_name }}</option>
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </form>
        {{-- @endform --}}
        </div>
      </div>
    </div>

@endsection

@section('script')



@endsection
