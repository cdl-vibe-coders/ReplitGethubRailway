<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'ADMIN',
                'description' => 'System administrator with full access',
                'permissions' => [
                    'manage_users', 'manage_roles', 'manage_training_packages',
                    'manage_courses', 'view_reports', 'manage_system_settings',
                    'manage_integrations', 'view_all_profiles', 'manage_equipment', 'manage_leads',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'TRAINER',
                'description' => 'Training instructor with course management access',
                'permissions' => [
                    'manage_assigned_courses', 'view_student_profiles', 'manage_training_sessions',
                    'record_attendance', 'communicate_with_students', 'generate_reports',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'USER',
                'description' => 'Regular user with training enrollment access',
                'permissions' => [
                    'enroll_in_training', 'view_own_profile', 'update_profile',
                    'view_training_history', 'communicate_with_trainers',
                ],
                'is_active' => true,
            ],
            [
                'name' => 'CREDENTIAL',
                'description' => 'Simplified credential user with reduced data requirements',
                'permissions' => ['view_own_credentials', 'basic_profile_access'],
                'is_active' => true,
            ],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate(
                ['name' => $roleData['name']],
                $roleData
            );
        }
    }
}
