@extends('backend.layouts.template')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item">Master Data</li>
                    <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
                    <li class="breadcrumb-item active">Create User</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">User Form</h5>

                            <!-- Custom Styled Validation -->
                            <form action="/admin/users" method="POST" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="col-md-6">
                                    <label for="inputName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputName" value="{{ old('name') }}"
                                        name="name" required>
                                    <div class="invalid-feedback">
                                        Name required
                                    </div>
                                    @error('name')
                                        <div class="text-sm text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="inputUsername"
                                            aria-describedby="inputGroupPrepend" name="username"
                                            value="{{ old('username') }}" required>
                                        <div class="invalid-feedback">
                                            Username required
                                        </div>
                                        @error('username')
                                            <div class="text-sm text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail" value="{{ old('email') }}"
                                        name="email" required>
                                    <div class="invalid-feedback">
                                        Valid email required
                                    </div>
                                    @error('email')
                                        <div class="text-sm text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword" name="password" required
                                        minlength="6">
                                    <div class="invalid-feedback">
                                        Password length at least 6 characters
                                    </div>
                                    @error('password')
                                        <div class="text-sm text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Add User</button>
                                </div>
                            </form><!-- End Custom Styled Validation -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
