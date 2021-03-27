@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('register') }}">
    @csrf
    <fieldset>
        
        <p class="field">
            <label for="name">{{ __('Name') }}</label>
            <span class="input">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <span class="actions"></span>
                <i class="fas fa-signature"></i>
            </span>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </p>
        
        <p class="field">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            <span class="input">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                <span class="actions"></span>
                <i class="fas fa-envelope"></i>
            </span>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </p>
        
        <p class="field">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            <span class="input">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span class="actions"></span>
                <i class="fas fa-key"></i>
            </span>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </p>
        
        <p class="field">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
            <span class="input">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <span class="actions"></span>
                <i class="fas fa-key"></i>
            </span>
        </p>

        <input type="submit" value="Register">
    </fieldset>
</form>
@endsection
