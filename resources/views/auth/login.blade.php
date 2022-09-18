@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Admin Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post">
                            @csrf

                            <!-- Email-->
                            <div class="form-group my-2">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" name="email" id="email" />
                            </div>
                            <!-- Password -->
                            <div class="form-group my-2">

                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password" />
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary my-2">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
