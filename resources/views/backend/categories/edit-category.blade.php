@extends('backend.layouts.app')

@section('content')

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach
        </div>
    @endif
    @if(\Session::has('error'))
        <div>
            <li class="alert alert-danger">{!! \Session::get('error') !!}</li>
        </div>
    @endif
    @if(\Session::has('success'))
        <div>
            <li class="alert alert-success">{!! \Session::get('success') !!}</li>
        </div>
    @endif

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column p-1 py-2">
                    <h2>Kategorie</h2>
                    <span>Edycja kategorii: {{$category->name}}</span>
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



    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-12 p-5">
                <form role="form" class="px-5" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nazwa kategorii *</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug" hidden>Slug</label>
                        <div class="input-group mt-1">
                            <span class="input-group-text p-1" id="basic-addon3">{{ env('APP_URL') }}/</span>
                            <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{$category->slug}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Wybierz rodzica kategorii</label>
                        <select type="text" name="parent_id" class="form-control form-select">
                            <option value="">Brak</option>
                            @if($categories)
                                @foreach($categories as $item)
                                    <?php $dash=''; ?>
                                    <option value="{{$item->id}}" @if($category->parent_id == $item->id ) selected @endif>{{$item->name}}</option>
                                    @if(count($item->subcategory))
                                        @include('backend.categories.sub-category-list-option-for-update',['subcategories' => $item->subcategory])
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="buttons mt-3">
                        <button type="submit" class="btn btn2">Aktualizuj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection

@section('javascript')
@endsection

@section('js-files')
@endsection


