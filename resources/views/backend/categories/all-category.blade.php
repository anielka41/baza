@extends('backend.layouts.app')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column p-1 py-2">
                    <h2>Kategorie</h2>
                    <span>Lista kategorii</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-end justify-content-center p-1 py-2 h-100">
                    <a class="btn btn2 text-decoration-none d-flex align-items-center justify-content-center" href="{{Route('createCategory')}}">
                        <i class='bi bi-plus-circle nav_icon me-2'></i>
                        <span class="nav_name fw-bold">Dodaj kategorię</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if(\Session::has('delete'))
        <li class="alert alert-danger">{!! \Session::get('delete') !!}</li>
    @endif
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nr</th>
                        <th scope="col">Kategoria</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Rodzic kategorii</th>
                        <th scope="col">Liczba</th>
                        <th scope="col" class="text-center">Działania</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($categories))

                        <?php $_SESSION['i'] = 0; ?>
                        @foreach($categories as $category)
                            <?php $_SESSION['i']=$_SESSION['i']+1; ?>

                        <tr class="align-middle">
                            <?php $dash=''; ?>
                            <td>{{$_SESSION['i']}}</td>
                            <td><a href="{{Route('editCategory', $category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->slug}}</td>
                            <td>
                                @if(isset($category->parent_id))
                                    {{$category->subcategory->name}}
                                @else
                                    -------
                                @endif

                            </td>
                            <td>
                                @if($category->posts->count())
                                    {{$category->posts->count()}}
                                @else
                                    0
                                @endif
                            </td>
                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn d-flex align-items-center justify-content-center m-auto" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bi bi-three-dots-vertical fs-5'></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center justify-content-start" href="{{Route('editCategory', $category->id)}}">
                                                <i class='bi bi-pencil-square me-1'></i>
                                                Edytuj
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item dropdown-item d-flex align-items-center justify-content-start delete" data-id="{{$category->id}}">
                                                <i class='bi bi-trash me-1'></i>
                                                Usuń
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                            @if(count($category->subcategory))
                                @include('backend.categories.sub-category-list',['subcategories' => $category->subcategory])
                            @endif

                        @endforeach
                        <?php unset($_SESSION['i']); ?>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        let deleteUrl;
        deleteUrl = "{{ url('cp-admin/category') }}/";
    </script>
@endsection

@section('js-files')
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection

