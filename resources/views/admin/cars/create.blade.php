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
    <h1 class="mt-4">Cars</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Managers / Create Manager</li>
    </ol>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Create Car</strong>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.cars.store') }}" method="post" class="form-horizontal">
                        @csrf

                        <div class="form-group row">
                            <label for="brand" class="col-3 col-form-label">Brand</label>
                            <div class="col-8">
                                <input id="brand" name="brand" placeholder="Insert the brand of car" type="text"
                                    class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand') }}">
                                @error('brand')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="model" class="col-3 col-form-label">Model</label>
                            <div class="col-8">
                                <input id="model" name="model" type="text"
                                    class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}"
                                    placeholder="Insert the model of car">
                                @error('model')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="plate_number" class="col-3 col-form-label">Plate Number</label>
                            <div class="col-8">
                                <input id="plate_number" name="plate_number" type="text"
                                    class="form-control @error('plate_number') is-invalid @enderror"
                                    value="{{ old('plate_number') }}" placeholder="Insert the plate number of car">
                                @error('plate_number')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-3 col-form-label">Home Location</label>
                            <div class="col-4">
                                <input id="latitude" name="latitude" type="text" placeholder="Latitude"
                                    class="form-control @error('latitude') is-invalid @enderror">
                                @error('latitude')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <input id="longitude" name="longitude" type="text" placeholder="Longitude"
                                    class="form-control @error('longitude') is-invalid @enderror">
                                @error('longitude')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-3 col-form-label">Manager</label>
                            <div class="col-8">
                                <select id="driver" class="form-control @error('driver') is-invalid @enderror"
                                    name="driver">
                                    <option value="">Select Driver</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }}
                                    @endforeach
                                </select>
                                @error('driver')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="offset-3 col-4">
                                <a href="{{ route('admin.cars.index') }}" class="btn btn-danger btn-block">Cancelar</a>
                            </div>
                            <div class="col-4">
                                <button name="submit" type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-header"><i class="far fa-arrow-alt-circle-up"></i> <strong>Define Home Location Map
                        of Car</strong>
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

            marker = L.marker([41.5189, -8.3647], {
                draggable: true
            }).addTo(map);



            marker.on('dragend', function(e) {
                $('#latitude').val(marker.getLatLng().lat);
                $('#longitude').val(marker.getLatLng().lng);
            });



        });

    </script>
@endsection
