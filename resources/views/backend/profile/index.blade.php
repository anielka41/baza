@extends('backend.layouts.app')

@section('content')
    @include('backend.helpers.flash-massages')

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img alt="{{ $user->name }}" class="rounded-circle mt-5 mb-2" width="150" height="150" src="/uploads/avatars/{{ $user->avatar }}">
                    <span class="font-weight-bold">{{ $user->name }}</span>
                    <span class="text-black-50">{{ $user->email }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right"> Informacje o Profilu</h4>
                    </div>


                    <div class="card mt-5">
                        <div class="card-header">{{ __('Avatar (opcjonalnie) 150 x 150') }}</div>

                        <form action="{{ route('profile-avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div>
                                    <label for="avatar" class="col-12 col-form-label text-md-right" hidden></label>
                                    <input id="avatar" type="file" class="form-control" name="avatar">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn2">Zapisz</button>
                            </div>

                        </form>
                    </div>


                    <div class="card mt-5">
                        <div class="card-header">{{ __('Zmiana hasła') }}</div>

                        <form action="{{ route('update-name') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nazwa użytkownika</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="oldPasswordInput" value="{{ $user->name }}" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn2">Zapisz</button>
                            </div>

                        </form>
                    </div>


                    <div class="card mt-5">
                        <div class="card-header">{{ __('Zmiana hasła') }}</div>

                        <form action="{{ route('update-password') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="oldPasswordInput" class="form-label">Aktualne hasło</label>
                                    <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" placeholder="Aktualne hasło" required>
                                    @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="newPasswordInput" class="form-label">Nowe hasło</label>
                                    <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="Nowe hasło" required>
                                    @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirmNewPasswordInput" class="form-label">Ponownie nowe hasło</label>
                                    <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" placeholder="Potwierdź nowe hasło" required>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn2">Wyślij</button>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
