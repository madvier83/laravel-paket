<?php

namespace App\Http\Controllers\API;

use App\Models\History;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = History::latest()->get();

        if($data) {
            return ApiFormatter::createApi(200, "Success", $data);
        } else {
            return ApiFormatter::createApi(400, "Failed");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request example
        // {
        //     "city_a": 1360771077,
        //     "city_b": 1360313023,
        //     "weight": "1"
        //   }
        $city_a = City::where('id', $request['city_a'])->first();
        $city_b = City::where('id', $request['city_b'])->first(); 
        $coordinate_a = $city_a['lat'] .",". $city_a['lng'] .",". $city_a['city'];
        $coordinate_b = $city_b['lat'] .",". $city_b['lng'] .",". $city_b['city'];
        
        function getDistanceBetween($latitude1, $longitude1, $latitude2, $longitude2)
        {
            $theta    = $longitude1 - $longitude2;
            $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))  + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
            $distance = acos($distance);
            $distance = rad2deg($distance);
            $distance = $distance * 60 * 1.1515;
            $distance = $distance * 1.609344;
            return (round($distance, 1));
        }
        $distance = getDistanceBetween($city_a['lat'], $city_a['lng'], $city_b['lat'], $city_b['lng']);
        $ongkir = $distance * 500 * $request['weight'];
        $driver = User::inRandomOrder()->first()->id;
        
        $data = [
            'weight' => $request['weight'],
            'distance' => $distance,
            'coordinate_a' => $coordinate_a,
            'coordinate_b' => $coordinate_b,
            'city_a' => $city_a['city'],
            'city_b' => $city_b['city'],
            'ongkir' => $ongkir,
            'driver_id' => $driver,
            'detail' => $request['detail'],
        ];
        History::create($data); 

        return ApiFormatter::createApi(200, "Success", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
