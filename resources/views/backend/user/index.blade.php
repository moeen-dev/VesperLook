@extends('layouts.backend')
@section('title', 'Users')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users Table</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ Route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Users</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Users</h2>
                <p class="section-lead">All of your Users here</p>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    Create an User</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">User Name</th>
                                                <th scope="col">User Category</th>
                                                <th scope="col">User Email</th>
                                                <th scope="col">Verified User</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($users->count() > 0)
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->is_admin == 1 ? 'Admin' : 'User' }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            @if ($user->email_verified_at)
                                                                <span class="badge badge-success">Verified</span>
                                                            @else
                                                                <span class="badge badge-danger">Not Verified</span>
                                                            @endif

                                                            @if ($user->is_online == 1)
                                                                <span class="badge badge-success">Online</span>
                                                            @else
                                                                <span class="badge badge-danger">Offline</span>
                                                            @endif
                                                        </td>
                                                        <td class="d-flex justify-content-center align-items-center"
                                                            style="gap: 10px;">
                                                            <a href="{{ route('users.edit', $user->id) }}"
                                                                class="btn btn-primary" data-toggle="tooltip"
                                                                title="Edit this user"><i class="far fa-edit"></i> Edit</a>
                                                            <a href="{{ route('users.show', $user->id) }}"
                                                                class="btn btn-info" data-toggle="tooltip"
                                                                title="Show this user"><i class="fas fa-info-circle"></i>
                                                                Show</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center text-danger">
                                                        <p>No Data Found!</p>
                                                        <a href="{{ route('users.create') }}" class="btn btn-primary">Create
                                                            a new one</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
