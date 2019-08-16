@extends(config('laravelusers.bladeLayout'))

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @include('laravelusers::partials.form-status')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">

                    <div class="card-header">
                        <div class="col-md-6 d-flex align-items-center">
                            {{ $user->name }}'s Information
                        </div>
                    </div>
                  
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4 col-sm-3">
                                        <strong>
                                            ID
                                        </strong>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        {{ $user->id }}
                                    </div>
                                </div>
                            </li>
                            @if ($user->name)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                Name
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($user->email)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <strong>
                                                Email
                                            </strong>
                                        </div>
                                        <div class="col-12 col-sm-9">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if(config('laravelusers.rolesEnabled'))
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                Roles
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            @foreach ($user->roles as $user_role)
                                                @if ($user_role->name == 'User')
                                                    @php $labelClass = 'primary' @endphp
                                                @elseif ($user_role->name == 'Admin')
                                                    @php $labelClass = 'warning' @endphp
                                                @elseif ($user_role->name == 'Unverified')
                                                    @php $labelClass = 'danger' @endphp
                                                @else
                                                    @php $labelClass = 'default' @endphp
                                                @endif
                                                <span class="badge badge-{{$labelClass}}">{{ $user_role->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <strong>
                                                User Access Levels
                                            </strong>
                                        </div>
                                        <div class="col-12 col-sm-9">
                                            @if($user->level() >= 5)
                                                <span class="badge badge-primary margin-half margin-left-0">5</span>
                                            @endif
                                            @if($user->level() >= 4)
                                                <span class="badge badge-info margin-half margin-left-0">4</span>
                                            @endif
                                            @if($user->level() >= 3)
                                                <span class="badge badge-success margin-half margin-left-0">3</span>
                                            @endif
                                            @if($user->level() >= 2)
                                                <span class="badge badge-warning margin-half margin-left-0">2</span>
                                            @endif
                                            @if($user->level() >= 1)
                                                <span class="badge badge-default margin-half margin-left-0">1</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($user->created_at)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                Created
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $user->created_at }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($user->updated_at)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                Updated
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $user->updated_at }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            
                        </ul>
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
                                <a href="/users/{{$user->id}}/edit" class="btn btn-primary">Edit User</a>
                                <form method="POST" action="{{ route('user.destroy', $user->id) }}" style="display: inline-block;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <input name="delete-user" type="button" class="btn btn-primary" value="Delete user" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete {{ $user->name }}?">
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- End Block -->

    </div>
    @include('laravelusers::modals.modal-delete')
@endsection

@section('scripts')
    @include('laravelusers::scripts.delete-modal-script')
@endsection
