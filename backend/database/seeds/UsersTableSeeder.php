<?php
use App\Models\User;

class UsersTableSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdministrator();
    }

    public function createAdministrator()
    {
        $user = new User;

        $user->first_name   = 'Administrator';
        $user->last_name    = 'Administrator';
        $user->email        = 'admin@admin.com';
        $user->password     = 'secret';

        $user->save();
    }
}
