@extends(config('laravelusers.laravelUsersBladeExtended'))

@section('template_title')
    showing-all-users
@endsection

@section('template_linked_css')
    @include('laravelusers::partials.styles')
    @include('laravelusers::partials.bs-visibility-css')
@endsection

@section('content')
    <div class="container">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="row">
                <div class="col-sm-12">
                    @include('laravelusers::partials.form-status')
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                showing-all-users
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                @if(config('laravelusers.softDeletedEnabled'))
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">
                                            users-menu-alt
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('users.create') }}">
                                                create-new
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/users/deleted">
                                               show-deleted-users
                                            </a>
                                        </li>
                                    </ul>
                                @else
                                    <a href="{{ route('users.create') }}" class="btn btn-default btn-sm pull-right" data-toggle="tooltip" data-placement="left" title="create-new">
                                        create-new
                                    </a>
                                @endif
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
                                    users-table.caption {{$users->count()}}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>users-table.id</th>
                                        <th>users-table.name</th>
                                        <th class="hidden-xs">users-table.email</th>
                                        @if(config('laravelusers.rolesEnabled'))
                                            <th class="hidden-sm hidden-xs">users-table.role</th>
                                        @endif
                                        <th class="hidden-sm hidden-xs hidden-md">users-table.created</th>
                                        <th class="hidden-sm hidden-xs hidden-md">users-table.updated</th>
                                        <th class="no-search no-sort">users-table.actions</th>
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
                                                {!! Form::open(array('url' => 'users/' . $user->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => trans('laravelusers::laravelusers.tooltips.delete'))) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('delete', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'delete_user_title', 'data-message' => 'delete_user_message {{$user->name}}')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('users/' . $user->id) }}" data-toggle="tooltip" title="show'">
                                                    show
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('users/' . $user->id . '/edit') }}" data-toggle="tooltip" title="edit">
                                                    edit
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
    @if(config('laravelusers.tooltipsEnabled'))
        @include('laravelusers::scripts.tooltips')
    @endif
    @if(config('laravelusers.enableSearchUsers'))
        @include('laravelusers::scripts.search-users')
    @endif

@endsection
