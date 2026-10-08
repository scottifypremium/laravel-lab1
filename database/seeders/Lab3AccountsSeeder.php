<?php

namespace Database\Seeders;

use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Lab3AccountsSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('LAB3_SEED_PASSWORD');
        if (! $password) {
            throw new \RuntimeException('Set LAB3_SEED_PASSWORD in your local .env first.');
        }

        $make = function (string $name, string $email, string $role) use ($password) {
            $user = User::firstOrNew(['email' => $email]);
            $user->forceFill([
                'name' => $name,
                'password' => Hash::make($password),
                'role' => $role,
                'email_verified_at' => now(),
            ])->save();
            return $user;
        };

        $admin    = $make('Admin Account', 'admin@example.com', 'admin');
        $studentA = $make('Maria Santos', 'student.a@example.com', 'student');
        $studentB = $make('Carlos Reyes', 'student.b@example.com', 'student');

        ServiceRequest::whereIn('id', [2, 5])->update(['user_id' => $studentA->id]);
        ServiceRequest::where('id', 3)->update(['user_id' => $studentB->id]);
    }
}