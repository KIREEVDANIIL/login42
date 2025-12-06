<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем администратора
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        // Создаем корзину для админа
        if (!$admin->cart) {
            $admin->cart()->create([
                'user_id' => $admin->id,
                'total_amount' => 0,
            ]);
        }

        // Создаем тестового пользователя
        $user = User::create([
            'name' => 'Тестовый пользователь',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'is_admin' => false,
        ]);

        // Создаем корзину для тестового пользователя
        if (!$user->cart) {
            $user->cart()->create([
                'user_id' => $user->id,
                'total_amount' => 0,
            ]);
        }

        echo "Пользователи созданы:\n";
        echo "- Администратор: admin@example.com / admin123\n";
        echo "- Обычный пользователь: user@example.com / password123\n";
    }
}