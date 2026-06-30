@extends('layouts.landing')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-2xl font-bold text-white">
    Welcome back, {{ Auth::user()->name }}
</h1>

<div class="mt-6">
    <p>Your dashboard content here</p>
</div>

@endsection