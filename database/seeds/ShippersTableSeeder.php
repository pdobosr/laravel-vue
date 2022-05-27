<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShippersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippers')->insert([
            'company_name' => Str::random(10),
            'address' => Str::random(10),
            'primary_contact_id' => 1,
        ]);
    }
}
