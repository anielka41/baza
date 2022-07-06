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
                        <th scope="col" style="max-width: 500px; display: block;">Treść</th>
                        <th scope="col">Komentarz w</th>
                        <th scope="col">Data publikacji</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Działania</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($comments as $comment)
                        <tr class="align-middle">

                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td style="max-width: 500px; font-size: 14px">{{ $comment->body }}</td>
                            <td>{{ $comment->post->title }}</td>
                            <td style="font-size: 13px">{{ $comment->created_at }}</td>
                            <td>
                                @if($comment->status == 'pending')
                                    <span class="badge bg-info">Oczekuje</span>
                                @elseif($comment->status == 'approved')
                                    <span class="badge bg-success">Zatwierdzony</span>
                                @elseif($comment->status == 'rejected')
                                    <span class="badge bg-danger">Odrzucony</span>
                                @else
                                    <span class="badge bg-secondary text-black">Zawieszony</span>
                                @endif
                            </td>
                            <td>
                                <ul class="p-0 m-0 mb-2 text-end">


                                    <li class="list-inline-item">
                                        <button value="0" type="button" class="btn btn-success btn-sm ajaxSubmit" data-id="{{ $comment->id }}">
                                            <i class="bi bi-check-circle"></i> Zatwierdź
                                        </button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button value="1" type="button" class="btn btn-info btn-sm ajaxSubmit" data-id="{{ $comment->id }}">
                                            <i class="bi bi-question-circle"></i> Oczekuje
                                        </button>
                                    </li>
                                    <li class="list-inline-item">
                                        <button value="2" type="button" class="btn btn-danger btn-sm ajaxSubmit" data-id="{{ $comment->id }}">
                                            <i class="bi bi-dash-circle"></i> Odrzucić
                                        </button>
                                    </li>


                                    <li class="list-inline-item">
                                        <button class="btn btn-secondary btn-sm delete" data-id="{{ $comment->id }}">
                                            <i class="bi bi-trash3"></i> Usuń
                                        </button>
                                    </li>
                                </ul>

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
        let deleteUrl2;
        deleteUrl = "{{ url('cp-admin/comments') }}/";
        deleteUrl2 = "{{ url('cp-admin/comments/update') }}/";
    </script>
@endsection

@section('js-files')
    <script src="{{ asset('js/delete.js') }}"></script>



    <script>
        jQuery(document).ready(function(){
            jQuery('.ajaxSubmit').click(function(e){
                e.preventDefault();

                jQuery.ajax({
                    url: deleteUrl2 + $(this).data("id"),
                    method: 'post',
                    data: {
                        id: $(this).data("id"),
                        value: this.value,
                    },
                    success: function(result){
                        console.log(result);
                        window.location.reload();
                    }});
            });
        });
    </script>
@endsection