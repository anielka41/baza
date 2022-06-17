@extends('backend.layouts.app')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column p-1 py-2">
                    <h2>Kategorie</h2>
                    <span>Stwórz kategorię</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-column align-items-end justify-content-center p-1 py-2 h-100">
                    <a class="btn btn2 text-decoration-none d-flex align-items-center justify-content-center" href="{{Route('allCategories')}}">
                        <i class='bi bi-plus-circle nav_icon me-2'></i>
                        <span class="nav_name fw-bold">Lista kategorii</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
            <div class="col-12 p-5">
                <form role="form" class="px-5" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nazwa kategorii *</label>
                        <input type="text" name="name" id="name" class="form-control value="{{old('name')}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="slug" hidden>Slug</label>
                        <div class="input-group mt-1">
                            <span class="input-group-text p-1" id="basic-addon3">{{ env('APP_URL') }}/</span>
                            <input type="text" name="slug" class="form-control" placeholder="Slug" value="{{old('slug')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Wybierz rodzica kategorii</label>
                        <select type="text" name="parent_id" class="form-control form-select">
                            <option value="">Brak</option>
                            @if($categories)
                                @foreach($categories as $category)
                                    <?php $dash=''; ?>
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @if(count($category->subcategory))
                                        @include('backend.categories.subcategoryList-option',['subcategories' => $category->subcategory])
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="buttons mt-3">
                        <button type="submit" class="btn btn2">Stwórz</button>
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
