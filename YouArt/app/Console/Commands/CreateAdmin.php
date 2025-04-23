<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateAdmin extends Command
{
    protected $signature = 'admin:create {email=admin@youart.com} {password=admin123}';
    protected $description = 'Create admin user with debugging';

    public function handle()
    {
        try {
            // Test database connection
            $this->info("Testing database connection...");
            $tables = DB::select('SELECT table_name FROM information_schema.tables WHERE table_schema = \'public\'');
            
            if (empty($tables)) {
                $this->error("No tables found in database. Database might be empty.");
            } else {
                $this->info("Connected to database successfully. Tables found: " . count($tables));
                foreach ($tables as $table) {
                    $this->line(" - " . $table->table_name);
                }
            }
            
            // Check if users table exists
            $this->info("\nChecking if users table exists...");
            $usersTable = collect($tables)->firstWhere('table_name', 'users');
            
            if (!$usersTable) {
                $this->error("The 'users' table does not exist!");
                return 1;
            }
            
            $this->info("Users table exists.");
            
            // Create admin user
            $email = $this->argument('email');
            $password = $this->argument('password');
            
            $this->info("\nAttempting to create admin user with email: {$email}");
            
            // Check if user already exists
            $existingUser = DB::table('users')->where('email', $email)->first();
            
            if ($existingUser) {
                $this->info("User already exists. Updating...");
                
                DB::table('users')
                    ->where('email', $email)
                    ->update([
                        'password' => Hash::make($password),
                        'role' => 'admin',
                        'updated_at' => now()
                    ]);
            } else {
                $this->info("Creating new admin user...");
                
                DB::table('users')->insert([
                    'name' => 'Admin User',
                    'email' => $email,
                    'password' => Hash::make($password),
                    'role' => 'admin',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            $this->info("\nAdmin user successfully " . ($existingUser ? "updated" : "created") . " with:");
            $this->info("Email: {$email}");
            $this->info("Password: {$password}");
            
            // Verify user was created/updated
            $user = DB::table('users')->where('email', $email)->first();
            
            if ($user) {
                $this->info("\nVerification successful. User exists in database.");
                $this->info("User ID: {$user->id}");
                $this->info("User Role: {$user->role}");
            } else {
                $this->error("\nVerification failed. User not found in database after creation/update!");
            }
            
            return 0;
        } catch (\Exception $e) {
            $this->error("\nError occurred: " . $e->getMessage());
            $this->error("In file: " . $e->getFile() . " on line " . $e->getLine());
            $this->error("Stack trace: " . $e->getTraceAsString());
            return 1;
        }
    }
} 