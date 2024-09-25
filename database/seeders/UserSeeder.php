<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin user
        User::create([
            'name' => 'admin',
            'secondname' => 'admin_secondname',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'profile_photo' => 'admin_profile_photo.png',
            'role' => 'admin',
            'sexe' => 'male',
            'civility' => 'Mr',
            'phone' => '123456789',
            'country' => 'USA',
            'city' => 'New York',
            'attendance_mode' => 'online',
            'occupation' => 'Admin Manager',
            'company_name' => 'Admin Corp',
            'sector' => 'IT',
            'activity_description' => 'Administration of systems',
            'email_subscription' => true,
            'accepted_terms' => true,
            'isactivated' => true,
            'facebook' => 'admin_facebook',
            'twitter' => 'admin_twitter',
            'instagram' => 'admin_instagram',
            'linkedin' => 'admin_linkedin',
            'cin' => 'ADMIN123456',
        ]);

        // Create Coach user
        User::create([
            'name' => 'coach',
            'secondname' => 'coach_secondname',
            'email' => 'coach@gmail.com',
            'password' => Hash::make('123'),
            'profile_photo' => 'coach_profile_photo.png',
            'role' => 'coach',
            'sexe' => 'female',
            'civility' => 'Ms',
            'phone' => '987654321',
            'country' => 'Canada',
            'city' => 'Toronto',
            'attendance_mode' => 'onsite',
            'occupation' => 'Fitness Coach',
            'company_name' => 'FitLife Inc.',
            'sector' => 'Health & Fitness',
            'activity_description' => 'Coaching individuals',
            'email_subscription' => true,
            'accepted_terms' => true,
            'isactivated' => true,
            'facebook' => 'coach_facebook',
            'twitter' => 'coach_twitter',
            'instagram' => 'coach_instagram',
            'linkedin' => 'coach_linkedin',
            'cin' => 'COACH654321',
        ]);

           // Create Coach user
           User::create([
            'name' => 'coach2',
            'secondname' => 'coach2_secondname',
            'email' => 'coach2@gmail.com',
            'password' => Hash::make('123'),
            'profile_photo' => 'coach2_profile_photo.png',
            'role' => 'coach',
            'sexe' => 'female',
            'civility' => 'Ms',
            'phone' => '987654321',
            'country' => 'Canada',
            'city' => 'Toronto',
            'attendance_mode' => 'onsite',
            'occupation' => 'Fitness Coach2',
            'company_name' => 'FitLife Inc.',
            'sector' => 'Health & Fitness',
            'activity_description' => 'Coach2ing individuals',
            'email_subscription' => true,
            'accepted_terms' => true,
            'isactivated' => true,
            'facebook' => 'coach2_facebook',
            'twitter' => 'coach2_twitter',
            'instagram' => 'coach2_instagram',
            'linkedin' => 'coach2_linkedin',
            'cin' => 'COACH2654321',
        ]);

        // Create Regular user
        User::create([
            'name' => 'user',
            'secondname' => 'user_secondname',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'profile_photo' => 'user_profile_photo.png',
            'role' => 'user',
            'sexe' => 'male',
            'civility' => 'Mr',
            'phone' => '564738291',
            'country' => 'France',
            'city' => 'Paris',
            'attendance_mode' => 'hybrid',
            'occupation' => 'Software Developer',
            'company_name' => 'DevTech',
            'sector' => 'Software',
            'activity_description' => 'Developing applications',
            'email_subscription' => false,
            'accepted_terms' => true,
            'isactivated' => true,
            'facebook' => 'user_facebook',
            'twitter' => 'user_twitter',
            'instagram' => 'user_instagram',
            'linkedin' => 'user_linkedin',
            'cin' => 'USER987654',
        ]);   // Create Regular user
        User::create([
            'name' => 'user2',
            'secondname' => 'user2_secondname',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('123'),
            'profile_photo' => 'user2_profile_photo.png',
            'role' => 'user',
            'sexe' => 'male',
            'civility' => 'Mr',
            'phone' => '564738291',
            'country' => 'France',
            'city' => 'Paris',
            'attendance_mode' => 'hybrid',
            'occupation' => 'Software Developer',
            'company_name' => 'DevTech',
            'sector' => 'Software',
            'activity_description' => 'Developing applications',
            'email_subscription' => false,
            'accepted_terms' => true,
            'isactivated' => true,
            'facebook' => 'user2_facebook',
            'twitter' => 'user2_twitter',
            'instagram' => 'user2_instagram',
            'linkedin' => 'user2_linkedin',
            'cin' => 'USER2987654',
        ]);
    }
}
