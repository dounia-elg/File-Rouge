<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create([
            'name' => 'Original Name',
            'role' => 'artist'
        ]);
    }

    public function test_can_update_basic_profile_information()
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

    public function test_name_is_required()
    {
        $response = $this->actingAs($this->user)
            ->put(route('artist.profile.update'), [
                'name' => '',
                'location' => 'New York'
            ]);

        $response->assertSessionHasErrors('name');
    }
}