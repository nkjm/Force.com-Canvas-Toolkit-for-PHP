<?php
ini_set('display_errors', 'stdout');
error_reporting(E_ALL);

/* 
Import toolkit 
*/

// If you php code is hosted on other than heroku
require_once "SignedRequest.php";
$sr = new SignedRequest(YOUR_CONSUMER_SECRET);

// If you php code is hosted on heroku.
/*
require_once "SessionForHeroku.php";
require_once "SignedRequestForHeroku.php";
$sess = new SessionForHeroku();
$sr = new SignedRequest('4419891994557349964', $sess);
*/


/* 
Call validate_signed_request method to validate recieved Signed Request. 
True will be returned if validation succeeds. 
False will be returned if validation fails. 
At the same time, this will set $sr->canvas_request on validation sccessful.
*/
if ($sr->validate_signed_request()){
    $sr_validation_result = 'success';
} else {
    $sr_validation_result = 'error';
}


/*
View
*/
require_once "app.php";
?>
