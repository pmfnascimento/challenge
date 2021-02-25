@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 350px;
            width: 100%;
            z-index: 10002;
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
        <div class="col-5">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Edit Account Driver</strong>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.drivers.update', ['driver' => $driver->id]) }}" method="post"
                        class="form-horizontal">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-4 col-form-label">Name</label>
                            <div class="col-8">
                                <input id="name" name="name" placeholder="Insert the name of driver" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    aria-describedby="nameHelpBlock" value="{{ $driver->name }}">
                                @error('name')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-4 col-form-label">Email</label>
                            <div class="col-8">
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $driver->email }}"
                                    placeholder="Insert the email of driver">
                                @error('email')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-4 col-form-label">Home Location</label>
                            <div class="col-4">
                                <input id="latitude" name="latitude" type="text" placeholder="Latitude"
                                    class="form-control @error('latitude') is-invalid @enderror"
                                    value="{{ $driver->location->latitude }}">
                            </div>
                            <div class="col-4">
                                <input id="longitude" name="longitude" type="text" placeholder="Longitude"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    value="{{ $driver->location->longitude }}">
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
                            <label for="password" class="col-4 col-form-label">Manager</label>
                            <div class="col-8">
                                <select id="manager" class="form-control" name="manager"
                                    aria-describedby="managerHelpBlock">
                                    @foreach ($managers as $manager)
                                        @if ($manager->id == $driver->manager_id)
                                            <option value="{{ $manager->id }}" selected>{{ $manager->name }}
                                            </option>
                                        @else
                                            <option value="{{ $manager->id }}" selected>{{ $manager->name }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                                <span id="managerHelpBlock" class="form-text text-muted">Choose the manager</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <a href="{{ route('admin.drivers.index') }}" class="btn btn-danger btn-sm">Cancelar</a>
                                <button name="submit" type="submit" class="btn btn-success btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Define Location Map
                        Driver</strong>
                </div>
                <div id="map" class="card-body">

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
