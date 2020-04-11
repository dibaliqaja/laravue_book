<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin              = new User();
        $admin->username    = "administrator";
        $admin->name        = "Site Administrator";
        $admin->email       = "admin@gmail.com";
        $admin->roles       = json_encode(["ADMIN"]);
        $admin->password    = Hash::make("admin123");
        $admin->avatar      = "file.png";
        $admin->phone       = "+6289777111222";
        $admin->address     = "Tuban, Jawa Timur";
        $admin->status      = "ACTIVE";

        $admin->save();

        $this->command->info("User Administrator Created.");
    }
}
