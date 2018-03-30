@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 offset-md-2 mt-3">
            <h2>Entrar a tu cuenta</h2><br><br>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email" class="col-md-4 form-control-label">Correo Electrónico</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-4 form-control-label">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar mis dados
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">
                            Entrar
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
            </form>
            <div class="col-6">
            <a href="/auth/facebook" class="btn btn-primary">Login con facebook</a>
        </div>
        </div>
    </div>
@endsection
