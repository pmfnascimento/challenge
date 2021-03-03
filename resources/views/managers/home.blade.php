@extends('layouts.managers')

@section('content')

<h1 class="mt-4">Home</h1>
<hr>
<ol class="breadcrumb mb-4 p-2">
    <li class="breadcrumb-item active">Home</li>
</ol>

<list-drivers :user="{{ Auth::guard('manager')->user()->id }}"></list-drivers>

@endsection
