@extends('layouts.app')

@section('title', 'ArtLover Space')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow rounded-lg p-10 text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Welcome, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mb-8">This space is yours!<br>Features will be added here step by step as you request them.</p>
        <a href="#" class="inline-block px-6 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition" id="edit-profile-btn">Edit Profile</a>
    </div>
</div>
@endsection 