<?php

namespace App\Http\Requests\OrderRequest;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'given_order_id' => 'required|unique:orders',
            'coupon_name' => 'nullable|exists:coupons,name',
            'delivery_division_id' => 'required',
            'merchant_name' => 'required',
            'delivery_area_id' => 'required',
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'customer_alt_mobile' => 'required',
            //'actual_amount' => 'required',
            'collection_amount' => 'required',
            'delivery_address' => 'required',
            'delivery_zone_id' => 'required',
            'delivery_district_id' => 'required',
            'delivery_thana_id' => 'required',
            'post_code' => 'required',
            'total_weight' => 'required',
            'pickup_division_id' => 'required',
            // 'pickup_location_id' => 'required',
            'pickup_location_id' => 'required_without:pickup_location|nullable',

            'pickup_division_id' => 'required_without:pickup_location_id|nullable',
            'pickup_district_id' => 'required_without:pickup_location_id|nullable',
            'pickup_thana_id' => 'required_without:pickup_location_id|nullable',
            'pickup_area_id' => 'required_without:pickup_location_id|nullable',
        ];
    }
}
