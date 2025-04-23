<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-password {email=admin@youart.com} {password=admin123}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset or create an admin user password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'admin',
            ]);
            
            $this->info("Admin user created with email: {$email} and password: {$password}");
            return 0;
        }

        // Update existing user
        $user->password = Hash::make($password);
        $user->role = 'admin'; // Ensure the user has admin role
        $user->save();

        $this->info("Password for user {$email} has been reset to: {$password}");
        
        return 0;
    }
} 