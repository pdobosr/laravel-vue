<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipperContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipper_contact')->insert([
            'shipper_id' => 1,
            'contact_id' => 1,
        ]);
    }
}
