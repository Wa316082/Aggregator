<?php

namespace App\Imports;

use App\Models\Location;
use App\Models\Logistic;
use App\Models\LogisticRateChart;
use App\Models\LogisticZone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RateImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row['logistic_id']);
        $logistic_id = Logistic:: where('name', 'LIKE', "%{$row['logistic_id']}%")->first();

        //dd($logistic_id);
        $origin_zone_id = LogisticZone:: where('name', 'LIKE', "%{$row['origin_zone_id']}%")->first();

        $destination_zone_id = LogisticZone:: where('name', 'LIKE', "%{$row['destination_zone_id']}%")->first();
        $origin_country_id = Location:: where('name', 'LIKE', "%{$row['origin_country_id']}%")->first();
        $destination_country_id = Location:: where('name', 'LIKE', "%{$row['destination_country_id']}%")->first();
        return new LogisticRateChart([

            'logistic_id' => $logistic_id->id,
            'origin_zone_id'=>$origin_zone_id->id,
            'destination_zone_id'=>$destination_zone_id->id,
            'origin_country_id'=>$origin_country_id->id,
            'destination_country_id'=>$destination_country_id->id,
            'weight'=>$row['weight'],
            'type'=>$row['type'],
            'additional_weight_charge'=>$row['additional_weight_charge'],
            'applicable_weight'=>$row['applicable_weight'],
            'rate'=>$row['rate'],
            'posted_on'=>Carbon::now(),
            'posted_by'=>Auth::user()->id,

        ]);
    }
}
