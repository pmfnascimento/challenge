@extends('layouts.admin')
@section('content')
    <h1 class="mt-4">Managers</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Managers / {{ $manager->name }}</li>
    </ol>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Edit Account Manager</strong>
                </div>
                <div class="card-body">

                    <form action="" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')


                        <div class="form-group row">
                            <label for="name" class="col-2 col-form-label">Name</label>
                            <div class="col-8">
                                <input id="name" name="name" placeholder="Insert Name" type="text" class="form-control"
                                    required="required" aria-describedby="nameHelpBlock" value="{{ $manager->name }}">
                                <span id="nameHelpBlock" class="form-text text-muted">Insert the name of manage</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email</label>
                            <div class="col-8">
                                <input id="email" name="email" type="email" class="form-control" required="required"
                                    aria-describedby="emailHelpBlock" value="{{ $manager->email }}">
                                <span id="emailHelpBlock" class="form-text text-muted">Insert the email of manager</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Password</label>
                            <div class="col-8">
                                <input id="password" name="password" type="password" class="form-control"
                                    required="required" aria-describedby="passwordHelpBlock">
                                <span id="passwordHelpBlock" class="form-text text-muted">Insert the password or left black
                                    for no re-definition</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-2 col-8">
                                <button name="submit" type="submit" class="btn btn-success btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>List of Drives Manager</strong>
                    <a href="#" class="btn btn-success btn-sm float-right">Add</a>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form action="" method="post" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Select Driver</label>
                                    <div class="col-8">
                                        <select id="driver_id" name="driver_id" class="form-control" required="required"
                                            aria-describedby="driverHelpBlock">
                                            <option value="">Add Driver to Manager</option>
                                            @foreach ($driversAll as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#Id</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Home</th>
                                <th class="text-center">Actions</th>
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
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
