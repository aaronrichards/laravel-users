@extends(config('laravelusers.bladeLayout'))

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            @include('laravelusers::partials.form-status')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            Showing All Users
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('users.create') }}" class="btn btn-primary float-sm-right">Create a new user</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="hidden-xs">Email</th>
                                @if(config('laravelusers.rolesEnabled'))
                                    <th scope="col" class="hidden-sm hidden-xs">Role</th>
                                @endif
                                <th scope="col" class="hidden-sm hidden-xs hidden-md">Created</th>
                                <th scope="col" class="hidden-sm hidden-xs hidden-md">Updated</th>
                                <th scope="col" class="no-search no-sort">Actions</th>
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
                                                @elseif ($user_role->name == 'Disabled')
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
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('users.show', $user->id) }}" title="show'">Show</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('users.edit', $user->id) }}" title="edit">Edit</a>
       
                                        <form method="POST" action="{{ route('user.destroy', $user->id) }}" style="display: inline-block;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input name="delete" type="button" class="btn btn-outline-primary btn-sm" value="Delete" data-toggle="modal" data-target="#confirmDelete" data-title="Delete" data-message="Are you sure you want to delete {{ $user->name }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                

                    <div class="text-center">
                        {{ $users->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@include('laravelusers::modals.modal-delete')

@endsection

@section('scripts')
    @include('laravelusers::scripts.delete-modal-script')
    @include('laravelusers::scripts.save-modal-script')
@endsection
