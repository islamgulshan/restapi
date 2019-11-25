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
    $segmetArray= array();
    $querym= array(); 
    $valuef=array();
    if ($request->input('flight')) {
        $querym['flight'] = $request->input('flight');
        if(isset($querym['flight']['flightNumber'])){
            $querym['flight']['flightNumber'] = $querym['flight']['flightNumber'];
        }
        $querym['flight']['departureDate'] = \DateTime::createFromFormat('Ymd', $querym['flight']['departureDate']);
        $querym['flight']['departure'] = $querym['flight']['departure'];
        $querym['flight']['arrival'] = $querym['flight']['arrival'];
        $querym['flight']['airline'] = $querym['flight']['airline'];  
        if(isset($querym['flight']['bookingClass'])){
            $querym['flight']['bookingClass'] = $querym['flight']['bookingClass'];
        }
    } 




    if ($request->input('requestPrices')) {
        $querym['requestPrices'] = $request->input('requestPrices');
    }
    if ($request->input('recordLocator')) {
        $querym['recordLocator'] = $request->input('recordLocator');
    }
    if ($request->input('date')) {
        $querym['date'] =\DateTime::createFromFormat('Ymd', $request->input('date'));
    }
    if ($request->input('mostRestrictive')) {
        $querym['mostRestrictive'] =true;
    }
    if ($request->input('currency')) {
        $querym['currency'] =$request->input('currency');
    }
    if ($request->input('bookingStatus')) {
        $querym['bookingStatus'] =$request->input('bookingStatus');
    }
    if ($request->input('nrOfPassengers')) {
        $querym['nrOfPassengers'] =$request->input('nrOfPassengers');
    }

    if ($request->input('nrOfPassengers')) {
        $querym['nrOfPassengers'] =$request->input('nrOfPassengers');
    }

    if ($request->input('cabinCode')) {
        $querym['cabinCode'] =$request->input('cabinCode');
    }


    if ($request->input('travellers')) {
          
         $travellers = $request->input('travellers');
         $i=0;
         foreach ($travellers as $key => $traveller) {
            $query=array();
            $querym['travellers'][$i]['uniqueId'] = $traveller['uniqueId'];
           $querym['travellers'][$i]['uniqueId'] = $traveller['firstName'];
            $querym['travellers'][$i]['lastName'] = $traveller['lastName'];
            if (isset($traveller['type'])) {
                 $querym['travellers'][$i]['type'] = $traveller['type'];
            }else {
              $querym['travellers'][$i]['type']= Traveller::TYPE_ADULT;
            }

            if (isset($traveller['dateOfBirth'])) {
                $querym['travellers'][$i]['dateOfBirth'] = \DateTime::createFromFormat('Y-m-d H:i:s', $traveller['dateOfBirth'], new \DateTimeZone('UTC'));
            }
            if (isset($traveller['passengerTypeCode'])) { 
                $querym['travellers'][$i]['passengerTypeCode'] = $traveller['passengerTypeCode'];
            }
            if (isset($traveller['ticketDesignator'])) {
                $querym['travellers'][$i]['ticketDesignator'] = $traveller['ticketDesignator'];
            }
            if (isset($traveller['ticketNumber'])) {
                $querym['travellers'][$i]['ticketNumber'] = $traveller['ticketNumber'];
            }
            if (isset($traveller['fareBasisOverride'])) {
                $querym['travellers'][$i]['fareBasisOverride'] = $traveller['fareBasisOverride'];
            }
              

             if (isset($traveller['frequentFlyer'])) {
                
                    
                    $querym['travellers'][$i]['frequentFlyer']['company'] = $traveller['frequentFlyer']['company'];
                    $querym['travellers'][$i]['frequentFlyer']['cardNumber'] = $traveller['frequentFlyer']['cardNumber'];
                    $querym['travellers'][$i]['frequentFlyer']['tierLevel'] = $traveller['frequentFlyer']['tierLevel'];     
                     
                   $value=array(); 
                    
                          
                   

                    $querym['travellers'][$i]['frequentTravellerInfo']=array($value);
             }
              
         $i++;
         }  
    } 
      echo "<pre>";print_r($querym);exit();
    $seatmapInfo = $client->airRetrieveSeatMap(
    new AirRetrieveSeatMapOptions($querym)
    );
    $xml = new Converter($seatmapInfo->responseXml);
    return json_encode($xml);

  }

}
