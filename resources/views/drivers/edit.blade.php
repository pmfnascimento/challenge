@extends('layouts.drivers',['managers' => $managers])
@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection
@section('content')
    <h1 class="mt-4">Home</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Home/ Edit Car</li>
    </ol>

    <edit-cars :id="{{ $id }}"></edit-cars>
@endsection
