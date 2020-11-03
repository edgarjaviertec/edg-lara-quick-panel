@extends('layouts.dashboard')

@section('title', 'Homepage')

@section('content')
<h1 class="h3">Welcome {{ auth()->user()->name }}</h1>
@endsection