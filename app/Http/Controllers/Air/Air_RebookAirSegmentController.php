<?php

namespace App\Http\Controllers\Air;

use Laravel\Lumen\Routing\Controller as  BaseController;
use App\HTTP\Controllers\Controller;
use Illuminate\Http\Request;
use Amadeus\Client\RequestOptions\AirRebookAirSegmentOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\RequestOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\FrequentTraveller;
use GreenCape\Xml\Converter; 
use Amadeus\Client\RequestOptions\Air\RebookAirSegment\Itinerary;
use Amadeus\Client\RequestOptions\Air\RebookAirSegment\Segment;

class Air_RebookAirSegmentController extends Controller {
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
  public function AirRebookAirSegment(Request $request) {
     
   $rebookResponse = $client->airRebookAirSegment(
    new AirRebookAirSegmentOptions([
        'itinerary' => [
            new Itinerary([
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'segments' => [
                    new Segment([
                        'departureDate' => \DateTime::createFromFormat('YmdHis',$request->input('departureDate'), new \DateTimeZone('UTC')),
                        'arrivalDate' =>  \DateTime::createFromFormat('YmdHis',$request->input('arrivalDate'), new \DateTimeZone('UTC')),
                        'dateVariation' => $request->input('dateVariation'),
                        'from' => $request->input('from'),
                        'to' => $request->input('to'),
                        'companyCode' => $request->input('companyCode'),
                        'flightNumber' => $request->input('depart'),
                        'bookingClass' => $request->input('flightNumber'),
                        'nrOfPassengers' => $request->input('nrOfPassengers'),
                        'statusCode' => Segment::STATUS_CANCEL_SEGMENT
                    ]),
                    new Segment([
                        'departureDate' => \DateTime::createFromFormat('YmdHis',$request->input('departureDate'), new \DateTimeZone('UTC')),
                        'arrivalDate' =>  \DateTime::createFromFormat('YmdHis',$request->input('arrivalDate'), new \DateTimeZone('UTC')),
                        'dateVariation' => $request->input('dateVariation'),
                        'from' => $request->input('from'),
                        'to' => $request->input('to'),
                        'companyCode' => $request->input('companyCode'),
                        'flightNumber' => $request->input('flightNumber'),
                        'bookingClass' => $request->input('bookingClass'),
                        'nrOfPassengers' => $request->input('nrOfPassengers'),
                        'statusCode' => Segment::STATUS_SELL_SEGMENT
                    ])
                ]
            ]),
            new Itinerary([
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'segments' => [
                    new Segment([
                        'departureDate' => \DateTime::createFromFormat('YmdHis',$request->input('departureDate'), new \DateTimeZone('UTC')),
                        'arrivalDate' =>  \DateTime::createFromFormat('YmdHis',$request->input('arrivalDate'), new \DateTimeZone('UTC')),
                        'dateVariation' => $request->input('dateVariation'),
                        'from' => $request->input('from'),
                        'to' => $request->input('to'),
                        'companyCode' => $request->input('companyCode'),
                        'flightNumber' => $request->input('flightNumber'),
                        'bookingClass' => $request->input('bookingClass'),
                        'nrOfPassengers' => $request->input('nrOfPassengers'),
                        'statusCode' => Segment::STATUS_CANCEL_SEGMENT
                    ]),
                    new Segment([
                        'departureDate' => \DateTime::createFromFormat('YmdHis',$request->input('departureDate'), new \DateTimeZone('UTC')),
                        'arrivalDate' =>  \DateTime::createFromFormat('YmdHis',$request->input('arrivalDate'), new \DateTimeZone('UTC')),
                        'dateVariation' =>$request->input('dateVariation'),
                        'from' => $request->input('from'),
                        'to' => $request->input('to'),
                        'companyCode' => $request->input('companyCode'),
                        'flightNumber' => $request->input('flightNumber'),
                        'bookingClass' => $request->input('bookingClass'),
                        'nrOfPassengers' => $request->input('nrOfPassengers'),
                        'statusCode' => Segment::STATUS_SELL_SEGMENT
                    ])
                ]
            ])
        ]
    ]);
);
    $xml = new Converter($rebookResponse->responseXml);
    return json_encode($xml);

  }

}
