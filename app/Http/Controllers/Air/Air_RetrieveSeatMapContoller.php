<?php

namespace App\Http\Controllers\Air;

use Laravel\Lumen\Routing\Controller as  BaseController;
use App\HTTP\Controllers\Controller;
use Illuminate\Http\Request;
use Amadeus\Client\RequestOptions\AirRetrieveSeatMapOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\RequestOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\FrequentTraveller;
use GreenCape\Xml\Converter;
use Amadeus\Client\RequestOptions\Air\RetrieveSeatMap\FlightInfo;
use Amadeus\Client\RequestOptions\Air\RetrieveSeatMap\FrequentFlyer;
use Amadeus\Client\RequestOptions\Air\RetrieveSeatMap\Traveller;

class Air_RetrieveSeatMapContoller extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct() {
      parent::__construct();
    }

  /**
   * Performs AirRetrieveSeatMap
   *
   */
  public function AirRetrieveSeatMap(Request $request) {
     
    $seatmapInfo = $client->airRetrieveSeatMap(
    new AirRetrieveSeatMapOptions([
        'flight' => new FlightInfo([
            'airline' => $request->input('airline'),
            'flightNumber' => $request->input('flightNumber'),
            'departureDate' => \DateTime::createFromFormat('Y-m-d H:i:s', $request->input('departureDate'), new \DateTimeZone('UTC')),
            'departure' => $request->input('departure'),
            'arrival' => $request->input('arrival'),
            'bookingClass' =>$request->input('bookingClass')
        ]),
        'requestPrices' => $request->input('requestPrices'),
        'nrOfPassengers' => $request->input('nrOfPassengers'),
        'bookingStatus' => $request->input('bookingStatus'),
        'recordLocator' => $request->input('recordLocator'),
        'currency' => $request->input('currency'),
        'travellers' => [
            new Traveller([
                'uniqueId' => $request->input('uniqueId'),
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'type' => Traveller::TYPE_ADULT,
                'dateOfBirth' => \DateTime::createFromFormat('Y-m-d H:i:s', $request->input('dateOfBirth'), new \DateTimeZone('UTC')), //05041966
                'passengerTypeCode' => $request->input('passengerTypeCode'),
                'ticketDesignator' => $request->input('ticketDesignator'),
                'ticketNumber' => $request->input('ticketNumber'),
                'fareBasisOverride' => $request->input('fareBasisOverride'),
                'frequentTravellerInfo' => new FrequentFlyer([
                    'company' => $request->input('company'),
                    'cardNumber' => $request->input('cardNumber'),
                    'tierLevel' => $request->input('tierLevel'),
                ]),
            ]),
            new Traveller([
                'uniqueId' => $request->input('uniqueId'),
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'type' => Traveller::TYPE_ADULT,
                'frequentTravellerInfo' => new FrequentFlyer([
                    'company' => $request->input('company'),
                    'cardNumber' => $request->input('cardNumber'),
                    'tierLevel' => $request->input('tierLevel'),
                ]),
            ]),
        ]
    ])
);
    $xml = new Converter($seatmapInfo->responseXml);
    return json_encode($xml);

  }

}
