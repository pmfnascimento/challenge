<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Get All Brand Cars
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBrandCars()
    {
        $data = Car::select('brand')->get();
        return response()->json($data, 200);
    }

    /**
     * Get the data from user and return result from method search
     *
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getCars(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $distance = $request->distance;
        $brand = $request->brand;
        $all = $this->getDistance($brand,$latitude,$longitude,$distance);
        return response()->json($all, 200);
    }

    /**
     * method cars near geopositionof user by coordinates and distance
     *
     * @param string $brand Brand of Car
     * @param float $latitude Latitude From User
     * @param float $longitude Longitude From User
     * @param int $radius Distance from user and near car
     *
     * @return Object Result of cars searched
     */
    public function getDistance($brand,$latitude, $longitude, $radius)
    {
        $shops = DB::table("locations");
        $shops = $shops->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . ")) * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . ")) + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"));
        $shops = $shops->having('distance', '<', $radius);
        $shops = $shops->leftJoin('cars','cars.location_id','=','locations.id');
        $shops = $shops->where('cars.brand',$brand);
        $shops = $shops->get();
        return $shops;
    }
}
