<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collector = Role::where('slug','collector')->first();
        $manager = Role::where('slug', 'manager')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();

        $user1 = new User();
        $user1->firstname = 'Антон';
        $user1->lastname = 'Рогозников';
        $user1->email = 'anton@emfy.com';
        $user1->password = bcrypt('secret');
        $user1->save();
        $user1->roles()->attach($manager);
        $user1->permissions()->attach($manageUsers);

        $user2 = new User();
        $user2->firstname = 'Артем';
        $user2->lastname = 'Устинов';
        $user2->email = 'artem@emfy.comm';
        $user2->password = bcrypt('secret');
        $user2->save();
        $user2->roles()->attach($collector);
    }
}
