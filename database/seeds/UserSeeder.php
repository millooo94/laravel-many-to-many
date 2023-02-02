<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'      => 'qwer',
                'email'     => 'qwer@qwer.qwer',
                'password'  =>  Hash::make('qwer'),
            ],
            [
                'name'      => 'asdf',
                'email'     => 'asdf@asdf.asdf',
                'password'  =>  Hash::make('asdf'),
            ],
            [
                'name'      => 'zxcv',
                'email'     => 'zxcv@zxcv.zxcv',
                'password'  =>  Hash::make('zxcv'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
