<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\AdminService;
use App\Services\DoctorService;
use App\Services\PatientService;
use App\Services\SecretaryService;
use App\Services\UserService;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $userService = app(UserService::class);
        $adminService = new AdminService($userService);

        // Créer l'ADMIN spécifié
        $adminService->registerAdmin([
            'nom' => 'Admin',
            'prenom' => 'MediCare',
            'email' => 'admin.dashboard@medicare.com',
            'password' => 'AdminDashboard123!',
            'department' => 'Management',
            'telephone' => '+212600000003'
        ]);

        echo "Admin MediCare créé avec succès !\n";
    }
}