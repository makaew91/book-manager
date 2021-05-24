<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $manager = new Role();
        $manager->name = 'Manager';
        $manager->slug = 'manager';
        $manager->save();

        $collector = new Role();
        $collector->name = 'Collector';
        $collector->slug = 'collector';
        $collector->save();

        $operator = new Role();
        $operator->name = 'Machine operator';
        $operator->slug = 'machine-operator';
        $operator->save();

        $shareholder = NEW Role();
        $shareholder->name = 'Shareholder';
        $shareholder->slug = 'shareholder';
        $shareholder->save();
    }
}
