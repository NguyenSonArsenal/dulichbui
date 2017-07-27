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
        
    	DB::table('users')->create([
		    [
		        'name' => 'mot',
	        	'email' =>'mot@gmail.com',
	        	'password' => bcrypt('mot123456'),
	        	'gender' => '1',
	        	'phone' => '0964047698',
	        	'birthday' => '2017-07-29'
		    ],
		    [
		        'name' => 'hai',
	        	'email' =>'hai@gmail.com',
	        	'password' => bcrypt('hai123456'),
	        	'gender' => '1',
	        	'phone' => '0964047698',
	        	'birthday' => '2017-07-29'
		    ]
		]);

    }
}



