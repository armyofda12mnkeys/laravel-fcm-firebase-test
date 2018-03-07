<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use Log;

class FirebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $default_token;
    public function __construct()
    {
        //qaplay me: 
        //$this->default_token = 'ftQZl-CB3P0:APA91bGfwRpCmADVgM0oO1iQ7g_jB65rho7yBuWsUfNauI_2gOODw8owKnNMfkMIr7T32OfJwEC3S-bJLugw567X2bdS5yQIqy9p3NxTfVvNV3oSapnzGCNkxRq_C2JwosxL3PGj9sAO';
        //qaplay drew: 
        //$this->default_token = 'cOE0a9Ul6AY:APA91bGqL_qQLHPfn5HI7hkb3asWk9UICHgi3pU_pqNjKI_sD75xdS-BYzJoXzGjDTXCA3KMCs-fboXQlpyJ4Ig2WLP4Cl1iIy4yz3qf5RL-JKELwTCnVRLulTb90drsuMZNG5mzh8C9';
        $this->default_token = 'PUT_YOUR_DEVICES_FCM_TOKEN_HERE_IF_DONT_WANT_TO_TEST_DYNAMICALLY';
    }
    
    
    public function log()
    {
      Log::info('TEST SIMPLE LOG');
    }
    
    public function pushLog($token = null)
    {
      if(empty($token)) {
        $token = $this->default_token;
      }
      Log::info('TEST LOG, token: '. $token );
      //Log::info('TEST LOG, token: '. $request->route('token'));
    }
    public function pushMessage($token = null)
    {
      if(empty($token)) {
        $token = $this->default_token;
      }
      
      //1. Push w/ Data
      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder('Test Main Title');
      $notificationBuilder->setBody('Test Main Body')
                          ->setSound('default');

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();

      //$token = "__________________GET_FROM_CHARIT__________________";

      $downstreamResponse = FCM::sendTo($token, $option, $notification, null);
            
      Log::info( $downstreamResponse->numberSuccess() );
      Log::info( $downstreamResponse->numberFailure() );
      Log::info( $downstreamResponse->numberModification() );
      Log::info( print_r($downstreamResponse,1) );
      
      /*
      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();

      //return Array - you must remove all this tokens in your database
      $downstreamResponse->tokensToDelete();

      //return Array (key : oldToken, value : new token - you must change the token in your database )
      $downstreamResponse->tokensToModify();

      //return Array - you should try to resend the message to the tokens in the array
      $downstreamResponse->tokensToRetry();

      // return Array (key:token, value:errror) - in production you should remove from your database the tokens
      */
    }
    
    public function pushWithDataMessage($token = null)
    {
      if(empty($token)) {
        $token = $this->default_token;
      }
      
      //1. Push w/ Data
      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);
      $optionBuilder->setContentAvailable(true);
      
      $notificationBuilder = new PayloadNotificationBuilder('Test Main Title');
      $notificationBuilder->setBody('Test Main Body')
                          ->setSound('default');

      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData([
        'title' => 'Test Data title',
        'body' => 'Test Data Body',
        'image' => 'null',
        'screen_name' => '',
        'action' => '',
        'create_notification_on_foreground' => true
      ]);

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      $data = $dataBuilder->build();

      //$token = "__________________GET_FROM_CHARIT__________________";

      $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

      Log::info( $downstreamResponse->numberSuccess() );
      Log::info( $downstreamResponse->numberFailure() );
      Log::info( $downstreamResponse->numberModification() );
      Log::info( print_r($downstreamResponse,1) );
      
      /*
      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();

      //return Array - you must remove all this tokens in your database
      $downstreamResponse->tokensToDelete();

      //return Array (key : oldToken, value : new token - you must change the token in your database )
      $downstreamResponse->tokensToModify();

      //return Array - you should try to resend the message to the tokens in the array
      $downstreamResponse->tokensToRetry();

      // return Array (key:token, value:errror) - in production you should remove from your database the tokens
      */
        
        
    }

    
    public function dataMessage($token = null)
    {
      if(empty($token)) {
        $token = $this->default_token;
      }
      
      //1. Push w/ Data
      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);
      //***FOR DREW IOS:***
      $optionBuilder->setContentAvailable(true);


      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData([
        'title' => 'Test title',
        'body' => 'Test Body',
        'image' => 'null',
        'screen_name' => '',
        'action' => '',
        'create_notification_on_foreground' => true
      ]);

      $option = $optionBuilder->build();        
      $data = $dataBuilder->build();

      //$token = "__________________GET_FROM_CHARIT__________________";

      $downstreamResponse = FCM::sendTo($token, $option, null, $data);

      Log::info( $downstreamResponse->numberSuccess() );
      Log::info( $downstreamResponse->numberFailure() );
      Log::info( $downstreamResponse->numberModification() );
      Log::info( print_r($downstreamResponse,1) );
      
      /*
      $downstreamResponse->numberSuccess();
      $downstreamResponse->numberFailure();
      $downstreamResponse->numberModification();

      //return Array - you must remove all this tokens in your database
      $downstreamResponse->tokensToDelete();

      //return Array (key : oldToken, value : new token - you must change the token in your database )
      $downstreamResponse->tokensToModify();

      //return Array - you should try to resend the message to the tokens in the array
      $downstreamResponse->tokensToRetry();

      // return Array (key:token, value:errror) - in production you should remove from your database the tokens
      */
    }
    
}
