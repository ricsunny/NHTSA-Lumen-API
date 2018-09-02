<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Illuminate\Http\Resources\Json\Resource;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Services\PayUService\Exception;

class VehiclesController extends Controller {

    public function __construct() {
        
    }
//     * Fetching vehicles by modelYear, manufacturer and model with or without Rating
    public function index(Request $request, $modelyear, $make, $model) {

        try {
            $rating = $request->input('withRating');
            $client = new Client();
            $res = $client->request('GET', 'https://one.nhtsa.gov/webapi/api/SafetyRatings/modelyear/' . $modelyear . '/make/' . $make . '/model/' . $model);

            $vehicles = $res->getBody();
            if ($rating && ($rating == 'true' || $rating == 'True')) {

                $vehicles = json_decode($vehicles, true);
                $results = $vehicles['Results'];
                $rating_array = array();
                foreach ($results as $result) {


                    $client = new Client();
                    $res = $client->request('GET', 'https://one.nhtsa.gov/webapi/api/SafetyRatings/VehicleId/' . $result['VehicleId']);

                    $ratings = $res->getBody();
                    $ratings = json_decode($ratings, true);
                    $rating_array[] = $ratings['Results'][0]['OverallRating'];
                }

                $vehicles = array();
                $count = 0;
                
                foreach ($results as $result) {
                    $vehicles[] = array(
                        'CrashRating' => $rating_array[$count],
                        'Description' => $result['VehicleDescription'],
                        'VehicleId' => $result['VehicleId']
                    );
                    $count++;
                }

                return array(
                    'Count' => $count,
                    'Message' => 'Results returned successfully',
                    'Results' => $vehicles
                );
            }


            return $vehicles;
        } catch (\Exception $e) {

            return array(
                'Count' => 0,
                'Message' => 'No results found for this request',
                'Results' => array()
            );
        }
    }

//     Fetching vehicles by modelYear, manufacturer and model variables in post 
    public function vehicles(Request $request) {

        try {
            $modelYear = 'undefined';
            $make = 'undefined';
            $model = 'undefined';
            if ($request->input('modelYear')) {
                $modelYear = $request->input('modelYear');
            }
            if ($request->input('manufacturer')) {
                $make = $request->input('manufacturer');
            }
            if ($request->input('model')) {
                $model = $request->input('model');
            }

            $client = new Client();
            $res = $client->request('GET', 'https://one.nhtsa.gov/webapi/api/SafetyRatings/modelyear/' . $modelYear . '/make/' . $make . '/model/' . $model);

            $vehicles = $res->getBody();

            return $vehicles;
        } catch (\Exception $e) {

            return array(
                'Count' => 0,
                'Message' => 'No results found for this request',
                'Results' => array()
            );
        }
    }

}
