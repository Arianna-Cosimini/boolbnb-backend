@extends('layouts.app')

@section('content')

<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin')}}" class="text-black">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.apartments.index')}}" class="text-black">I tuoi appartamenti</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $apartment->name }}</li>
        </ol>
      </nav>

</div>

@endsection