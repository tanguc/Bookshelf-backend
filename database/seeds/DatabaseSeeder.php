<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 	$this->call(AuthorsTableSeeder::class);
 	$this->call(BooksTableSeeder::class);
 	$this->call(UsersTableSeeder::class);
 	
 	
        // $this->call(UsersTableSeeder::class);
    }
}
