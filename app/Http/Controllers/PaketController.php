<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        return view('main', [
            'cities' => City::all(),
        ]);
    }
    public function history()
    {
        return view('history', [
            'histories' => History::latest()->get(),
        ]);
    }

    public function measure(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric|min:1',
            'coordinate_a' => 'required',
            'coordinate_b' => 'required|different:coordinate_a',
            'detail' => 'required',
        ]);

        $coordinate_a = explode(",", $validated['coordinate_a']);
        $coordinate_b = explode(",", $validated['coordinate_b']);

        $validated['city_a'] = $coordinate_a[2];
        $validated['city_b'] = $coordinate_b[2];

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

        $validated['distance'] = getDistanceBetween($coordinate_a[0], $coordinate_a[1], $coordinate_b[0], $coordinate_b[1]);
        $validated['ongkir']   = $validated['distance'] * 500 * $validated['weight'];
        // dd($validated);

        return view('measure', [
            'result' => $validated,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "weight"        => "required",
            "distance"      => "required",
            "coordinate_a"  => "required",
            "coordinate_b"  => "required",
            "city_a"        => "required",
            "city_b"        => "required",
            "ongkir"        => "required",
            "detail"        => "required",
        ]);

        $validated['driver_id'] = User::inRandomOrder()->first()->id;
        History::create($validated);
        
        return redirect('/histori')->with('success', 'Paket Dikirim');
    }
}
