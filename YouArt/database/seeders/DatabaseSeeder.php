<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the AdminUserSeeder
        $this->call(AdminUserSeeder::class);
        
        // Create a user
        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'bio' => 'A passionate art enthusiast and creative mind.',
            'location' => 'Paris, France',
        ]);
        
        // Create a drawing workshop
        \App\Models\Workshop::create([
            'title' => 'Basic Portrait Drawing Workshop',
            'description' => "Learn the fundamentals of portrait drawing in this comprehensive workshop. Perfect for beginners and intermediate artists looking to enhance their skills.\n\nIn this workshop, you'll learn:\n- Basic facial proportions\n- Techniques for realistic eyes, nose, and mouth\n- Creating depth with proper shading\n- Common mistakes to avoid\n- Tips for capturing likeness",
            'video_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Replace with actual drawing tutorial
            'skill_level' => 'beginner',
            'views' => 156,
            'likes' => 42,
        ]);
    }
}
