@extends('backend.layouts.app')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column p-1 py-2">
                    <h2>Komentarze</h2>
                    <span>Lista komentarzy</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Treść</th>
                        <th scope="col">Komentarz w</th>
                        <th scope="col">Data publikacji</th>
                        <th scope="col" class="text-center">Działania</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($comments as $comment)
                        <tr class="align-middle">

                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->body }}</td>
                            <td>{{ $comment->commentable_id }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn d-flex align-items-center justify-content-center m-auto" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bi bi-three-dots-vertical fs-5'></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('pages.edit', $comment->id) }}">
                                                <i class='bi bi-pencil-square me-1'></i>
                                                Edytuj
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item dropdown-item d-flex align-items-center justify-content-start delete" data-id="{{ $comment->id }}">
                                                <i class='bi bi-trash me-1'></i>
                                                Usuń
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $comments->onEachSide(2)->links() }}
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        let deleteUrl;
        deleteUrl = "{{ url('cp-admin/comment') }}/";
    </script>
@endsection

@section('js-files')
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection