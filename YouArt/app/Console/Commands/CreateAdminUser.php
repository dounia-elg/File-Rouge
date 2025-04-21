<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('What is the admin name?', 'Admin');
        $email = $this->ask('What is the admin email?', 'admin@example.com');
        $password = $this->secret('What is the admin password?');
        
        if (!$password) {
            $password = 'password'; // Default password
            $this->info('Using default password: "password"');
        }
        
        // Create user with admin role
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);
        
        $this->info('Admin user created successfully!');
        $this->info("Name: {$user->name}");
        $this->info("Email: {$user->email}");
        $this->info("Role: {$user->role}");
    }
}
