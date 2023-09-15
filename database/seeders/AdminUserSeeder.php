<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Contracts\Repositories\AdminUserRepositoryInterface;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var AdminUserRepositoryInterface $adminUserRepository */
        $adminUserRepository = \App::make(AdminUserRepositoryInterface::class);

        $adminUser = $adminUserRepository->create([
            'name' => 'Test Admin User',
            'email' => 'admin@example.com',
            'password' => 'test_password',
        ]);
    }
}
