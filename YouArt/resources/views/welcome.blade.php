@extends('layouts.app')

@section('title', 'Welcome to YouArt')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">Welcome to YouArt</h1>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">The platform for artists to showcase their talent and for art enthusiasts to discover amazing artwork.</p>
            </div>
            
            <div class="mt-12">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <div class="flex flex-col bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">For Artists</h3>
                            <div class="mt-2 max-w-xl text-sm text-gray-500">
                                <p>Create your gallery, showcase your artwork, and connect with art enthusiasts.</p>
                            </div>
                            <div class="mt-5">
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Join as an Artist
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">For Art Enthusiasts</h3>
                            <div class="mt-2 max-w-xl text-sm text-gray-500">
                                <p>Discover amazing artwork, follow your favorite artists, and build your collection.</p>
                            </div>
                            <div class="mt-5">
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Join as an Enthusiast
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900">Why Join YouArt?</h2>
                <div class="mt-6 grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <!-- Icon placeholder -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Showcase Your Art</h3>
                        <p class="mt-2 text-gray-500">Create a personalized gallery to display your artwork to a global audience.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Sell Your Work</h3>
                        <p class="mt-2 text-gray-500">Set up your shop to sell original pieces or participate in exciting art auctions.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">Join a Community</h3>
                        <p class="mt-2 text-gray-500">Connect with fellow artists and art enthusiasts to share ideas and inspiration.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection