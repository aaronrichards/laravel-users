@extends(config('laravelusers.bladeLayout'))

@section('template_title')
    showing-user {{$user->name}}
@endsection

@section('styles')
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
                            {{ $user->name }}'s Information
                            <div class="float-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" title="back-users">
                                    Back to Users
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="text-muted text-center">
                            {{ $user->name }}
                        </h4>
                        @if($user->email)
                            <p class="text-center" title="email-user {{$user->email}}">
                                {{ Html::mailto($user->email, $user->email) }}
                            </p>
                        @endif
                        <div class="row mb-4">
                            <div class="col-3 offset-3 col-sm-4 offset-sm-2 col-md-4 offset-md-2 col-lg-3 offset-lg-3">
                                <a href="/users/{{$user->id}}/edit" class="btn btn-block btn-md btn-warning">
                                    Edit User
                                </a>
                            </div>
                            <div class="col-3 col-sm-4 col-md-4 col-lg-3">
                                <form method="POST" action="{{ route('user.destroy', $user->id) }}" class="form-inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <input name="delete-user" type="button" class="btn btn-danger btn-md btn-block'" value="Delete user" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete {{ $user->name }}?">
                                </form>
                            </div>
                        </div>
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
    </div>
    @include('laravelusers::modals.modal-delete')
@endsection

@section('scripts')
    @include('laravelusers::scripts.delete-modal-script')
@endsection
