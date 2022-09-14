@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="p-2 flex-shrink-0 bd-highlight">
                    <button type="button" class="btn btn-primary" id="btn-add" data-bs-toggle="modal"
                        data-bs-target="#formModal">
                        New User
                    </button>

                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Users</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">User Email</th>
                                    <th scope="col">User Phone</th>
                                    <th scope="col">User Role</th>
                                    <th scope="col">Option</th>

                                </tr>
                            </thead>
                            <tbody id="users-list">
                                @foreach ($users as $user)
                                    <tr id="user{{ $user->id }}">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            @if ($user->role_id == 1)
                                                Employee
                                            @else
                                                Manager
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-warning edit" id="{{$user->id}}">Edit</button>
                                            <button class="btn btn-danger remove" id="{{$user->id}}">Reomve</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="myForm" name="myForm" class="form-horizontal" novalidate="">


                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter name" value="">
                                </div>
                                <div class="form-group">
                                    <label>User Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter email" value="">
                                </div>

                                <div class="form-group">
                                    <label>User Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter phone" value="">
                                </div>
                                <!-- Password -->
                                <div class="form-group my-2">

                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password" id="password" />
                                </div>
                                <!-- Confirm password -->
                                <div class="form-group my-2">
                                    <label for="password_confirmation">Confirm password</label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation" />
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="1">Employee</option>
                                        <option value="2">Manager</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">Save
                                changes
                            </button>
                            <button type="button" class="btn btn-primary" id="btn-update" value="add">Save
                                changes
                            </button>
                            <input type="hidden" id="user_id" name="user_id" value="0">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('dashboard')
    <script src="{{ asset('js/admin/dashboard.js') }}" defer></script>
@endsection
