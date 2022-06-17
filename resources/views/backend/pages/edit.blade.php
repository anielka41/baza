@extends('backend.layouts.app')

@section('content')
    @include('backend.helpers.flash-massages')
    <div class="container-fluid mt-2 mb-5 bg-white p-3 rounded">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <h1 class="h4 m-0"><i class="bi bi-pencil-square me-2"></i> Edytujesz stronę: {{ $page->title }}</h1>
            </div>
            <div class="col-md-6 text-end">
                <div>
                    <a class="btn btn2 text-decoration-none d-inline-flex align-items-center justify-content-center" href="{{ route('pages.create') }}">
                        <i class='bi bi-plus-circle nav_icon me-2'></i>
                        <span class="nav_name fw-bold">Dodaj stronę</span> </a>
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <form method="POST" action="{{ route('pages.update', $page->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 p-3">
                            <div class="form-group">
                                <label for="title">Tytuł</label>
                                <input type="text" value="{{ $page->title }}" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="slug" hidden>Slug</label>
                                <div class="input-group mt-1">
                                    <span class="input-group-text p-1" id="basic-addon3">{{ env('APP_URL') }}/</span>
                                    <input type="text" value="{{ $page->slug }}" name="slug" id="title" class="p-1 form-control @error('slug') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <label for="content">Content</label>
                                    <div style="font-size: .8em">
                                        [ <div class="word-counter d-inline-block"></div> ]
                                    </div>
                                </div>
                                <textarea name="content" id="content" class="form-control trumbowyg" rows="3">{{ $page->content }}</textarea>
                            </div>

                            <div class="form-group mb-2">
                                <label for="seo_title"> <span>SEO Title</span></label>
                                <input type="text" value="{{ $page->seo_title }}" name="seo_title" id="seo_title" class="form-control" placeholder="Wpisz SEO title">
                            </div>
                            <div class="form-group">
                                <label for="seo_desc"> <span>SEO Description</span></label>
                                <textarea name="seo_desc" class="form-control" rows="3" id="seo_desc">{{ $page->seo_desc }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3 p-3 mt-3">
                            <div class="form-group mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="seo_noindex" name="seo_noindex" value="{{ $page->seo_noindex }}"
                                            {{$page->seo_noindex ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="seo_noindex">Dodaj SEO noindex </label>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="seo_nofollow" name="seo_nofollow" value="{{ $page->seo_nofollow }}"
                                            {{$page->seo_nofollow ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="seo_nofollow">Dodaj SEO nofollow </label>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="comment" name="comment" value="{{ $page->comment }}"
                                            {{$page->comment ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="comment"> Wyłącz Komentarze </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status"> Status: </label>
                                <select class="form-control form-select" id="status" name="status">
                                    <option value="1" {{ ($page->status == 1) ? 'selected' : '' }} > opublikowany</option>
                                    <option value="0" {{ ($page->status == 0) ? 'selected' : '' }}> nieopublikowany</option>
                                </select>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn2 px-5 mt-2">Wyślij</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/trumbowyg.js') }}"></script>
@endsection

