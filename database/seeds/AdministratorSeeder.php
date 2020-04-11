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
        $admin->avatar      = "avatars/SZFHFE1aO5eC1Sa4CEvPPpZ8SXySPam1dRJdL0iN.jpeg";
        $admin->phone       = "+6289777111222";
        $admin->address     = "Tuban, Jawa Timur";
        $admin->status      = "ACTIVE";
        $admin->save();
        $this->command->info("User Administrator Created.");

        $admin              = new User();
        $admin->username    = "budi";
        $admin->name        = "Budi Santoso";
        $admin->email       = "budi@gmail.com";
        $admin->roles       = json_encode(["STAFF"]);
        $admin->password    = Hash::make("123456");
        $admin->avatar      = "avatars/SZFHFE1aO5eC1Sa4CEvPPpZ8SXySPam1dRJdL0iN.jpeg";
        $admin->phone       = "+6289777111233";
        $admin->address     = "Bojonegoro, Jawa Timur";
        $admin->status      = "INACTIVE";
        $admin->save();
        $this->command->info("User Staff Created.");

        $admin              = new User();
        $admin->username    = "adi";
        $admin->name        = "Adi Gumilang";
        $admin->email       = "adi@gmail.com";
        $admin->roles       = json_encode(["CUSTOMER"]);
        $admin->password    = Hash::make("123456");
        $admin->avatar      = "avatars/SZFHFE1aO5eC1Sa4CEvPPpZ8SXySPam1dRJdL0iN.jpeg";
        $admin->phone       = "+6289777111244";
        $admin->address     = "Lamongan, Jawa Timur";
        $admin->status      = "INACTIVE";
        $admin->save();
        $this->command->info("User Customer Created.");
    }
}
