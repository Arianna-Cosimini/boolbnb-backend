@extends('layouts.app')
@section('content')

<div class="container py-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
      
    <h1 class="mb-4 fs-2">Dashboard</h1>
    <a href="{{route('admin.apartments.index')}}" class="btn btn-danger button-red text-white">I tuoi annunci</a> <br>
    <a href="{{route('admin.messages.index')}}" class="btn btn-danger button-red text-white mt-3">I tuoi messaggi</a>

</div>
@endsection
