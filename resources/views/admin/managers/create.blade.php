@extends('layouts.admin')
@section('content')
    <h1 class="mt-4">Managers</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Managers / Create Manager</li>
    </ol>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Edit Account Manager</strong>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.managers.store') }}" method="post" class="form-horizontal">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-2 col-form-label">Name</label>
                            <div class="col-8">
                                <input id="name" name="name" placeholder="Insert the name of manage" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    aria-describedby="nameHelpBlock" value="{{ old('name') }}">
                                @error('name')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email</label>
                            <div class="col-8">
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="Insert the email of manager">
                                @error('email')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Password</label>
                            <div class="col-8">
                                <input id="password" name="password" type="password" class="form-control"
                                    aria-describedby="passwordHelpBlock">
                                <small id="passwordHelpBlock" class="form-text text-muted">Insert the password or left black
                                    for no re-definition</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-2 col-8">
                                <a href="{{ route('admin.managers.index') }}" class="btn btn-danger btn-sm">Cancelar</a>
                                <button name="submit" type="submit" class="btn btn-success btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
