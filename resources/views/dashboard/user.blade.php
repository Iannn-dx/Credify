@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-2xl font-bold text-black">
    Welcome back, {{ Auth::user()->name }}
</h1>

<div class="mt-6">
    <p>Your dashboard content here</p>
</div>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button type="submit" class="text-red-500 hover:underline">
        Logout
    </button>
</form>

@endsection