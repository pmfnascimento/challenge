@extends('layouts.admin')
@section('content')
    <h1 class="mt-4">Managers</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Managers/</li>
    </ol>
    <div class="row justify-content-center">
    <div class="col-10">
        <div class="card mb-4">
            <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Last Managers</strong> <a class="btn btn-success btn-sm float-right" href="">Create +</a></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">nº Drives</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($managers as $item)
                            <tr>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->email }}</td>
                                <td class="text-center">{{ $item->driver_count }}</td>
                                <td class="justify-content-center d-flex">
                                    <a class="btn btn-primary btn-sm mr-2"  href="{{ route('admin.managers.show',['manager' => $item->id]) }}">+ Edit</a>
                                    <form action="" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Delete -</button>
                                    </form>
                                </td>
                            </tr>
                             @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
