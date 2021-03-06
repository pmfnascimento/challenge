@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
            z-index: 1001;
        }

    </style>
@endsection

@section('content')
    <h1 class="mt-4">Drivers</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Drivers / {{ $driver->name }} </li>
    </ol>

    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Edit Account Driver</strong>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.drivers.update', ['driver' => $driver->id]) }}" method="post"
                        class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-2 col-form-label">Name</label>
                            <div class="col-10">
                                <input id="name" name="name" placeholder="Insert the name of driver" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    aria-describedby="nameHelpBlock" value="{{ $driver->name }}">
                                @error('name')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email</label>
                            <div class="col-10">
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $driver->email }}"
                                    placeholder="Insert the email of driver">
                                @error('email')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Home</label>
                            <div class="col-5">
                                <input id="latitude" name="latitude" type="text" placeholder="Latitude"
                                    class="form-control @error('latitude') is-invalid @enderror"
                                    value="{{ $driver->location->latitude }}">
                                @error('latitude')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <input id="longitude" name="longitude" type="text" placeholder="Longitude"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    value="{{ $driver->location->longitude }}">
                                @error('longitude')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Password</label>
                            <div class="col-10">
                                <input id="password" name="password" type="password" class="form-control"
                                    aria-describedby="passwordHelpBlock">
                                <span id="passwordHelpBlock" class="form-text text-muted">Insert the password or left black
                                    for no re-definition</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Manager</label>
                            <div class="col-10">
                                <select id="manager" class="form-control" name="manager"
                                    aria-describedby="managerHelpBlock">
                                    @foreach ($managers as $manager)
                                        @if ($manager->id == $driver->manager_id)
                                            <option value="{{ $manager->id }}" selected>{{ $manager->name }}
                                            </option>
                                        @else
                                            <option value="{{ $manager->id }}">{{ $manager->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-2 col-5">
                                <a href="{{ route('admin.drivers.index') }}"
                                    class="btn btn-danger btn-block">Cancelar</a>
                            </div>
                            <div class="col-5">
                                <button name="submit" type="submit" class="btn btn-success btn-block">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Define Location Map
                        Driver (Drag the marker to choose coordinates)</strong>
                </div>
                <div id="map" class="card-body">

                </div>
            </div>
        </div>

        <div class="col-11">
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
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td class="text-center">{{ $car->brand }}</td>
                                        <td class="text-center">{{ $car->model }}</td>
                                        <td class="text-center">{{ $car->location->latitude }} |
                                            {{ $car->location->latitude }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-success"
                                                href="{{ route('admin.cars.edit', ['car' => $car->id]) }}">Edit
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
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        $(document).ready(function() {
            var map = L.map('map').setView([41.5538, -7.8387], 9);
            var marker;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var lat = $('#latitude').val();
            var lon = $('#longitude').val();

            marker = L.marker([lat, lon], {
                draggable: true
            }).addTo(map);



            marker.on('dragend', function(e) {
                $('#latitude').val(marker.getLatLng().lat);
                $('#longitude').val(marker.getLatLng().lng);
            });



        });

    </script>
@endsection
