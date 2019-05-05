<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = \App\User::query()
            ->where('email', 'admin@admin')
            ->first();

        if ($super_admin == null) {
            $super_admin = new \App\User();
            $super_admin->name = "admin";
            $super_admin->email = "admin@admin";
            $super_admin->staff_role = "admin";
            $super_admin->password = bcrypt("admin");
            $super_admin->save();
        }
    }
}
