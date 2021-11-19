<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user  = User::where('email','nisha.afroza1998@gmail.com')->first();
        if(is_null($user)){
            $user = new User();
            $user->name = "nisha";
            $user->email = "nisha.afroza1998@gmail.com";
            $user->password = Hash::make('12345678');
            $user->save();
        }
    }
}
