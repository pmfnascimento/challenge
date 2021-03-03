@extends('layouts.managers')
@section('styles')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

@endsection
@section('content')

<h1 class="mt-4">Drivers</h1>
<hr>
<ol class="breadcrumb mb-4 p-2">
    <li class="breadcrumb-item active">Drivers / Create Account Driver </li>
</ol>
<create-drivers :id="{{ $id }}"></create-drivers>

@endsection
