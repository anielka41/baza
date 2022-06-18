@extends('backend.layouts.app')

@section('content')
    @include('backend.helpers.flash-massages')
    <div class="container-fluid mt-2 mb-5 bg-white p-3 rounded">
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card rounded-5 shadow h-100 py-2 border-left-first-color">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fs-6 fw-bold text-primary text-uppercase mb-1">
                                    Wpisy:
                                </div>
                                <div class="h4 mb-0 fw-bold text-secondary">
                                    {{ $postCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-card-list text-secondary fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card rounded-5 shadow h-100 py-2 border-left-first-color">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fs-6 fw-bold text-primary text-uppercase mb-1">
                                    Użytkownicy:
                                </div>
                                <div class="h4 mb-0 fw-bold text-secondary">
                                    {{ $userCount }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-people text-secondary fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card rounded-5 shadow h-100 py-2 border-left-first-color">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fs-6 fw-bold text-primary text-uppercase mb-1">
                                    Komentarze:
                                </div>
                                <div class="h4 mb-0 fw-bold text-secondary">
                                    111
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-chat-quote text-secondary fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card rounded-5 shadow h-100 py-2 border-left-first-color">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fs-6 fw-bold text-primary text-uppercase mb-1">
                                    Newsletter:
                                </div>
                                <div class="h4 mb-0 fw-bold text-secondary">
                                    123
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-send-plus text-secondary fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </div>
@endsection
