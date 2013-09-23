How to use 
================================

Prerequisits
------------------------------------------------------------------------------------------------------
- Session Support is required.
- If your php code is hosted on heroku, you need to enable the addon "Memcachier" as follows. 

    $ heroku addons:add memcachier:dev


Sample Code
------------------------------------------------------------------------------------------------------
    <?php
    /* 
    Import toolkit 
    */
    // If you php code is hosted on other than heroku
    require_once "SignedRequest.php";

    // If you php code is hosted on heroku. *Make sure you have copied MemcacheSASL.php to your workspace as well.
    require_once "SignedRequestForHeroku.php";
    

    /*
    Initialte instance of SignedRequest class assigning consumer secret of the connected app.
    */
    $sr = new SignedRequest(CONSUMER_SECRET);
    

    /* 
    Call validate_signed_request method to validate recieved Signed Request. 
    True will be returned if validation succeeds. 
    False will be returned if validation fails. 
    At the same time, this will set $sr->canvas_request on validation sccessful.
    */
    if(!$sr->validate_signed_request()){
        trigger_error("Validation Failed.", E_USER_ERROR);
    }
    

    /*
    For example, you can access oauthToken and instanceUrl as follows.
    */
    echo $sr->canvas_request->client->oauthToken;
    echo $sr->canvas_request->client->instanceUrl;
    ?>


