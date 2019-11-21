<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
 
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'namespace' => 'Air'], function($router) {
  /*
	Air Section 
  */
  $router->post('get-flights', 'AirMultiAvailabilityController@getFlights');
  $router->post('get-flight-info', 'Air_FlightInfoController@getFlightinfo');    
  $router->post('master-pricer-travel-board-search', 'Air_SellFromRecommendationController@MasterPricerTravelBoardSearch');
  $router->post('air-retrieve-seat-map', 'Air_RetrieveSeatMapContoller@AirRetrieveSeatMap');
  $router->post('air-rebook-air-segment', 'Air_RebookAirSegmentController@AirRebookAirSegment');
});