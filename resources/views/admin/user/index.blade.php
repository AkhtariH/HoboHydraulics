@extends('layout.app')

@section('title', 'Manage users')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="custom-header">
        <h3>Users <a href="{{ route('admin.user.create') }}" class="badge badge-success"><i class="fa fa-plus"></i> Add user</a></h3>
    </div>
    <hr/>
    <h4>Customers</h4>
    <div class="row pl-0">
        @if (!$customers->isEmpty())
            @foreach ($customers as $customer)
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3 user-card">
                    <form action="{{ route('admin.user.destroy', $customer->id) }}" method="post" class="removeForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="deleteButton close" onclick="return confirm('Are you sure?')">
                            <i class="far fa-times-circle"></i>
                        </button>
                    </form>
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                                <img src="{{ asset('/img/uploads') . '/' . $customer->profile_image }}" alt="profilePic" class="rounded-circle" width="50" height="50">
                            </div>
                            <div class="media-body pl-2">
                                <h5 class="mt-0 mb-0"><strong><a href="{{ route('admin.user.show', $customer->id) }}" class="bootstrap-link">{{ $customer->name }}</a></strong> <a href="{{ route('admin.user.edit', $customer->id) }}"><span class="edit-user"><i class="fas fa-pencil-alt"></i></span></a></h5>
                                <p><small class="text-muted bc-description">{{ ucfirst($customer->type) }}</small></p>
                                <p><small class="text-muted bc-description">{{ $customer->email }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3 user-card">
            <p>No customers found!</p>
        </div>
        @endif
    </div>

    <h4 style="margin-top: 15px">Employees</h4>
    <div class="row pl-0">
        @if (!$employees->isEmpty())
            @foreach ($employees as $employee)
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3 user-card">
                    <form action="{{ route('admin.user.destroy', $employee->id) }}" method="post" class="removeForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="deleteButton close" onclick="return confirm('Are you sure?')">
                            <i class="far fa-times-circle"></i>
                        </button>
                    </form>
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon bg-theme">
                                <img src="{{ asset('/img/uploads') . '/' .$employee->profile_image }}" alt="profilePic" class="rounded-circle" width="50" height="50">
                            </div>
                            <div class="media-body pl-2">
                                <h5 class="mt-0 mb-0"><strong><a href="{{ route('admin.user.show', $employee->id) }}" class="bootstrap-link">{{ $employee->name }}</a></strong> <a href="{{ route('admin.user.edit', $employee->id) }}"><span class="edit-user"><i class="fas fa-pencil-alt"></i></span></a></h5>
                                <p><small class="text-muted bc-description">{{ ucfirst($employee->type) }}</small></p>
                                <p><small class="text-muted bc-description">{{ $employee->email }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3 user-card">
                <p>No employees found!</p>
            </div>
        @endif
    </div>

    <h4 style="margin-top: 15px">Administrators</h4>
    <div class="row pl-0">
        @if (!$admins->isEmpty())
            @foreach ($admins as $admin)
                <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3 user-card">
                    @if ($admin->id != Auth()->user()->id)
                        <form action="{{ route('admin.user.destroy', $admin->id) }}" method="post" class="removeForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="deleteButton close" onclick="return confirm('Are you sure?')">
                                <i class="far fa-times-circle"></i>
                            </button>
                        </form>
                    @endif
                    <div class="bg-white border shadow">
                        <div class="media p-4">
                            <div class="align-self-center mr-3 rounded-circle notify-icon">
                                <img src="{{ asset('/img/uploads') . '/' . $admin->profile_image }}" alt="profilePic" class="rounded-circle" width="50" height="50">
                            </div>
                            <div class="media-body pl-2">
                                <h5 class="mt-0 mb-0"><strong><a href="{{ route('admin.user.show', $admin->id) }}" class="bootstrap-link">{{ $admin->name }}</a></strong> <a href="{{ route('admin.user.edit', $admin->id) }}"><span class="edit-user"><i class="fas fa-pencil-alt"></i></span></a></h5>
                                <p><small class="text-muted bc-description">{{ ucfirst($admin->type) }}</small></p>
                                <p><small class="text-muted bc-description">{{ $admin->email }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-3 user-card">
                <p>No administrators found!</p>
            </div>
        @endif
    </div>
@endsection