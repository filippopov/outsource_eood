@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('login') }}">
    <fieldset>
        @csrf
        <p class="field">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <span class="input">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <span class="actions"></span>
                <i class="fas fa-envelope"></i>
            </span>

            @error('email')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </p>

        <p class="field">
            <label for="password">{{ __('Password') }}</label>
            <span class="input">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <span class="actions"></span>
                <i class="fas fa-key"></i>
            </span>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </p>
        <input type="submit" value="Login">
    </fieldset>
</form>
@endsection