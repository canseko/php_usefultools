<?php
// Required if your environment does not handle autoloading
require 'vendor/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
/** 
 *  E S T O S  V A L O R E S  D E  E J E M P L O  S O N  D E 
 *             C O N E C T A B E E 
 * **/
$sid = 'ACdc2754d06ff72e8d9b84cb3741c575f6';
$token = '1413f0b5a133b8def85ff88176cf8817';
$phone_number = '+19382019316';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    '+525514734120',
    [
        // A Twilio phone number you purchased at twilio.com/console
        'from' => $phone_number,
        // the body of the text message you'd like to send
        'body' => 'Hey Jenny! Good luck on the bar exam!'
    ]
);