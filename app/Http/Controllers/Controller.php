<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Amadeus\Client;
use Amadeus\Client\Params;
use Amadeus\Client\Result;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Controller extends BaseController {
    protected $client;

    public function __construct() {
        $msgLog = new Logger('RequestResponseLogs');
        $msgLog->pushHandler(new StreamHandler('/Applications/MAMP/htdocs/traveldele-lumen/logs/requestresponse.log', Logger::INFO));
        //Set up the client with necessary parameters:
                //Set up the client with necessary parameters:
        $params = new Params([
            'authParams' => [
            'officeId' => 'MIA1S38BL', //The Amadeus Office Id you want to sign in to - must be open on your WSAP.
            'userId' => 'WSNA4OTA', //Also known as 'Originator' for Soap Header 1 & 2 WSDL's
            'passwordData' => base64_encode('GJFJOe9') // **base 64 encoded** password
        ],
        'sessionHandlerParams' => [
            'soapHeaderVersion' => Client::HEADER_V4, //This is the default value, can be omitted.
            'wsdl' => '/Applications/MAMP/htdocs/traveldele-lumen/resources/wsdl/1ASIWOTANA4_PDT_20180321_161425/1ASIWOTANA4_PDT_20180321_161424.wsdl',
            'stateful' => false, //Enable stateful messages by default - can be changed at will to switch between stateless & stateful.
            'logger' => $msgLog,
        ],
        'requestCreatorParams' => [
            'receivedFrom' => 'Traveldele' // The "Received From" string that will be visible in PNR History
        ]
        ]);
        $this->client = new Client($params);
    }
}
