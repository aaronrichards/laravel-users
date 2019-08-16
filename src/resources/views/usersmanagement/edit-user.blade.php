@extends(config('laravelusers.laravelUsersBladeExtended'))

@section('template_linked_css')
    @include('laravelusers::partials.styles')
    @include('laravelusers::partials.bs-visibility-css')
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            @include('laravelusers::partials.form-status')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Editing User {{ $user->name }}
                        <div class="pull-right">
                            <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" title="Back to users">
                                Back to </span><span class="hidden-xs">Users</span>
                            </a>
                            <a href="{{ url('/users/' . $user->id) }}" class="btn btn-light btn-sm float-right" title="Back to users">
                                Back  <span class="hidden-xs">to User</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('users.update', $user->id) }}" class="needs-validation">
                    @method('PATCH')
                    @csrf
                    
                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $user->name }}">
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            Name
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                            
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="User Email" value="{{ $user->email }}">
                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            User Email
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
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

                        <div class="pw-change-container">
                            <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                                
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">

                                        <div class="input-group-append">
                                            <label class="input-group-text" for="password">
                                                Password
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
                                
                                <div class="col-md-9">
                                    <div class="input-group">

                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="password_confirmation">
                                                Confirm Password
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6 mb-2">
                                <a href="#" class="btn btn-outline-secondary btn-block btn-change-pw mt-3" title="change-pw">
                                    Change Password
                                </a>
                            </div>
                            <div class="col-12 col-sm-6">
                                <button type="button" name="save-changes" class="btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save" data-toggle="modal" data-target="#confirmSave" data-title="Confirm Save" data-message="Please confirm your changes.">Create New User</button>
                            </div>
                        </div>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@include('laravelusers::modals.modal-save')
@include('laravelusers::modals.modal-delete')

@endsection

@section('template_scripts')
    @include('laravelusers::scripts.delete-modal-script')
    @include('laravelusers::scripts.save-modal-script')
    @include('laravelusers::scripts.check-changed')
@endsection
