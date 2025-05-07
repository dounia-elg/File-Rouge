@extends('admin.layouts.app')

@section('content')
<div class="p-6 bg-cream">
    <h1 class="text-3xl font-bold mb-8 text-rust serif">
        <i class="fas fa-palette mr-3"></i>Artwork Management
    </h1>
    
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-sand p-6 rounded-lg shadow-md transition hover:shadow-lg">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-medium text-coffee">Available Artworks</h2>
                <i class="fas fa-image text-2xl text-terracotta opacity-50"></i>
            </div>
            <p class="text-4xl font-bold text-terracotta serif">{{ $availableArtworks->count() }}</p>
        </div>
        
        <div class="bg-sand p-6 rounded-lg shadow-md transition hover:shadow-lg">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-medium text-coffee">Sold Artworks</h2>
                <i class="fas fa-dollar-sign text-2xl text-rust opacity-50"></i>
            </div>
            <p class="text-4xl font-bold text-rust serif">{{ $soldArtworks->count() }}</p>
        </div>
    </div>
    
    <!-- Sold Artworks Section -->
    <div class="mb-10">
        <div class="flex items-center mb-6">
            <i class="fas fa-dollar-sign text-xl text-rust mr-3"></i>
            <h2 class="text-2xl font-bold text-rust serif">Sold Artworks</h2>
        </div>
        
        @if($soldArtworks->count() > 0)
            <div class="overflow-x-auto bg-sand rounded-lg shadow-md">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-terracotta border-opacity-30">
                            <th class="p-4 text-left text-charcoal">Artwork</th>
                            <th class="p-4 text-left text-charcoal">Title</th>
                            <th class="p-4 text-left text-charcoal">Artist</th>
                            <th class="p-4 text-left text-charcoal">Category</th>
                            <th class="p-4 text-left text-charcoal">Price</th>
                            <th class="p-4 text-left text-charcoal">Sale Date</th>
                            <th class="p-4 text-left text-charcoal">Purchased By</th>
                            <th class="p-4 text-left text-charcoal">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soldArtworks as $artwork)
                            <tr class="border-b border-terracotta border-opacity-20 hover:bg-terracotta hover:bg-opacity-10">
                                <td class="p-4">
                                    <div class="w-16 h-16 rounded overflow-hidden">
                                        <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-4">
                                    <a href="{{ route('artworks.show', $artwork) }}" class="text-rust hover:underline font-medium">
                                        {{ $artwork->title }}
                                    </a>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full overflow-hidden mr-2">
                                            <img src="{{ $artwork->user->profile_image ? asset('storage/' . $artwork->user->profile_image) : asset('images/default-profile.jpg') }}" alt="{{ $artwork->user->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <span>{{ $artwork->user->name }}</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="px-3 py-1 bg-terracotta bg-opacity-20 text-terracotta rounded-full text-xs">
                                        {{ $artwork->category }}
                                    </span>
                                </td>
                                <td class="p-4 font-medium">${{ number_format($artwork->price, 2) }}</td>
                                <td class="p-4 text-coffee">{{ $artwork->updated_at->format('M d, Y') }}</td>
                                <td class="p-4">
                                    @if($artwork->payment && $artwork->payment->user)
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full overflow-hidden mr-2">
                                                <img src="{{ $artwork->payment->user->profile_image ? asset('storage/' . $artwork->payment->user->profile_image) : asset('images/default-profile.jpg') }}" 
                                                     alt="{{ $artwork->payment->user->name }}" 
                                                     class="w-full h-full object-cover">
                                            </div>
                                            <span>{{ $artwork->payment->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-coffee italic">No buyer information</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('artworks.show', $artwork) }}" class="text-coffee hover:text-rust transition" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-sand rounded-lg shadow-md p-8 text-center">
                <div class="w-16 h-16 bg-cream rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-dollar-sign text-terracotta text-xl"></i>
                </div>
                <p class="text-coffee">No sold artworks yet.</p>
            </div>
        @endif
    </div>
    
    <!-- Available Artworks Section -->
    <div>
        <div class="flex items-center mb-6">
            <i class="fas fa-image text-xl text-terracotta mr-3"></i>
            <h2 class="text-2xl font-bold text-terracotta serif">Available Artworks</h2>
        </div>
        
        @if($availableArtworks->count() > 0)
            <div class="overflow-x-auto bg-sand rounded-lg shadow-md">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-terracotta border-opacity-30">
                            <th class="p-4 text-left text-charcoal">Artwork</th>
                            <th class="p-4 text-left text-charcoal">Title</th>
                            <th class="p-4 text-left text-charcoal">Artist</th>
                            <th class="p-4 text-left text-charcoal">Category</th>
                            <th class="p-4 text-left text-charcoal">Price</th>
                            <th class="p-4 text-left text-charcoal">Date Added</th>
                            <th class="p-4 text-left text-charcoal">Likes</th>
                            <th class="p-4 text-left text-charcoal">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availableArtworks as $artwork)
                            <tr class="border-b border-terracotta border-opacity-20 hover:bg-terracotta hover:bg-opacity-10">
                                <td class="p-4">
                                    <div class="w-16 h-16 rounded overflow-hidden">
                                        <img src="{{ asset('storage/' . $artwork->image_path) }}" alt="{{ $artwork->title }}" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-4">
                                    <a href="{{ route('artworks.show', $artwork) }}" class="text-rust hover:underline font-medium">
                                        {{ $artwork->title }}
                                    </a>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full overflow-hidden mr-2">
                                            <img src="{{ $artwork->user->profile_image ? asset('storage/' . $artwork->user->profile_image) : asset('images/default-profile.jpg') }}" alt="{{ $artwork->user->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <span>{{ $artwork->user->name }}</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="px-3 py-1 bg-terracotta bg-opacity-20 text-terracotta rounded-full text-xs">
                                        {{ $artwork->category }}
                                    </span>
                                </td>
                                <td class="p-4 font-medium">${{ number_format($artwork->price, 2) }}</td>
                                <td class="p-4 text-coffee">{{ $artwork->created_at->format('M d, Y') }}</td>
                                <td class="p-4">
                                    <div class="flex items-center text-coffee">
                                        <i class="fas fa-heart text-rust mr-1"></i>
                                        <span>{{ $artwork->likes()->count() }}</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('artworks.show', $artwork) }}" class="text-coffee hover:text-rust transition" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" 
                                               class="text-coffee hover:text-rust transition mark-sold-btn" 
                                               title="Mark as Sold"
                                               data-artwork-id="{{ $artwork->id }}"
                                               data-artwork-title="{{ $artwork->title }}">
                                            <i class="fas fa-dollar-sign"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-sand rounded-lg shadow-md p-8 text-center">
                <div class="w-16 h-16 bg-cream rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-image text-terracotta text-xl"></i>
                </div>
                <p class="text-coffee">No available artworks found.</p>
            </div>
        @endif
    </div>
</div>

<!-- Sold Artwork Modal -->
<div id="sold-artwork-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-charcoal bg-opacity-50"></div>
    <div class="relative top-20 mx-auto max-w-md bg-cream rounded-lg shadow-xl p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-charcoal serif">Mark Artwork as Sold</h3>
            <button type="button" id="close-modal" class="text-coffee hover:text-rust">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <p class="mb-6 text-coffee" id="modal-artwork-title"></p>
        
        <form id="mark-sold-form" action="" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="mb-6">
                <label for="buyer_id" class="block mb-2 text-coffee font-medium">
                    <i class="fas fa-user mr-2"></i>Select Buyer
                </label>
                <select name="buyer_id" id="buyer_id" required class="w-full px-3 py-3 border border-terracotta border-opacity-30 rounded-md focus:outline-none focus:ring focus:ring-rust focus:ring-opacity-30 bg-cream">
                    <option value="">-- Select Buyer --</option>
                    @foreach($potentialBuyers as $buyer)
                        <option value="{{ $buyer->id }}">{{ $buyer->name }} ({{ $buyer->email }})</option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex justify-end space-x-4">
                <button type="button" id="cancel-modal" class="px-4 py-2 border border-coffee text-coffee rounded-md hover:bg-coffee hover:text-cream transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-rust text-cream rounded-md hover:bg-coffee transition flex items-center">
                    <i class="fas fa-check mr-2"></i>Confirm Sale
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal elements
        const modal = document.getElementById('sold-artwork-modal');
        const closeModal = document.getElementById('close-modal');
        const cancelModal = document.getElementById('cancel-modal');
        const modalArtworkTitle = document.getElementById('modal-artwork-title');
        const markSoldForm = document.getElementById('mark-sold-form');
        
        // Get all "Mark as Sold" buttons
        const markSoldBtns = document.querySelectorAll('.mark-sold-btn');
        
        // Add click event to buttons
        markSoldBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const artworkId = this.getAttribute('data-artwork-id');
                const artworkTitle = this.getAttribute('data-artwork-title');
                
                // Set modal content
                modalArtworkTitle.textContent = `Artwork: "${artworkTitle}"`;
                markSoldForm.action = `{{ url('admin/artworks') }}/${artworkId}/mark-sold`;
                
                // Show modal
                modal.classList.remove('hidden');
            });
        });
        
        // Close modal events
        [closeModal, cancelModal].forEach(el => {
            el.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.classList.contains('bg-charcoal')) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
@endsection 