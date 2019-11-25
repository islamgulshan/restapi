
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
  
  /*
  PNR Section 
  */
  $router->post('PNR-add-multi-elements', 'PNR_AddMultiElementsController@PNRAddMultiElements');
  $router->post('PNR-retrieve', 'PNR_RetrieveController@PNRRetrieve');
  $router->post('PNR-retriev-and-display', 'PNR_RetrieveAndDisplayController@PNRRetrieveAndDisplay');
  $router->post('PNR-cancel', 'PNR_CancelController@PNRCancel');
  $router->post('PNR-display-history', 'PNR_DisplayHistoryController@PNRDisplayHistory');
  $router->post('PNR-transfer-ownership', 'PNR_TransferOwnershipController@PNRTransferOwnership');
  $router->post('PNR-name-change', 'PNR_NameChangeController@PNRNameChange');
  $router->post('PNR-split', 'PNR_SplitController@PNRSplit');
  
  /*
  Queue Section 
  */
  $router->post('queue-list', 'Queue_ListController@QueueList');
  $router->post('queue-place-PNR', 'Queue_PlacePNRController@QueuePlacePNR');
  $router->post('queue-removeitem', 'Queue_RemoveItemController@QueueRemoveItem');
  $router->post('queue-move-item', 'Queue_MoveItemController@QueueMoveItem');

  /*
  Fare Section 
  */
  $router->post('fare-master-pricer-expert-search', 'Fare_MasterPricerExpertSearchController@FareMasterPricerExpertSearch');
  
  $router->post('fare-master-pricer-travelboard-search', 'Fare_MasterPricerTravelboardSearchController@FareMasterPricerTravelboardSearch');
  
  $router->post('fare-master-pricer-calendar', 'Fare_MasterPricerCalendarController@FareMasterPricerCalendar');
  
  $router->post('fare-price-PNR-with-booking-class', 'Fare_PricePNRWithBookingClassController@FarePricePNRWithBookingClass');

  $router->post('fare-price-PNR-with-lower-fares', 'Fare_PricePNRWithLowerFaresController@FarePricePNRWithLowerFares');

  $router->post('fare-price-PNR-with-lowest-fare', 'Fare_PricePNRWithLowestFareController@FarePricePNRWithLowestFare');

  $router->post('fare-informative-pricing-without-PNR', 'Fare_InformativePricingWithoutPNRController@FareInformativePricingWithoutPNR');

  $router->post('fare-informative-best-pricing-without-PNR', 'Fare_InformativeBestPricingWithoutPNRController@FareInformativeBestPricingWithoutPNR');

  $router->post('fare-check-rules', 'Fare_CheckRulesController@FareCheckRules');

  $router->post('fare-get-fare-rules', 'Fare_GetFareRulesController@FareGetFareRules');

  $router->post('fare-convert-currency', 'Fare_ConvertCurrencyController@FareConvertCurrency');
  
  /*
  Ticket Section 
  */
   $router->post('ticket-create-TST-from-pricing', 'Ticket_CreateTSTFromPricingController@TicketCreateTSTFromPricing');
  
  $router->post('ticket-create-TSM-from-pricing', 'Ticket_CreateTSMFromPricingController@TicketCreateTSMFromPricing');

  $router->post('ticket-create-TSM-fare-element', 'Ticket_CreateTSMFareElementController@TicketCreateTSMFareElement');

  $router->post('ticket-create-TASF', 'Ticket_CreateTASFController@TicketCreateTASF');

  $router->post('ticket-delete-TST', 'Ticket_DeleteTSTController@TicketDeleteTST');

  $router->post('ticket-delete-TSMP', 'Ticket_DeleteTSMPController@TicketDeleteTSMP');

  $router->post('ticket-display-TST', 'Ticket_DisplayTSTController@TicketDisplayTST');

  $router->post('ticket-display-TSMP', 'Ticket_DisplayTSMPController@TicketDisplayTSMP');

  $router->post('ticket-display-TSM-fare-element', 'Ticket_DisplayTSMFareElementController@TicketDisplayTSMFareElement');

  $router->get('ticket-retrieve-list-of-TSM', 'Ticket_RetrieveListOfTSMController@TicketRetrieveListOfTSM');

  $router->post('ticket-check-eligibility', 'Ticket_CheckEligibilityController@TicketCheckEligibility');

  $router->post('ticket-ATC-shopper-master-pricer-travel-board-search', 'Ticket_ATCShopperMasterPricerTravelBoardSearchController@TicketATCShopperMasterPricerTravelBoardSearch');

  $router->post('ticket-reprice-PNR-with-booking-class', 'Ticket_RepricePNRWithBookingClassController@TicketRepricePNRWithBookingClass');

  $router->post('ticket-reissue-confirmed-pricing', 'Ticket_ReissueConfirmedPricingController@TicketReissueConfirmedPricing');

  $router->post('ticket-cancel-document', 'Ticket_CancelDocumentController@TicketCancelDocument');

  $router->post('ticket-process-eTicket', 'Ticket_ProcessETicketController@TicketProcessETicket');

  $router->post('ticket-process-eDoc', 'Ticket_ProcessEDocController@TicketProcessEDoc');

  $router->post('ticket-init-refund', 'Ticket_InitRefundController@TicketInitRefund');

  $router->post('ticket-ignore-refund', 'Ticket_IgnoreRefundController@TicketIgnoreRefund');

  $router->post('ticket-process-refund', 'Ticket_ProcessRefundController@TicketProcessRefund');


/*
DocIssuance sechtion
*/
$router->post('doc-issuance-issue-ticket', 'DocIssuance_IssueTicketController@DocIssuanceIssueTicket');

$router->post('doc-issuance-issue-miscellaneous-documents', 'DocIssuance_IssueMiscellaneousDocumentsController@DocIssuanceIssueMiscellaneousDocuments');
  
$router->post('doc-issuance-issue-combined', 'DocIssuance_IssueCombinedController@DocIssuanceIssueCombined');

/*
DocRefund sechtion
*/
$router->post('doc-refund-init-refund', 'DocRefund_InitRefundController@DocRefundInitRefund');

$router->post('doc-refund-update-refund', 'DocRefund_UpdateRefundController@DocRefundUpdateRefund');
  
$router->post('doc-issuance-issue-combined', 'DocIssuance_IssueCombinedController@DocIssuanceIssueCombined');

$router->post('doc-refund-process-refund', 'DocRefund_ProcessRefundController@DocRefundProcessRefund');

$router->post('doc-refund-ignore-refund', 'DocRefund_IgnoreRefundController@DocRefundIgnoreRefund');

/*
Security
*/

$router->get('security-authenticate', 'Security_AuthenticateController@SecurityAuthenticate');

$router->get('security-signOut', 'Security_SignOutController@SecuritySignOut');


/*
Service
*/

$router->post('service-integrated-pricing', 'Service_IntegratedPricingController@ServiceIntegratedPricing');


$router->post('service-integrated-catalogue', 'Service_IntegratedCatalogueController@ServiceIntegratedCatalogue');

$router->post('service-standalone-catalogue', 'Service_StandaloneCatalogueController@ServiceStandaloneCatalogue');
/*
FOP
*/


/*
Info
*/
$router->post('info-encode-decode-city', 'Info_EncodeDecodeCityController@InfoEncodeDecodeCity');


/*
PointOfRef
*/

$router->post('point-of-ref-search', 'PointOfRef_SearchController@PointOfRefSearch');


$router->post('point-of-ref-category-list', 'PointOfRef_CategoryListController@PointOfRefCategoryList');


/*
Offer
*/

$router->post('offer-create-offer', 'Offer_CreateOfferController@OfferCreateOffer');


$router->post('offer-verify-offer', 'Offer_VerifyOfferController@OfferVerifyOffer');

$router->post('offer-confirm-air-offer', 'Offer_ConfirmAirOfferController@OfferConfirmAirOffer');

$router->post('offer-confirm-hotel-offer', 'Offer_ConfirmHotelOfferController@OfferConfirmHotelOffer');

$router->post('offer-confirm-car-offer', 'Offer_ConfirmCarOfferController@OfferConfirmCarOffer');

/*
MiniRule
*/

$router->post('mini-rule-get-from-pricing-rec', 'MiniRule_GetFromPricingRecController@MiniRuleGetFromPricingRec');


$router->post('mini-rule-get-from-pricing', 'MiniRule_GetFromPricingController@MiniRuleGetFromPricing');

$router->post('mini-rule-get-from-ETicket', 'MiniRule_GetFromETicketController@MiniRuleGetFromETicket');

/*
PriceXplorer_ExtremeSearch
*/
$router->post('command-cryptic', 'Command_CrypticController@CommandCryptic');
/*
PriceXplorer_ExtremeSearch
*/
$router->post('price-xplorer-extreme-search', 'PriceXplorer_ExtremeSearchController@PriceXplorerExtremeSearch');


/*
SalesReports
*/

$router->post('sales-reports-display-query-report', 'SalesReports_DisplayQueryReportController@SalesReportsDisplayQueryReport');


$router->post('sales-reports-display-daily-or-summarized-report', 'SalesReports_DisplayDailyOrSummarizedReportController@SalesReportsDisplayDailyOrSummarizedReport');

$router->post('sales-reports-display-net-remit-report', 'SalesReports_DisplayNetRemitReportController@SalesReportsDisplayNetRemitReport');




});
 