@extends('backend.layouts.app')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold">{{ $user->name }}</span>
                    <span class="text-black-50">{{ $user->email }}</span>
                </div>
            </div>
            <div class="col-md-8 border-right">

                <div class="p-3 py-5">
                    <div class="card">
                        <div class="card-header">{{ __('Zmiana hasła') }}</div>

                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @elseif (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

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

@section('javascript')

@endsection
