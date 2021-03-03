@extends('layouts.admin')
@section('styles')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
@endsection
@section('content')
<h1 class="mt-4">Home</h1>
<hr>
<ol class="breadcrumb mb-4 p-2">
    <li class="breadcrumb-item active">Home/</li>
</ol>
<div class="row justify-content-center">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h4>Managers</h4>
                <h2 class="float-right mr-2">{{ $managers }}</h2>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <h4>Drivers</h4>
                <h2 class="float-right mr-2">{{ $drivers }}</h2>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body">
                <h4>Cars</h4>
                <h2 class="float-right mr-2">{{ $cars }}</h2>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body">
                <h4>Users Admin</h4>
                <h2 class="float-right mr-2">{{ $users }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-9">
        <div class="card mb-4">
            <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Last Managers</strong></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">nº Drives</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastManagers as $item)


                            <tr>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->email }}</td>
                                <td class="text-center">{{ $item->driver_count }}</td>
                                <td class="text-center">{{ $item->created_at->diffForHumans() }}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-success btn-sm" href="{{ route('admin.managers.index') }}">Show
                                        +</a>
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
<div class="row justify-content-center">
    <div class="col-9">
        <div class="card mb-4">
            <div class="card-header">
                <i class="far fa-arrow-alt-circle-up"></i> <strong>Last Drivers</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Manager</th>
                                <th class="text-center">Home</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastDrivers as $driver)
                            <tr>
                                <td class="text-center">{{ $driver->name }}</td>
                                <td class="text-center">{{ $driver->email }}</td>
                                <td class="text-center">{{ $driver->manager->name }}</td>
                                <td class="text-center">{{ $driver->location->latitude }} |
                                    {{ $driver->location->latitude }}</td>
                                <td class="text-center">
                                    <a class="btn btn-success btn-sm" href="{{ route('admin.drivers.index') }}">Show
                                        +</a>
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
<div class="row justify-content-center">
    <div class="col-9">
        <div class="card mb-4">
            <div class="card-header">
                <i class="far fa-arrow-alt-circle-up"></i> <strong>Last Cars</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Band</th>
                                <th class="text-center">Model</th>
                                <th class="text-center">Actual Location</th>
                                <th class="text-center">Driver</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastCars as $cars)
                            <tr>
                                <td class="text-center">{{ $cars->brand }}</td>
                                <td class="text-center">{{ $cars->model }}</td>
                                <td class="text-center">{{ $cars->location->latitude }} |
                                    {{ $cars->location->latitude }}</td>
                                <td class="text-center">{{ $cars->driver->name }}</td>
                                <td class="text-center">
                                    <a class="btn btn-success btn-sm" href="{{ route('admin.cars.index') }}">Show
                                        +</a>
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
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $('.dataTable').DataTable();
    });

</script>
@endsection
