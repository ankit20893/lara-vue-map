<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function allMarkers()
    {
        $file = fopen(storage_path('app/mock.txt'), "r") or exit("Unable to open file!");

        $i = 0;
        $data = [];
        while(!feof($file)) {
            if ($i > 0) {
                $temp = fgets($file);
                if ($temp != '') {
                    $explodeLine = explode(',', $temp);
                    $lat = $explodeLine[4];
                    $lng = str_replace("\n","",$explodeLine[5]);
                    if ($explodeLine[3] == 'Male') {
                        $data[] = ['id'=>$explodeLine[0], 'first_name'=>$explodeLine[1], 'last_name'=>$explodeLine[2], 'gender'=>$explodeLine[3], 'lat'=>$lat, 'lon'=> $lng, 'icon' => 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png', 'position' => ['lat' => floatval($lat), 'lng' => floatval($lng)]];
                    }else {
                        $data[] = ['id'=>$explodeLine[0], 'first_name'=>$explodeLine[1], 'last_name'=>$explodeLine[2], 'gender'=>$explodeLine[3], 'lat'=>$lat, 'lon'=>$lng, 'icon' => 'http://maps.google.com/mapfiles/ms/icons/pink-dot.png', 'position' => ['lat' => floatval($lat), 'lng' => floatval($lng)]];
                    }
                }
            }
            $i++;
        }

        fclose($file);
        return $data;
    }

    public function commonMarkers(Request $request)
    {
        $file = fopen(storage_path('app/mock.txt'), "r") or exit("Unable to open file!");

        $i = 0;
        $data = [];
        while(!feof($file)) {
            if ($i > 0) {
                $temp = fgets($file);
                if ($temp != '') {
                    $explodeLine = explode(',', $temp);
                    $lat = $explodeLine[4];
                    $lng = str_replace("\n","",$explodeLine[5]);
                    if (!$request->name && $request->gender && $explodeLine[3] == $request->gender) {
                        if ($request->gender == 'Male'){
                            $icon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                        } else {
                            $icon = 'http://maps.google.com/mapfiles/ms/icons/pink-dot.png';
                        }

                        $data[] = ['id'=>$explodeLine[0], 'first_name'=>$explodeLine[1], 'last_name'=>$explodeLine[2], 'gender'=>$explodeLine[3], 'lat'=>$lat, 'lon'=> $lng, 'icon' => $icon, 'position' => ['lat' => floatval($lat), 'lng' => floatval($lng)]];
                    }
                    if (!$request->gender && $request->name){
                        $len = strlen($request->name);
                        if (((substr($explodeLine[1], 0, $len) === $request->name) || (substr($explodeLine[2], 0, $len) === $request->name))) {
                            if ($explodeLine[3] == 'Male'){
                                $icon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                            } else {
                                $icon = 'http://maps.google.com/mapfiles/ms/icons/pink-dot.png';
                            }

                            $data[] = ['id'=>$explodeLine[0], 'first_name'=>$explodeLine[1], 'last_name'=>$explodeLine[2], 'gender'=>$explodeLine[3], 'lat'=>$lat, 'lon'=> $lng, 'icon' => $icon, 'position' => ['lat' => floatval($lat), 'lng' => floatval($lng)]];
                        }
                    }
                    if ($request->gender && $request->name && $explodeLine[3] == $request->gender){
                        $len = strlen($request->name);
                        if (((substr($explodeLine[1], 0, $len) === $request->name) || (substr($explodeLine[2], 0, $len) === $request->name))) {
                            if ($explodeLine[3] == 'Male'){
                                $icon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                            } else {
                                $icon = 'http://maps.google.com/mapfiles/ms/icons/pink-dot.png';
                            }

                            $data[] = ['id'=>$explodeLine[0], 'first_name'=>$explodeLine[1], 'last_name'=>$explodeLine[2], 'gender'=>$explodeLine[3], 'lat'=>$lat, 'lon'=> $lng, 'icon' => $icon, 'position' => ['lat' => floatval($lat), 'lng' => floatval($lng)]];
                        }
                    }
                    if (!$request->gender && !$request->name) {
                        if ($explodeLine[3] == 'Male'){
                            $icon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                        } else {
                            $icon = 'http://maps.google.com/mapfiles/ms/icons/pink-dot.png';
                        }

                        $data[] = ['id'=>$explodeLine[0], 'first_name'=>$explodeLine[1], 'last_name'=>$explodeLine[2], 'gender'=>$explodeLine[3], 'lat'=>$lat, 'lon'=> $lng, 'icon' => $icon, 'position' => ['lat' => floatval($lat), 'lng' => floatval($lng)]];
                    }
                }
            }
            $i++;
        }

        fclose($file);
        return $data;
    }

    public function nameMarkers(Request $request)
    {
        $file = fopen(storage_path('app/mock.txt'), "r") or exit("Unable to open file!");

        $i = 0;
        $data = [];
        while(!feof($file)) {
            if ($i > 0) {
                $temp = fgets($file);
                if ($temp != '') {
                    $explodeLine = explode(',', $temp);
                    $lat = $explodeLine[4];
                    $lng = str_replace("\n","",$explodeLine[5]);
                    $len = strlen($request->name);
                    if ($request->name && ((substr($explodeLine[1], 0, $len) === $request->name) || (substr($explodeLine[2], 0, $len) === $request->name))) {
                        if ($explodeLine[3] == 'Male'){
                            $icon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                        } else {
                            $icon = 'http://maps.google.com/mapfiles/ms/icons/pink-dot.png';
                        }

                        $data[] = ['id'=>$explodeLine[0], 'first_name'=>$explodeLine[1], 'last_name'=>$explodeLine[2], 'gender'=>$explodeLine[3], 'lat'=>$lat, 'lon'=> $lng, 'icon' => $icon, 'position' => ['lat' => floatval($lat), 'lng' => floatval($lng)]];
                    }

                }
            }
            $i++;
        }

        fclose($file);
        return $data;
    }

    public function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
      $earth_radius = 6371;

      $dLat = deg2rad($latitude2 - $latitude1);
      $dLon = deg2rad($longitude2 - $longitude1);

      $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
      $c = 2 * asin(sqrt($a));
      $d = $earth_radius * $c;

      return $d;
}

    public function radiusMarkers(Request $request){
        $address = $request->address; // Google HQ

        $url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $responseJson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responseJson, true);
        Log::info($response);

        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode, true);
        Log::info($output);
        $latitude = $output->results[0]->geometry->location->lat;
        Log::info($latitude);
        $longitude = $output->results[0]->geometry->location->lng;

        $file = fopen(storage_path('app/mock.txt'), "r") or exit("Unable to open file!");

        $i = 0;
        $data = [];
        while(!feof($file)) {
            if ($i > 0) {
                $temp = fgets($file);
                if ($temp != '') {
                    $explodeLine = explode(',', $temp);
                    $lat = $explodeLine[4];
                    $lng = str_replace("\n","",$explodeLine[5]);
                    if ($this->getDistance($latitude, $longitude, $lat, $lng) <= 2000){
                        Log::info($this->getDistance($latitude, $longitude, $lat, $lng));
                        if ($explodeLine[3] == 'Male'){
                            $icon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
                        } else {
                            $icon = 'http://maps.google.com/mapfiles/ms/icons/pink-dot.png';
                        }

                        $data[] = ['id'=>$explodeLine[0], 'first_name'=>$explodeLine[1], 'last_name'=>$explodeLine[2], 'gender'=>$explodeLine[3], 'lat'=>$lat, 'lon'=> $lng, 'icon' => $icon, 'position' => ['lat' => floatval($lat), 'lng' => floatval($lng)]];
                    }
                }
            }
            $i++;
        }

        fclose($file);
        return $data;
    }
}
