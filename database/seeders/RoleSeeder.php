<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            [
                'title' => 'Super Admin',
                'level' => 1,
                'is_subrole' => 0,
            ],
            [
                'title' => 'Club Admin',
                'level' => 2,
                'is_subrole' => 0,
            ],
            [
                'title' => 'Coach',
                'level' => 3,
                'is_subrole' => 1,
            ],
            [
                'title' => 'Player',
                'level' => 4,
                'is_subrole' => 0,
            ],
            [
                'title' => 'Manager',
                'level' => 5,
                'is_subrole' => 1,
            ],

        ];

        foreach ($roles as $role) {
            Roles::create([
                'title' => $role['title'],
                'level' => $role['level'],
                'is_subrole'=> $role['is_subrole']
            ]);
        }
    }
}
