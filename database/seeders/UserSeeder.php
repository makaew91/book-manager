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
        $user1 = new User();
        $user1->firstname = 'Антон';
        $user1->lastname = 'Рогозников';
        $user1->email = 'anton@emfy.com';
        $user1->password = bcrypt('secret');
        $user1->save();

        $user2 = new User();
        $user2->firstname = 'Артем';
        $user2->lastname = 'Устинов';
        $user2->email = 'artem@emfy.com';
        $user2->password = bcrypt('secret');
        $user2->save();

        $user3 = new User();
        $user3->firstname = 'Борис';
        $user3->lastname = 'Верник';
        $user3->email = 'boris@emfy.com';
        $user3->password = bcrypt('secret');
        $user3->save();
    }
}
