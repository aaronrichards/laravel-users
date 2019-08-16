@extends(config('laravelusers.laravelUsersBladeExtended'))

@section('template_linked_css')
    @include('laravelusers::partials.styles')
    @include('laravelusers::partials.bs-visibility-css')
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12">
            @include('laravelusers::partials.form-status')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            Showing All Users
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a href="{{ route('users.create') }}" class="btn btn-default btn-sm pull-right" title="New User">
                                New User
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if(config('laravelusers.enableSearchUsers'))
                        @include('laravelusers::partials.search-users-form')
                    @endif

                    <div class="table-responsive users-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="user_count">
                                {{ $users->count() }} total users
                            </caption>
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th class="hidden-xs">Email</th>
                                    @if(config('laravelusers.rolesEnabled'))
                                        <th class="hidden-sm hidden-xs">Role</th>
                                    @endif
                                    <th class="hidden-sm hidden-xs hidden-md">Created</th>
                                    <th class="hidden-sm hidden-xs hidden-md">Updated</th>
                                    <th class="no-search no-sort">Actions</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                            </thead>
                            <tbody id="users_table">
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td class="hidden-xs">{{$user->email}}</td>
                                        @if(config('laravelusers.rolesEnabled'))
                                            <td class="hidden-sm hidden-xs">
                                                @foreach ($user->roles as $user_role)
                                                    @if ($user_role->name == 'User')
                                                        @php $badgeClass = 'primary' @endphp
                                                    @elseif ($user_role->name == 'Admin')
                                                        @php $badgeClass = 'warning' @endphp
                                                    @elseif ($user_role->name == 'Unverified')
                                                        @php $badgeClass = 'danger' @endphp
                                                    @else
                                                        @php $badgeClass = 'dark' @endphp
                                                    @endif
                                                    <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>
                                                @endforeach
                                            </td>
                                        @endif
                                        <td class="hidden-sm hidden-xs hidden-md">{{$user->created_at}}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$user->updated_at}}</td>
                                        <td>
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <input name="delete" type="button" class="btn btn-danger btn-sm" value="Delete user" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete {{ $user->name }}">
                                            </form>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('users/' . $user->id) }}" title="show'">
                                                Show
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('users/' . $user->id . '/edit') }}" title="edit">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                                @if(config('laravelusers.enableSearchUsers'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>

                            @if($pagintaionEnabled)
                                {{ $users->links() }}
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('laravelusers::modals.modal-delete')

@endsection

@section('template_scripts')
    @include('laravelusers::scripts.delete-modal-script')
    @include('laravelusers::scripts.save-modal-script')
    @if(config('laravelusers.enableSearchUsers'))
        @include('laravelusers::scripts.search-users')
    @endif
@endsection
