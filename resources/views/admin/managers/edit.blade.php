@extends('layouts.admin')
@section('content')
<h1 class="mt-4">Managers</h1>
<hr>
<ol class="breadcrumb mb-4 p-2">
    <li class="breadcrumb-item active">Managers / Edit Driver / {{ $manager->name }}</li>
</ol>
<div class="row justify-content-center">
    <div class="col-5">
        <div class="card mb-4">
            <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Edit Account Manager</strong>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.managers.update', ['manager' => $manager->id]) }}" method="post"
                    class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-4 col-form-label">Name</label>
                        <div class="col-8">
                            <input id="name" name="name" placeholder="Insert the name of manage" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                aria-describedby="nameHelpBlock" value="{{ $manager->name }}">
                            @error('name')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-4 col-form-label">Email</label>
                        <div class="col-8">
                            <input id="email" name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ $manager->email }}"
                                placeholder="Insert the email of manager">
                            @error('email')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-4 col-form-label">Password</label>
                        <div class="col-8">
                            <input id="password" name="password" type="password" class="form-control"
                                aria-describedby="passwordHelpBlock">
                            <span id="passwordHelpBlock" class="form-text text-muted">Insert the password or left black
                                for no re-definition</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <a href="{{ route('admin.managers.index') }}" class="btn btn-danger btn-sm">Cancelar</a>
                            <button name="submit" type="submit" class="btn btn-success btn-sm">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card mb-4">
            <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>List of Drives Manager</strong>
            </div>
            <div class="card-body">
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">#Id</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Home</th>
                            <th class="text-center">Created At</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($drivers as $driver)
                        <tr>
                            <td class="text-center">{{ $driver->id }}</td>
                            <td class="text-center">{{ $driver->name }}</td>
                            <td class="text-center">{{ $driver->email }}</td>
                            <td class="text-center">{{ $driver->location->latitude }} |
                                {{ $driver->location->latitude }}</td>
                            <td class="text-center">{{ $driver->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
