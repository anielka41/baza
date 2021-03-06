@extends('backend.layouts.app')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column p-1 py-2">
                    <h2>Publikacje</h2>
                    <span>Lista publikacji</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-end justify-content-center p-1 py-2 h-100">
                    <a class="btn btn2 text-decoration-none d-flex align-items-center justify-content-center" href="{{ route('posts.create') }}">
                        <i class='bi bi-plus-circle nav_icon me-2'></i>
                        <span class="nav_name fw-bold">Dodaj wpis</span>
                    </a>
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
                        <th scope="col">Tytuł</th>
                        <th scope="col">Data publikacji</th>
                        <th scope="col" class="text-center">Działania</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr class="align-middle">
                            <th scope="row">{{ $post->id }}</th>
                            <td><a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn d-flex align-items-center justify-content-center m-auto" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bi bi-three-dots-vertical fs-5'></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{ route('posts.edit', $post->id) }}">
                                                <i class='bi bi-pencil-square me-1'></i>
                                                Edytuj
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item dropdown-item d-flex align-items-center justify-content-start delete" data-id="{{ $post->id }}">
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
                {{ $posts->onEachSide(2)->links() }}
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        let deleteUrl;
        deleteUrl = "{{ url('cp-admin/posts') }}/";
    </script>
@endsection

@section('js-files')
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection