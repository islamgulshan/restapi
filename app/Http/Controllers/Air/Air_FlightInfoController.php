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
     
    $flightInfo = $this->client->airFlightInfo(new AirFlightInfoOptions([
       'airlineCode' => $request->input('airlineCode'),
        'flightNumber' => $request->input('flightNumber'),
        'departureDate' => \DateTime::createFromFormat('Y-m-d', $request->input('departureDate')),
        'departureLocation' => $request->input('departureLocation'),
        'arrivalLocation' => $request->input('arrivalLocation')
      ])
    );
    $xml = new Converter($flightInfo->responseXml);
    return json_encode($xml);

  }

}
