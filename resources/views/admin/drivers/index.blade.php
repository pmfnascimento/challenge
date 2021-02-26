@extends('layouts.admin')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
@endsection
@section('content')
    <h1 class="mt-4">Drivers</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Drivers / List</li>
    </ol>

    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Last Drivers</strong> <a
                        class="btn btn-success btn-sm float-right" href="{{ route('admin.drivers.create') }}">Create
                        +</a></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Manager</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drivers as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->name }}</td>
                                        <td class="text-center">{{ $item->email }}</td>
                                        <td class="text-center">{{ $item->manager->name }}</td>
                                        <td class="text-center">{{ $item->created_at->diffForHumans() }}
                                        </td>
                                        <td class="justify-content-center d-flex">
                                            <a class="btn btn-primary btn-sm mr-2"
                                                href="{{ route('admin.drivers.edit', ['driver' => $item->id]) }}">Edit
                                                +</a>
                                            <form method="POST"
                                                action="{{ route('admin.drivers.destroy', [$item->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
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
@section('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
        });

    </script>
@endsection
