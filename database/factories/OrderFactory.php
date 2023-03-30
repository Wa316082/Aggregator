<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
//            'customer_name'=>'rafi',
//            'customer_mobile'=>'234543',
//            'customer_alt_mobile'=>'123432',
//            'collection_amount'=>'12343',
//            'delivery_address'=>'Uttara',
//            'delivery_zone_id'=>1,
//            'delivery_district_id'=>2,
//            'return_charge'=>'12',
//            'return_chcoupon_idarge'=>'12ws',
//            'pickup_location_id'=>1,
//            'latitude'=>12.123,
//            'longitude'=>12.12,
            'customer_name' =>'labony',
            'customer_mobile' => '0179946486',
            'customer_alt_mobile' => '0179946486',
            'actual_amount' =>'120',
            'collection_amount' => '150',
        ];
    }
}
