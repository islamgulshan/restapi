<?php

namespace App\Http\Controllers\Air;

use Laravel\Lumen\Routing\Controller as  BaseController;
use App\HTTP\Controllers\Controller;
use Illuminate\Http\Request;
use Amadeus\Client\RequestOptions\AirMultiAvailabilityOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\RequestOptions;
use Amadeus\Client\RequestOptions\Air\MultiAvailability\FrequentTraveller;
use GreenCape\Xml\Converter;

class AirMultiAvailabilityController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
    public function __construct() {
      parent::__construct();
    }

  /**
   * Performs mutliavailability search.
   *
   */
  public function getFlights(Request $request) {
    $query = array();
    $query['from'] = $request->input('from');
    $query['to'] = $request->input('to');
    if ($request->input('seats')) {
      $query['nrOfSeats'] = $request->input('seats');
    }
    else {
      $query['nrOfSeats'] = 1;
    }
    if (!$request->input('cabin')) {
      $query['cabinCode'] = RequestOptions::CABIN_ECONOMY_PREMIUM_MAIN;
    }
    else {
      switch($request->input('cabin')) {
        case 'first':
          $query['cabinCode'] = RequestOptions::CABIN_ECONOMY_PREMIUM_MAIN;
        break;
        case 'business':
          $query['cabinCode'] = RequestOptions::CABIN_BUSINESS;
        break;
        case 'premium_main':
          $query['cabinCode'] = RequestOptions::CABIN_ECONOMY_PREMIUM_MAIN;
        break;
        case 'premium':
          $query['cabinCode'] = RequestOptions::CABIN_PREMIUM;
        break;
        case 'main':
          $query['cabinCode'] = RequestOptions::CABIN_ECONOMY_MAIN;
        break;
      }
    }
    if ($request->input('airlines')) {
      $airlines = unserialize($request->input('airlines'));
      $query['includedAirlines'] = implode(",", $airlines);
    }
    if ($request->input('notairlines')) {
      $airlines = unserialize($request->input('notairlines'));
      $query['excludedAirlines'] = implode(",", $airlines);
    }
    if ($request->input('excludeConnections')) {
      $connections = unserialize($request->input('excludeConnections'));
      $query['excludedConnections'] = implode(",", $connections);
    }
    if ($request->input('includeConnections')) {
      $connections = unserialize($request->input('includeConnections'));
      $query['includedConnections'] = implode(",", $connections);
    }
    if ($request->sort) {
      $query['requestType'] = $request->sort;
    }
    else {
      $query['requestType'] = RequestOptions::REQ_TYPE_NEUTRAL_ORDER;
    }

    $query['departureDate'] = \DateTime::createFromFormat('Ymd-His', $request->input('depart'), new \DateTimeZone('UTC'));
    if ($request->arrivalDate) {
      $query['arrivalDate'] = \DateTime::createFromFormat('Ymd-His', $request->input('arrive'), new \DateTimeZone('UTC'));
    }
    $opt = new AirMultiAvailabilityOptions([
      'actionCode' => AirMultiAvailabilityOptions::ACTION_SCHEDULE,
      'requestOptions' => [
         new RequestOptions($query)
      ],
      ['returnXml' => true]
    ]);

    $availabilityResult = $this->client->airMultiAvailability($opt);

    $xml = new Converter($availabilityResult->responseXml);
    return json_encode($xml);

  }

}
