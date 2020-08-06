<?php

use Illuminate\Database\Seeder;


class PaymentProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_providers')->insert([
            'name' => "paypal",
            'slug' => "paypal",
            'active' => 1
        ]); 

    }
}
