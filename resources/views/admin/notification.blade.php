@extends('layouts.admin')

@section('titleNotification')
  {{-- <h3 style="display:inline; margin-left:10px">Usuários </h3> --}}
  Notificaçoes
@endsection

@section('thTableNotification')
  @if(count($notifications) > 0)
    <th>Usuário</th>
    <th>Livro</th>
    <th>Opções</th>
  @else
    <p id="p">Não foram encontrados resultados</p>
  @endif
@endsection

@section('tableBodyNotification')
    @foreach ($notifications as $notification)
      <tr>
        <td>{{ $notification->user->name }}</td>
        <td>{{ $notification->book->bk_name }}</td>
        <td>
          <button class="btn btn-success" type="button" name="accept"></button>
          <button class="btn btn-danger" type="button" name="decline"></button>
        </td>
      </tr>
    @endforeach
@endsection

@section('col-md')
  <div class="col-md-6">
@endsection
