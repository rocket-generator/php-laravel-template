<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dto\User;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var UserRepositoryInterface $userRepository */
        $adminUserRepository = \App::make(UserRepositoryInterface::class);

        $normalUser = $adminUserRepository->create([
            'name' => 'Test Normal User',
            'email' => 'normal@example.com',
            'password' => 'test_password',
            'permissions' => [],
        ]);

        $adminUser = $adminUserRepository->create([
            'name' => 'Test Admin User',
            'email' => 'admin@example.com',
            'password' => 'test_password',
            'permissions' => [User::PERMISSION_ADMIN],
        ]);
    }
}
