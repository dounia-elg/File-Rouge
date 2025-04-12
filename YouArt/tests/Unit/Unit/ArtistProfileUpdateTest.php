<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user
        $this->user = User::factory()->create([
            'name' => 'Test Artist',
            'role' => 'artist',
            'location' => null,
            'bio' => null,
            'profile_photo' => null
        ]);
    }

    /** @test */
    public function it_can_update_profile_information()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->user)
            ->put(route('artist.profile.update'), [
                'name' => 'Updated Name',
                'location' => 'New York',
                'bio' => 'Test bio content',
                'profile_photo' => UploadedFile::fake()->image('profile.jpg')
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Refresh user from database
        $this->user->refresh();

        // Assert text fields were updated
        $this->assertEquals('Updated Name', $this->user->name);
        $this->assertEquals('New York', $this->user->location);
        $this->assertEquals('Test bio content', $this->user->bio);

        // Assert profile photo was stored
        Storage::disk('public')->assertExists('profile-photos/' . $this->user->profile_photo);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->actingAs($this->user)
            ->put(route('artist.profile.update'), [
                'name' => '',  // Required field is empty
                'location' => 'New York',
                'bio' => 'Test bio'
            ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_can_update_profile_without_photo()
    {
        $response = $this->actingAs($this->user)
            ->put(route('artist.profile.update'), [
                'name' => 'Updated Name',
                'location' => 'New York',
                'bio' => 'Test bio content'
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->user->refresh();
        
        $this->assertEquals('Updated Name', $this->user->name);
        $this->assertEquals('New York', $this->user->location);
        $this->assertEquals('Test bio content', $this->user->bio);
    }
}