@extends('layouts.app')
@section('content')

<div class="container p-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
      
    <h1 class="mb-4">Dashboard</h1>
    <a href="{{route('admin.apartments.index')}}" class="btn btn-primary">I tuoi appartamenti</a>

</div>
@endsection
