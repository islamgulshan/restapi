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
    
    $opt = new AirSellFromRecommendationOptions([
    'itinerary' => [
        new Itinerary([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'segments' => [
                new Segment([
                    'departureDate' => \DateTime::createFromFormat('Ymd',$request->input('departureDate'), new \DateTimeZone('UTC')),
                    'arrivalDate' => \DateTime::createFromFormat('Ymd',$request->input('arrivalDate'), new \DateTimeZone('UTC')),
                    'from' => $request->input('from'),
                    'to' => $request->input('to'),
                    'companyCode' => $request->input('companyCode'),
                    'flightNumber' => $request->input('flightNumber'),
                    'bookingClass' => $request->input('bookingClass'),
                    'nrOfPassengers' => $request->input('nrOfPassengers'),
                    'statusCode' => Segment::STATUS_SELL_SEGMENT,
                    'flightTypeDetails' => Segment::INDICATOR_LOCAL_AVAILABILITY,
                ]),
                new Segment([
                    'departureDate' => \DateTime::createFromFormat('Ymd',$request->input('departureDate'), new \DateTimeZone('UTC')),
                    'arrivalDate' => \DateTime::createFromFormat('Ymd',$request->input('arrivalDate'), new \DateTimeZone('UTC')),
                    'from' => $request->input('from'),
                    'to' => $request->input('to'),
                    'companyCode' => $request->input('companyCode'),
                    'flightNumber' =>  $request->input('flightNumber'),
                    'bookingClass' => $request->input('bookingClass'),
                    'nrOfPassengers' => $request->input('nrOfPassengers'),
                    'statusCode' => Segment::STATUS_SELL_SEGMENT,
                    'flightTypeDetails' => Segment::INDICATOR_LOCAL_AVAILABILITY,
                ]),
            ],
        ]),
    ],
]);

    
    $xml = new Converter($opt->responseXml);
    return json_encode($xml);

  }

}
