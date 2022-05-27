<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ShippersTableSeeder::class);
         $this->call(ContactsTableSeeder::class);
         $this->call(ShipperContactTableSeeder::class);
    }
}
