@include('layouts.drivers')
@section('content')
    <h1 class="mt-4">Home</h1>
    <hr>
    <ol class="breadcrumb mb-4 p-2">
        <li class="breadcrumb-item active">Home/</li>
    </ol>

    <list-cars :user="{{ Auth::guard('driver')->user()->id }}"></list-cars>

@endsection
