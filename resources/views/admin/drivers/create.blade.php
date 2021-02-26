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
        <li class="breadcrumb-item active">Drivers / Create Acount Driver </li>
    </ol>

    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Create Account Driver</strong>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.drivers.store') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-2 col-form-label">Name</label>
                            <div class="col-10">
                                <input id="name" name="name" placeholder="Insert the name of driver" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    aria-describedby="nameHelpBlock" value="{{ old('name') }}">
                                @error('name')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email</label>
                            <div class="col-10">
                                <input id="email" name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Insert the email of driver" value="{{ old('email') }}">
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
                                    value="{{ old('latitude') }}">
                                @error('latitude')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <input id="longitude" name="longitude" type="text" placeholder="Longitude"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    value="{{ old('longitude') }}">
                                @error('longitude')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Password</label>
                            <div class="col-10">
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    aria-describedby="passwordHelpBlock" value="{{ old('password') }}">
                                @error('password')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Manager</label>
                            <div class="col-10">
                                <select id="manager" class="form-control @error('manager') is-invalid @enderror"
                                    name="manager" aria-describedby="managerHelpBlock">
                                    <option value="">Select Manager</option>
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }} {{ old('manager') }}">
                                            {{ $manager->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('manager')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
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

            var lat = 41.5538;
            var lon = -7.8387;

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
