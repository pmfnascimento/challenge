@extends('layouts.admin')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
@endsection
@section('content')
    <h1 class="mt-4">Cars</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Cars / List</li>
    </ol>

    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Cars</strong>
                    <a href="{{ route('admin.cars.create') }}" class="btn btn-success float-right">Create Car +</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Brand</th>
                                    <th class="text-center">Model</th>
                                    <th class="text-center">Plate Number</th>
                                    <th class="text-center">Driver</th>
                                    <th class="text-center">Actual Position</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->brand }}</td>
                                        <td class="text-center">{{ $item->model }}</td>
                                        <td class="text-center">{{ $item->plate_number }}</td>
                                        <td class="text-center">{{ $item->driver->name }}</td>
                                        <td class="text-center">
                                            {{ $item->location->latitude }} | {{ $item->location->longitude }}
                                        </td>
                                        <td class="text-center">{{ $item->created_at->diffForHumans() }}
                                        </td>
                                        <td class="justify-content-center d-flex">
                                            <a href="{{ route('admin.cars.edit', ['car' => $item->id]) }}"
                                                class="btn btn-secondary mr-2">Edit +</a>
                                            <form method="POST" action="{{ route('admin.cars.destroy', [$item->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">Delete -</button>
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
