@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::check())
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Токен доступа</div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <input id="text" type="text" class="form-control"
                                name="api_token" value="{{ Auth::user()->api_token }}" readonly>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('refresh_token') }}">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    Сгенерировать новый токен
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Запрос</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('api_send') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="api_token" class="form-label">Токен</label>
                            <input type="text" name="api_token" class="form-control" id="api_token" value="{{ Auth::user()->api_token }}">
                            @if (Session::has('token_error'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ Session::get('token_error') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                          <label for="date" class="form-label">Дата</label>
                          <input type="date" name="date" class="form-control" id="date" required>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success w-100">
                                    Отправить запрос
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        </div>
        @endif
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Авторизация</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-end">
                                    Email :
                                </label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-end">
                                    Пароль :
                                </label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Войти
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <div class="form-check" style="float: right;">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Запомнить
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                    <div class="card-header">Регистрация</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-end">
                                    Имя :
                                </label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-end">
                                    Email :
                                </label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-end">
                                    Пароль :
                                </label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-end">
                                    Подтверждение пароля :
                                </label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success w-100">
                                        Создать аккаунт
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
