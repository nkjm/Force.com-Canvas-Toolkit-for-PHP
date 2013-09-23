How to use 
================================

Prerequisits
------------------------------------------------------------------------------------------------------
If your php code is hosted on heroku, you need to enable the addon "Memcachier" as follows. 
    $ heroku addons:add memcachier:dev


Sample Code
------------------------------------------------------------------------------------------------------
    <?php
    /* Import toolkit */
    // Hosted on other than heroku
    require_once "SignedRequest.php";

    // Hosted on heroku (Make sure you have copied MemcacheSASL.php to your workspace as well.)
    require_once "SignedRequestForHeroku.php";
    

    // Initialte instance of SignedRequest class assigning consumer secret of the connected app.
    $sr = new SignedRequest(CONSUMER_SECRET);
    
    // Call validate_signed_request method to validate recieved signed request. True will be returned if validation succeeds. False will be returned if validation fails. At the same time, $sr->canvas_request is set on validation sccessful.
    if(!$sr->validate_signed_request()){
        trigger_error("Validation Failed.", E_USER_ERROR);
    }
    
    // For example, you can access oauthToken and instanceUrl as follows.
    echo $sr->canvas_request->client->oauthToken;
    echo $sr->canvas_request->client->instanceUrl;
    ?>


