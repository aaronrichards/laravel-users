@extends(config('laravelusers.bladeLayout'))

@section('content')
<div class="container">
        
    <div class="row">
        <div class="col-md-12">
            @include('laravelusers::partials.form-status')
        </div>
    </div>
    
    <form method="POST" action="{{ route('users.store') }}" class="needs-validation">
    @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="col-md-6 d-flex align-items-center">
                            Create New User
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($rolesEnabled)
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">User Role</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role">
                                     @if ($roles)
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>          
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="" autofocus>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="" autofocus>

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Block -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-center">

                    <div class="card-body">

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <a href="{{ route('users') }}" class="btn btn-primary">Back to users</a>
                                <button type="submit" class="btn btn-primary">
                                    Create User
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- End Block -->

    </form>
</div>
@endsection
