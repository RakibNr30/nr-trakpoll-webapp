<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('email', 'anup9449@gmail.com')->first();
        if(is_null($admin)){
            $admin = new Admin();
            $admin->name = "Supper Admin";
            $admin->username = "superadmin";
            $admin->email = "anup9449@gmail.com";
            $admin->password = Hash::make("12345678");
            $admin->save();
        }
    }
}
