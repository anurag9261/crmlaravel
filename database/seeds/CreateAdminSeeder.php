<?php

use App\Admin;
use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'fname'=>'Admin',
               'lname'=>'Admin',
               'mobno'=>8689893189,
               'email'=>'admin@itsolutionstuff.com',
               'Address'=>'roomno2',
                'role'=>'Admin',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User',
               'email'=>'user@itsolutionstuff.com',
                'role'=>'Employee',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            Admin::create($value);
        }
    }
}
