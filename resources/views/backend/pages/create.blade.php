@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid mt-2 mb-5 bg-white p-3 rounded">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="h4 m-0"><i class="bi bi-plus-square me-2"></i> Dodaj stronę:</h1>
                <hr>
            </div>
            <div class="col-md-12">
                <form method="POST" action="{{ route('pages.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-9 p-3">
                            <div class="form-group">
                                <label for="title">Tytuł</label>
                                <input type="text" value="" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="slug" hidden>Slug</label>
                                <div class="input-group mt-1">
                                    <span class="input-group-text p-1" id="basic-addon3">{{ env('APP_URL') }}/</span>
                                    <input type="text" value="" name="slug" id="title" class="p-1 form-control @error('slug') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <label for="content">Content</label>
                                    <div style="font-size: .8em">
                                        [ <div class="word-counter d-inline-block"></div> ]
                                    </div>
                                </div>
                                <textarea name="content" id="content" class="form-control trumbowyg" rows="3"></textarea>

                            </div>

                            <div class="form-group mb-2">
                                <label for="seo_title"> <span>SEO Title</span></label>
                                <input type="text" value="" name="seo_title" id="seo_title" class="form-control" placeholder="Wpisz SEO title">
                            </div>
                            <div class="form-group">
                                <label for="seo_desc"> <span>SEO Description</span></label>
                                <textarea name="seo_desc" class="form-control" rows="3" id="seo_desc"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3 p-3 mt-3">
                            <div class="form-group mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="seo_noindex" name="seo_noindex" value="1"
                                            {{ old('seo_noindex', isset($seo_noindex) ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="seo_noindex">Dodaj SEO noindex </label>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="seo_nofollow" name="seo_nofollow" value="1"
                                            {{ old('seo_nofollow', isset($seo_nofollow) ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="seo_nofollow">Dodaj SEO nofollow </label>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="comment" name="comment" value="1"
                                            {{ old('comment', isset($comment) ? 'checked' : '') }}>
                                    <label class="custom-control-label" for="comment"> Wyłącz Komentarze </label>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="status"> Status: </label>
                                <select class="form-control form-select" id="status" name="status">
                                    <option value="1" selected=""> aktywne</option>
                                    <option value="0"> nieaktywne</option>
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