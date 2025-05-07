@extends('admin.layouts.app')

@section('content')
<div class="p-6 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-rust serif">
        <i class="fas fa-chalkboard-teacher mr-3"></i>Workshop Management
    </h1>
    
    <div class="flex justify-between items-center mb-8">
        <div></div>
        <a href="{{ route('admin.workshops.create') }}" class="bg-rust hover:bg-coffee text-cream px-5 py-2 rounded-md transition flex items-center">
            <i class="fas fa-plus-circle mr-2"></i> Add New Workshop
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="bg-sand p-6 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-terracotta border-opacity-30">
                        <th class="p-3 text-left text-charcoal">ID</th>
                        <th class="p-3 text-left text-charcoal">Title</th>
                        <th class="p-3 text-left text-charcoal">Date</th>
                        <th class="p-3 text-left text-charcoal">Level</th>
                        <th class="p-3 text-left text-charcoal">Status</th>
                        <th class="p-3 text-left text-charcoal">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($workshops as $workshop)
                    <tr class="border-b border-terracotta border-opacity-20 hover:bg-terracotta hover:bg-opacity-10">
                        <td class="p-3">{{ $workshop->id }}</td>
                        <td class="p-3">
                            <div class="flex items-center">
                                <i class="fas fa-chalkboard text-coffee mr-2"></i>
                                {{ $workshop->title }}
                            </div>
                        </td>
                        <td class="p-3">
                            <div class="flex items-center">
                                <i class="far fa-calendar text-coffee mr-2"></i>
                                {{ $workshop->date ? $workshop->date->format('d/m/Y') : 'N/A' }}
                            </div>
                        </td>
                        <td class="p-3">
                            <span class="px-3 py-1 text-xs rounded-full flex items-center w-fit
                                {{ $workshop->skill_level == 'beginner' ? 'bg-terracotta text-cream' : 
                                   ($workshop->skill_level == 'intermediate' ? 'bg-coffee text-cream' : 'bg-rust text-cream') }}">
                                <i class="fas {{ $workshop->skill_level == 'beginner' ? 'fa-seedling' : 
                                                 ($workshop->skill_level == 'intermediate' ? 'fa-star-half-alt' : 'fa-star') }} mr-1"></i>
                                {{ ucfirst($workshop->skill_level) }}
                            </span>
                        </td>
                        <td class="p-3">
                            <span class="px-3 py-1 text-xs rounded-full flex items-center w-fit
                                {{ $workshop->is_active ? 'bg-terracotta text-cream' : 'bg-rust text-cream' }}">
                                <i class="fas {{ $workshop->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                {{ $workshop->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.workshops.edit', $workshop) }}" 
                                   class="px-3 py-1 bg-coffee text-cream rounded-full hover:bg-terracotta transition flex items-center text-xs">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                
                                <form action="{{ route('admin.workshops.destroy', $workshop) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this workshop?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-rust text-cream rounded-full hover:bg-coffee transition flex items-center text-xs">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-coffee italic">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-info-circle mr-2"></i> No workshops found
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-6">
        {{ $workshops->links() }}
    </div>
</div>
@endsection 