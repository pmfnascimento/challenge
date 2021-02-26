@extends('layouts.admin')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
@endsection
@section('content')
    <h1 class="mt-4">Locations</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Locations / List</li>
    </ol>

    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Last Locations</strong></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">id</th>
                                    <th class="text-center">Longitude</th>
                                    <th class="text-center">Latitude</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">From</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->id }}</td>
                                        <td class="text-center">{{ $item->longitude }}</td>
                                        <td class="text-center">{{ $item->latitude }}</td>
                                        <td class="text-center">{{ $item->location_created_at }}
                                        </td>
                                        @if ($item->driver_location != null)
                                            <td class="text-center">
                                                Driver
                                            </td>
                                        @elseif ($item->car_location != null)
                                            <td class="text-center">
                                                Car
                                            </td>
                                        @endif
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
