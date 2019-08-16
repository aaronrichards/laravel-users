@extends(config('laravelusers.bladeLayout'))

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            @include('laravelusers::partials.form-status')
        </div>
    </div>

    <form method="POST" action="{{ route('users.update', $user->id) }}" class="needs-validation">
    @method('PATCH')
    @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">

                    <div class="card-header">
                        <div class="col-md-6 d-flex align-items-center">
                            Editing User {{ $user->name }}
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($rolesEnabled)
                        <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">
                            
                            <div class="col-md-9">
                            <div class="input-group">
                                <select class="custom-select form-control" name="role" id="role">
                                    <option value="">Select User Role</option>
                                    @if ($roles)
                                        @foreach($roles as $role)
                                            @if ($currentRole)
                                                <option value="{{ $role->id }}" {{ $currentRole->id == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
                                            @else
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="role">
                                       Name
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('role'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autofocus>

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
                                <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" autofocus>

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
                                <a href="{{ route('users') }}" class="btn btn-primary" title="back-users">Back to Users</a>    
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">Back  <span class="hidden-xs">to User</span></a>
                                <button type="button" name="save-changes" class="btn btn-primary btn-save" data-toggle="modal" data-target="#confirmSave" data-title="Confirm Save" data-message="Please confirm your changes.">Save</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Block -->

    </form>
</div>

@include('laravelusers::modals.modal-save')

@endsection

@section('scripts')
    @include('laravelusers::scripts.save-modal-script')
@endsection
