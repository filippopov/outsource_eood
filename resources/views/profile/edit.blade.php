@extends ('layouts.app')

@section ('content')

<form action="/profile/{{$user->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <fieldset>
            <p class="field">
                @if ($user->profile_image)
                    <div>
                        <img src="{{ asset('storage/' . $user->profile_image) }}" width="100"  height="100">
                    </div>
                @endif    
                
                <label for="profile_image">Profile Image</label>
                <span class="input">
                    <input id="profile_image" type="file" class="profile_image" name="profile_image" >
                    <span class="actions"></span>
                    <i class="fas fa-signature"></i>
                </span>

                @error('profile_image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </p>
            
            
            <p class="field">
                <label for="name">{{ __('Name') }}</label>
                <span class="input">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
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
                <label for="lastname">Lastname</label>
                <span class="input">
                    <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
                    <span class="actions"></span>
                    <i class="fas fa-signature"></i>
                </span>

                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </p>

            <p class="field">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <span class="input">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                    <span class="actions"></span>
                    <i class="fas fa-envelope"></i>
                </span>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </p>
        <input type="submit" value="Edit">
    </fieldset>
</form>

@endsection