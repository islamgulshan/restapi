<?php

namespace App\Http\Controllers\Air;

use Laravel\Lumen\Routing\Controller as  BaseController;
use App\HTTP\Controllers\Controller;
use Illuminate\Http\Request;
use Amadeus\Client\RequestOptions\AirFlightInfoOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\RequestOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\FrequentTraveller;
use GreenCape\Xml\Converter;

class Air_FlightInfoController extends Controller {
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
  public function getFlightinfo(Request $request) {
     $query=array();
   
      $query['airlineCode'] = $request->input('airlineCode');
      $query['flightNumber'] = $request->input('flightNumber');
      $query['departureDate'] = \DateTime::createFromFormat('Y-m-d', $request->input('departureDate'));
      if ($request->input('arrivalDate')) {
            $query['arrivalDate'] = \DateTime::createFromFormat('Y-m-d', $request->input('arrivalDate'));
      }
       
      $query['departureLocation'] = $request->input('departureLocation');
      $query['arrivalLocation'] = $request->input('arrivalLocation');
      $flightInfo = $this->client->airFlightInfo(new AirFlightInfoOptions($query));
        
    $xml = new Converter($flightInfo->responseXml);
    return json_encode($xml);

  }

}
