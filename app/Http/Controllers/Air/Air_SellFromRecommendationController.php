<?php

namespace App\Http\Controllers\Air;

use Laravel\Lumen\Routing\Controller as  BaseController;
use App\HTTP\Controllers\Controller;
use Illuminate\Http\Request;
use Amadeus\Client\RequestOptions\AirSellFromRecommendationOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\RequestOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\FrequentTraveller;
use Amadeus\Client\RequestOptions\Air\SellFromRecommendation\Itinerary;
use Amadeus\Client\RequestOptions\Air\SellFromRecommendation\Segment;

use GreenCape\Xml\Converter;

class Air_SellFromRecommendationController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct() {
      parent::__construct();
    }

  /**
   * Performs flight info search.
   *
   */
  public function MasterPricerTravelBoardSearch(Request $request) {
    $segmetArray= array();
    
    if ($request->input('segments')) {
      $segments = $request->input('segments');
       
      $i=0;
      foreach ($segments as $key => $segment) {
        $query=array();

        $query['departureDate'] = \DateTime::createFromFormat('Ymd',$segment['departureDate'], new \DateTimeZone('UTC'));
        if (isset($segment['arrivalDate'])) {
            $query['arrivalDate'] = \DateTime::createFromFormat('Ymd', $segment['arrivalDate'], new \DateTimeZone('UTC'));
        }
        $query['from'] = $segment['from'];
        $query['to'] = $segment['to'];
        $query['to'] = $segment['companyCode'];
        $query['flightNumber'] = $segment['flightNumber'];
        $query['bookingClass'] = $segment['bookingClass'];
                                   
        if (isset($segment['nrOfPassengers'])) {
            $query['nrOfPassengers'] = $segment['nrOfPassengers'];
        }
        else {
          $query['nrOfPassengers'] = 1;
        }
         
        if (isset($segment['statusCode'])) {
             $query['statusCode'] = $segment['statusCode'];
        }else {
          $query['statusCode'] = Segment::STATUS_SELL_SEGMENT;
        }
         
        if (isset($segment['flightTypeDetails'])) {
             $query['flightTypeDetails'] = $segment['flightTypeDetails'];
        }   
 
   
        $segmetArray[$i] =  new Segment($query);
        
        $i++;
      }
    }
     
    $opt = new AirSellFromRecommendationOptions([
    'itinerary' => [
        new Itinerary([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'segments' => $segmetArray
        ]),
    ],
]);

    $xml = new Converter($opt->responseXml);
    return json_encode($xml);

  }

}
